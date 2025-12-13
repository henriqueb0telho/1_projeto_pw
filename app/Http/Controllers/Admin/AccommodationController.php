<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Accommodation;
use App\Models\Company;
use Illuminate\Http\Request;

class AccommodationController extends Controller
{
    /**
     * Display a listing of the accommodations.
     */
    public function index(Request $request)
    {
        $query = Accommodation::query()->with('company');

        // Search (Nome, Descrição ou Morada)
        if ($request->has('search')) {
            $search = $request->search;
            $query->where(function ($q) use ($search) {
                $q->where('name', 'like', "%{$search}%")
                    ->orWhere('description', 'like', "%{$search}%")
                    ->orWhere('address', 'like', "%{$search}%");
            });
        }

        // Filter by Company
        if ($request->has('company_id') && $request->company_id) {
            $query->where('company_id', $request->company_id);
        }

        // Filter by status (is_active boolean)
        if ($request->has('is_active') && $request->is_active !== null) {
            $query->where('is_active', $request->is_active);
        }

        // Sort
        $sortBy = $request->get('sort_by', 'created_at');
        $sortOrder = $request->get('sort_order', 'desc');

        // Proteção simples para colunas válidas
        $allowedSorts = ['name', 'created_at', 'max_guests', 'is_active'];
        if (in_array($sortBy, $allowedSorts)) {
            $query->orderBy($sortBy, $sortOrder);
        } else {
            $query->orderBy('created_at', 'desc');
        }

        $accommodations = $query->paginate(15)->withQueryString();

        // Estatísticas para os cards do topo
        $stats = [
            'total' => Accommodation::count(),
            'active' => Accommodation::where('is_active', true)->count(),
            'inactive' => Accommodation::where('is_active', false)->count(),
            'total_capacity' => Accommodation::sum('max_guests'), // Exemplo: Total de hóspedes que o sistema aguenta
        ];

        return view('admin.accommodations.index', compact('accommodations', 'stats'));
    }

    /**
     * Show the form for creating a new accommodation.
     */
    public function create()
    {
        $companies = Company::orderBy('name')->get();

        return view('admin.accommodations.create', compact('companies'));
    }

    /**
     * Store a newly created accommodation.
     */
    public function store(Request $request)
    {
        $validated = $request->validate([
            'name' => 'required|string|max:255',
            'description' => 'nullable|string',
            'address' => 'nullable|string|max:500',
            'max_guests' => 'required|integer|min:1',
            'bedrooms' => 'required|integer|min:0',
            'bathrooms' => 'required|integer|min:0',
            'cleaning_time_estimate' => 'required|numeric|min:0.5',
            'company_id' => 'nullable|exists:companies,id',
            'is_active' => 'required|boolean', // Aceita 0, 1, true, false
        ]);

        Accommodation::create($validated);

        return redirect()->route('admin.accommodations.index')
            ->with('success', 'Alojamento criado com sucesso!');
    }

    /**
     * Display the specified accommodation.
     */
    public function show(Accommodation $accommodation)
    {
        $accommodation->load([
            'company',
            'upcomingCleanings' => function ($query) {
                $query->orderBy('scheduled_date', 'asc')->limit(5);
            },
            'completedCleanings' => function ($query) {
                $query->orderBy('scheduled_date', 'desc')->limit(5);
            }
        ]);

        return view('admin.accommodations.show', compact('accommodation'));
    }

    /**
     * Show the form for editing the accommodation.
     */
    public function edit(Accommodation $accommodation)
    {
        $companies = Company::orderBy('name')->get();

        return view('admin.accommodations.edit', compact('accommodation', 'companies'));
    }

    /**
     * Update the specified accommodation.
     */
    public function update(Request $request, Accommodation $accommodation)
    {
        $validated = $request->validate([
            'name' => 'required|string|max:255',
            'description' => 'nullable|string',
            'address' => 'nullable|string|max:500',
            'max_guests' => 'required|integer|min:1',
            'bedrooms' => 'required|integer|min:0',
            'bathrooms' => 'required|integer|min:0',
            'cleaning_time_estimate' => 'required|numeric|min:0.5',
            'company_id' => 'nullable|exists:companies,id',
            'is_active' => 'required|boolean',
        ]);

        $accommodation->update($validated);

        return redirect()->route('admin.accommodations.index')
            ->with('success', 'Alojamento atualizado com sucesso!');
    }

    /**
     * Toggle accommodation status (atalho rápido).
     */
    public function toggleStatus(Accommodation $accommodation)
    {
        $accommodation->update([
            'is_active' => !$accommodation->is_active
        ]);

        $statusMsg = $accommodation->is_active ? 'ativado' : 'desativado';

        return back()->with('success', "Alojamento {$statusMsg} com sucesso!");
    }

    /**
     * Remove the specified accommodation.
     */
    public function destroy(Accommodation $accommodation)
    {
        // Opcional: Verificar se existem limpezas futuras agendadas antes de apagar
        if ($accommodation->upcomingCleanings()->exists()) {
            return back()->with('error', 'Não é possível eliminar este alojamento pois existem limpezas agendadas.');
        }

        $accommodation->delete();

        return redirect()->route('admin.accommodations.index')
            ->with('success', 'Alojamento eliminado com sucesso!');
    }

    /**
     * Export accommodations to CSV
     */
    public function export()
    {
        $accommodations = Accommodation::with('company')->get();

        $headers = [
            'Content-Type' => 'text/csv',
            'Content-Disposition' => 'attachment; filename="alojamentos_' . date('Y-m-d_H-i') . '.csv"',
        ];

        $callback = function() use ($accommodations) {
            $file = fopen('php://output', 'w');

            // Cabeçalho do CSV
            fputcsv($file, [
                'Nome',
                'Empresa',
                'Morada',
                'Hóspedes Max',
                'Quartos',
                'WC',
                'Tempo Limpeza (h)',
                'Estado',
                'Criado em'
            ]);

            foreach ($accommodations as $acc) {
                fputcsv($file, [
                    $acc->name,
                    $acc->company?->name ?? 'N/A',
                    $acc->address,
                    $acc->max_guests,
                    $acc->bedrooms,
                    $acc->bathrooms,
                    $acc->cleaning_time_estimate,
                    $acc->is_active ? 'Ativo' : 'Inativo',
                    $acc->created_at->format('d/m/Y H:i'),
                ]);
            }

            fclose($file);
        };

        return response()->stream($callback, 200, $headers);
    }
}
