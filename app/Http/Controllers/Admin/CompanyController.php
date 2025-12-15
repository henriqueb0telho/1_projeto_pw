<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Company;
use Illuminate\Http\Request;
use Illuminate\Validation\Rule;

class CompanyController extends Controller
{
    /**
     * Display a listing of the companies.
     */
    public function index(Request $request)
    {
        $query = Company::query()->withCount('accommodations');

        // Search (Nome, NIF, Email ou Morada)
        if ($request->has('search')) {
            $search = $request->search;
            $query->where(function ($q) use ($search) {
                $q->where('name', 'like', "%{$search}%")
                    ->orWhere('nif', 'like', "%{$search}%")
                    ->orWhere('email', 'like', "%{$search}%")
                    ->orWhere('address', 'like', "%{$search}%");
            });
        }

        // Sort
        $sortBy = $request->get('sort_by', 'created_at');
        $sortOrder = $request->get('sort_order', 'desc');

        $allowedSorts = ['name', 'created_at', 'nif', 'accommodations_count'];
        if (in_array($sortBy, $allowedSorts)) {
            $query->orderBy($sortBy, $sortOrder);
        } else {
            $query->orderBy('created_at', 'desc');
        }

        $companies = $query->paginate(15)->withQueryString();

        // Estatísticas para os cards do topo
        $stats = [
            'total' => Company::count(),
            'total_accommodations' => \App\Models\Accommodation::count(),
            'avg_accommodations' => Company::count() > 0 ? round(\App\Models\Accommodation::count() / Company::count(), 1) : 0,
        ];

        return view('admin.companies.index', compact('companies', 'stats'));
    }

    /**
     * Show the form for creating a new company.
     */
    public function create()
    {
        return view('admin.companies.create');
    }

    /**
     * Store a newly created company.
     */
    public function store(Request $request)
    {
        $validated = $request->validate([
            'name' => 'required|string|max:255',
            'nif' => 'nullable|string|max:20|unique:companies,nif',
            'email' => 'nullable|email|max:255',
            'phone' => 'nullable|string|max:20',
            'address' => 'nullable|string|max:500',
        ]);

        Company::create($validated);

        return redirect()->route('admin.companies.index')
            ->with('success', 'Empresa criada com sucesso!');
    }

    /**
     * Display the specified company.
     */
    public function show(Company $company)
    {
        $company->load(['accommodations' => function($q) {
            $q->latest()->limit(10); // Carrega os últimos 10 alojamentos
        }]);

        $company->loadCount(['accommodations', 'users']);

        return view('admin.companies.show', compact('company'));
    }

    /**
     * Show the form for editing the company.
     */
    public function edit(Company $company)
    {
        return view('admin.companies.edit', compact('company'));
    }

    /**
     * Update the specified company.
     */
    public function update(Request $request, Company $company)
    {
        $validated = $request->validate([
            'name' => 'required|string|max:255',
            'nif' => ['nullable', 'string', 'max:20', Rule::unique('companies')->ignore($company->id)],
            'email' => 'nullable|email|max:255',
            'phone' => 'nullable|string|max:20',
            'address' => 'nullable|string|max:500',
        ]);

        $company->update($validated);

        return redirect()->route('admin.companies.index')
            ->with('success', 'Empresa atualizada com sucesso!');
    }

    /**
     * Remove the specified company.
     */
    public function destroy(Company $company)
    {
        // Verificar se existem alojamentos associados
        if ($company->accommodations()->exists()) {
            return back()->with('error', 'Não é possível eliminar esta empresa pois tem alojamentos associados. Por favor, reassocie ou elimine os alojamentos primeiro.');
        }

        // Verificar se existem utilizadores associados
        if ($company->users()->exists()) {
            return back()->with('error', 'Não é possível eliminar esta empresa pois tem utilizadores associados.');
        }

        $company->delete();

        return redirect()->route('admin.companies.index')
            ->with('success', 'Empresa eliminada com sucesso!');
    }

    /**
     * Export companies to CSV
     */
    public function export()
    {
        $companies = Company::withCount('accommodations')->get();

        $headers = [
            'Content-Type' => 'text/csv',
            'Content-Disposition' => 'attachment; filename="empresas_' . date('Y-m-d_H-i') . '.csv"',
        ];

        $callback = function() use ($companies) {
            $file = fopen('php://output', 'w');

            // Cabeçalho do CSV
            fputcsv($file, [
                'Nome',
                'NIF',
                'Email',
                'Telefone',
                'Morada',
                'Qtd Alojamentos',
                'Criado em'
            ]);

            foreach ($companies as $comp) {
                fputcsv($file, [
                    $comp->name,
                    $comp->nif ?? 'N/A',
                    $comp->email ?? 'N/A',
                    $comp->phone ?? 'N/A',
                    $comp->address,
                    $comp->accommodations_count,
                    $comp->created_at->format('d/m/Y H:i'),
                ]);
            }

            fclose($file);
        };

        return response()->stream($callback, 200, $headers);
    }
}
