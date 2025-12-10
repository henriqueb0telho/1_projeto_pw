<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\User;
use App\Models\Company;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;

class UserController extends Controller
{
    /**
     * Display a listing of the users.
     */
    public function index(Request $request)
    {
        $query = User::query()->with('company');

        // Search
        if ($request->has('search')) {
            $search = $request->search;
            $query->where(function ($q) use ($search) {
                $q->where('first_name', 'like', "%{$search}%")
                    ->orWhere('last_name', 'like', "%{$search}%")
                    ->orWhere('email', 'like', "%{$search}%")
                    ->orWhere('phone', 'like', "%{$search}%");
            });
        }

        // Filter by role
        if ($request->has('role') && $request->role) {
            $query->where('role', $request->role);
        }

        // Filter by status
        if ($request->has('status') && $request->status) {
            $query->where('status', $request->status);
        }

        // Sort
        $sortBy = $request->get('sort_by', 'created_at');
        $sortOrder = $request->get('sort_order', 'desc');
        $query->orderBy($sortBy, $sortOrder);

        $users = $query->paginate(15)->withQueryString();

        $stats = [
            'total' => User::count(),
            'admins' => User::where('role', 'admin')->count(),
            'managers' => User::where('role', 'manager')->count(),
            'cleaners' => User::where('role', 'cleaner')->count(),
            'active' => User::where('status', 'active')->count(),
            'inactive' => User::where('status', 'inactive')->count(),
        ];

        return view('admin.users.index', compact('users', 'stats'));
    }

    /**
     * Show the form for creating a new user.
     */
    public function create()
    {
        $companies = Company::orderBy('name')->get();
        $roles = ['admin', 'manager', 'cleaner'];
        $statuses = ['active', 'inactive'];

        return view('admin.users.create', compact('companies', 'roles', 'statuses'));
    }

    /**
     * Store a newly created user.
     */
    public function store(Request $request)
    {
        $validated = $request->validate([
            'first_name' => 'required|string|max:255',
            'last_name' => 'required|string|max:255',
            'email' => 'required|string|email|max:255|unique:users',
            'phone' => 'nullable|string|max:20',
            'address' => 'nullable|string|max:500',
            'role' => 'required|in:admin,manager,cleaner',
            'company_id' => 'nullable|exists:companies,id',
            'status' => 'required|in:active,inactive',
            'password' => 'required|string|min:8|confirmed',
        ]);

        $validated['password'] = Hash::make($validated['password']);

        User::create($validated);

        return redirect()->route('admin.users.index')
            ->with('success', 'Utilizador criado com sucesso!');
    }

    /**
     * Display the specified user.
     */
    public function show(User $user)
    {
        $user->load([
            'company',
            'assignedCleanings',
            'pendingCleaningAssignments',
            'acceptedCleaningAssignments',
            'assignedCleaningSchedules' => function($query) {
                $query->orderBy('scheduled_date', 'desc')
                    ->orderBy('scheduled_time', 'desc')
                    ->with('accommodation');
            }
        ]);

        return view('admin.users.show', compact('user'));
    }

    /**
     * Show the form for editing the user.
     */
    public function edit(User $user)
    {
        $companies = Company::orderBy('name')->get();
        $roles = ['admin', 'manager', 'cleaner'];
        $statuses = ['active', 'inactive'];

        return view('admin.users.edit', compact('user', 'companies', 'roles', 'statuses'));
    }

    /**
     * Update the specified user.
     */
    public function update(Request $request, User $user)
    {
        $validated = $request->validate([
            'first_name' => 'required|string|max:255',
            'last_name' => 'required|string|max:255',
            'email' => 'required|string|email|max:255|unique:users,email,' . $user->id,
            'phone' => 'nullable|string|max:20',
            'address' => 'nullable|string|max:500',
            'role' => 'required|in:admin,manager,cleaner',
            'company_id' => 'nullable|exists:companies,id',
            'status' => 'required|in:active,inactive',
            'password' => 'nullable|string|min:8|confirmed',
        ]);

        if ($request->filled('password')) {
            $validated['password'] = Hash::make($validated['password']);
        } else {
            unset($validated['password']);
        }

        $user->update($validated);

        return redirect()->route('admin.users.index')
            ->with('success', 'Utilizador atualizado com sucesso!');
    }

    /**
     * Toggle user status.
     */
    public function toggleStatus(User $user)
    {
        $user->update([
            'status' => $user->status === 'active' ? 'inactive' : 'active'
        ]);

        return back()->with('success', 'Estado do utilizador alterado com sucesso!');
    }

    /**
     * Remove the specified user.
     */
    public function destroy(User $user)
    {
        // Prevent deleting your own account
        if ($user->id === auth()->id()) {
            return back()->with('error', 'Não pode eliminar a sua própria conta!');
        }

        $user->delete();

        return redirect()->route('admin.users.index')
            ->with('success', 'Utilizador eliminado com sucesso!');
    }

    /**
     * Export users to CSV
     */
    public function export()
    {
        $users = User::with('company')->get();

        $headers = [
            'Content-Type' => 'text/csv',
            'Content-Disposition' => 'attachment; filename="users_' . date('Y-m-d_H-i') . '.csv"',
        ];

        $callback = function() use ($users) {
            $file = fopen('php://output', 'w');
            fputcsv($file, ['Nome', 'Email', 'Telefone', 'Cargo', 'Empresa', 'Estado', 'Criado em']);

            foreach ($users as $user) {
                fputcsv($file, [
                    $user->full_name,
                    $user->email,
                    $user->phone,
                    $this->getRoleLabel($user->role),
                    $user->company?->name,
                    $user->status === 'active' ? 'Ativo' : 'Inativo',
                    $user->created_at->format('d/m/Y H:i'),
                ]);
            }

            fclose($file);
        };

        return response()->stream($callback, 200, $headers);
    }

    public function forceLogout(User $user)
    {
        // Revoke all tokens (API)
        $user->tokens()->delete();

        // In Laravel, you might need to implement session invalidation
        // This depends on your session driver

        return back()->with('success', 'Sessões do utilizador foram terminadas com sucesso!');
    }

    /**
     * Get role label in Portuguese
     */
    private function getRoleLabel($role)
    {
        return match($role) {
            'admin' => 'Administrador',
            'manager' => 'Gestor',
            'cleaner' => 'Cleaner',
            default => $role,
        };
    }
}
