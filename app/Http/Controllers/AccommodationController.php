<?php

namespace App\Http\Controllers;

use App\Models\Accommodation;
use Illuminate\Http\Request;

class AccommodationController extends Controller
{
    public function index()
    {
        $accommodations = Accommodation::with(['company', 'upcomingCleanings'])
            ->where('is_active', true)
            ->paginate(12);

        return view('admin.accommodations.index', compact('accommodations'));
    }

    public function show(Accommodation $accommodation)
    {
        $accommodation->load([
            'company',
            'accommodationSections',
            'upcomingCleanings' => function ($query) {
                $query->orderBy('scheduled_date', 'asc')->limit(5);
            },
            'completedCleanings' => function ($query) {
                $query->orderBy('scheduled_date', 'desc')->limit(5);
            }
        ]);

        return view('admin.accommodations.show', compact('accommodation'));
    }
}
