<?php

namespace App\Http\Controllers;

use App\Models\CleaningSchedule;
use App\Models\Accommodation;
use App\Models\User;
use Illuminate\Http\Request;

class CleaningScheduleController extends Controller
{
    public function index(Request $request)
    {
        $query = CleaningSchedule::with(['accommodation.company', 'users']);

        // Filter by status
        if ($request->filled('status')) {
            $query->where('status', $request->status);
        }

        // Filter by date range
        if ($request->filled('date_from')) {
            $query->where('scheduled_date', '>=', $request->date_from);
        }
        if ($request->filled('date_to')) {
            $query->where('scheduled_date', '<=', $request->date_to);
        }

        // Filter by accommodation
        if ($request->filled('accommodation_id')) {
            $query->where('accommodation_id', $request->accommodation_id);
        }

        $cleanings = $query->orderBy('scheduled_date', 'desc')
            ->orderBy('scheduled_time', 'desc')
            ->paginate(15);

        $accommodations = Accommodation::where('is_active', true)
            ->orderBy('name')
            ->get();

        return view('cleanings.index', compact('cleanings', 'accommodations'));
    }

    public function show(CleaningSchedule $cleaning)
    {
        $cleaning->load([
            'accommodation.company',
            'accommodation.accommodationSections',
            'users'
        ]);

        return view('cleanings.show', compact('cleaning'));
    }

    public function create()
    {
        $accommodations = Accommodation::where('is_active', true)
            ->with('company')
            ->orderBy('name')
            ->get();

        $cleaners = User::where('role', 'cleaner')
            ->where('status', 'active')
            ->orderBy('first_name')
            ->get();

        return view('cleanings.create', compact('accommodations', 'cleaners'));
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'accommodation_id' => 'required|exists:accommodations,id',
            'scheduled_date' => 'required|date',
            'scheduled_time' => 'required',
            'notes' => 'nullable|string',
            'cleaners' => 'nullable|array',
            'cleaners.*' => 'exists:users,id'
        ]);

        $cleaning = CleaningSchedule::create([
            'accommodation_id' => $validated['accommodation_id'],
            'scheduled_date' => $validated['scheduled_date'],
            'scheduled_time' => $validated['scheduled_time'],
            'status' => 'pending',
            'notes' => $validated['notes'] ?? null,
        ]);

        // Attach cleaners if selected
        if (!empty($validated['cleaners'])) {
            foreach ($validated['cleaners'] as $index => $cleanerId) {
                $cleaning->users()->attach($cleanerId, [
                    'role_in_cleaning' => $index === 0 ? 'primary' : 'assistant'
                ]);
            }
        }

        return redirect()->route('cleanings.show', $cleaning)
            ->with('success', 'Cleaning scheduled successfully!');
    }

    public function edit(CleaningSchedule $cleaning)
    {
        $cleaning->load('users');

        $accommodations = Accommodation::where('is_active', true)
            ->with('company')
            ->orderBy('name')
            ->get();

        $cleaners = User::where('role', 'cleaner')
            ->where('status', 'active')
            ->orderBy('first_name')
            ->get();

        return view('cleanings.edit', compact('cleaning', 'accommodations', 'cleaners'));
    }

    public function update(Request $request, CleaningSchedule $cleaning)
    {
        $validated = $request->validate([
            'accommodation_id' => 'required|exists:accommodations,id',
            'scheduled_date' => 'required|date',
            'scheduled_time' => 'required',
            'status' => 'required|in:pending,in_progress,completed,cancelled',
            'notes' => 'nullable|string',
            'actual_duration' => 'nullable|numeric|min:0',
            'cleaners' => 'nullable|array',
            'cleaners.*' => 'exists:users,id'
        ]);

        $cleaning->update([
            'accommodation_id' => $validated['accommodation_id'],
            'scheduled_date' => $validated['scheduled_date'],
            'scheduled_time' => $validated['scheduled_time'],
            'status' => $validated['status'],
            'notes' => $validated['notes'] ?? null,
            'actual_duration' => $validated['actual_duration'] ?? null,
        ]);

        // Sync cleaners
        if (isset($validated['cleaners'])) {
            $cleaning->users()->detach();
            foreach ($validated['cleaners'] as $index => $cleanerId) {
                $cleaning->users()->attach($cleanerId, [
                    'role_in_cleaning' => $index === 0 ? 'primary' : 'assistant'
                ]);
            }
        }

        return redirect()->route('cleanings.show', $cleaning)
            ->with('success', 'Cleaning updated successfully!');
    }

    public function destroy(CleaningSchedule $cleaning)
    {
        $cleaning->users()->detach();
        $cleaning->delete();

        return redirect()->route('cleanings.index')
            ->with('success', 'Cleaning deleted successfully!');
    }
}
