<?php

namespace App\Http\Controllers\Manager;

use App\Http\Controllers\Controller;
use App\Models\Accommodation;
use App\Models\CleaningSchedule;
use App\Models\CleaningAssignment;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class CleaningScheduleController extends Controller
{
    /**
     * Listagem com Filtros (Index)
     */
    public function index(Request $request)
    {
        $userCompanyId = auth()->user()->company_id;

        $query = CleaningSchedule::with(['accommodation', 'users'])
            ->whereHas('accommodation', function($q) use ($userCompanyId) {
                $q->where('company_id', $userCompanyId);
            });

        // Filtro: Pesquisa (Nome do alojamento)
        if ($request->has('search') && $request->search) {
            $query->whereHas('accommodation', function($q) use ($request) {
                $q->where('name', 'like', '%' . $request->search . '%');
            });
        }

        // Filtro: Data
        if ($request->has('date') && $request->date) {
            $query->whereDate('scheduled_date', $request->date);
        }

        // Filtro: Estado
        if ($request->has('status') && $request->status) {
            $query->where('status', $request->status);
        }

        // Ordenação Padrão (Mais recentes primeiro ou próximos agendamentos)
        $schedules = $query->orderBy('scheduled_date', 'desc')
            ->orderBy('scheduled_time', 'asc')
            ->paginate(10)
            ->withQueryString();

        return view('manager.cleanings.index', compact('schedules'));
    }

    /**
     * Formulário de Criação
     */
    public function create()
    {
        $userCompanyId = auth()->user()->company_id;

        $accommodations = Accommodation::where('company_id', $userCompanyId)
            ->where('is_active', true)
            ->orderBy('name')
            ->get();

        $cleaners = User::where('company_id', $userCompanyId)
            ->where('role', 'cleaner')
            ->where('status', 'active')
            ->orderBy('first_name')
            ->get();

        $upcomingSchedules = CleaningSchedule::with('accommodation')
            ->whereHas('accommodation', function($q) use ($userCompanyId) {
                $q->where('company_id', $userCompanyId);
            })
            ->where('scheduled_date', '>=', now())
            ->orderBy('scheduled_date')
            ->orderBy('scheduled_time')
            ->take(5)
            ->get();

        return view('manager.cleanings.create', compact('accommodations', 'cleaners', 'upcomingSchedules'));
    }

    /**
     * Guardar Nova Limpeza
     */
    public function store(Request $request)
    {
        $validated = $request->validate([
            'accommodation_id' => 'required|exists:accommodations,id',
            'scheduled_date' => 'required|date|after_or_equal:today',
            'scheduled_time' => 'required',
            'notes' => 'nullable|string|max:1000',
            'primary_cleaner_id' => 'nullable|exists:users,id',
            'assistants' => 'nullable|array',
            'assistants.*' => 'exists:users,id'
        ]);

        DB::transaction(function () use ($validated) {
            $schedule = CleaningSchedule::create([
                'accommodation_id' => $validated['accommodation_id'],
                'scheduled_date' => $validated['scheduled_date'],
                'scheduled_time' => $validated['scheduled_time'],
                'status' => 'scheduled',
                'notes' => $validated['notes'] ?? null,
            ]);

            if (!empty($validated['primary_cleaner_id'])) {
                CleaningAssignment::create([
                    'cleaning_schedule_id' => $schedule->id,
                    'user_id' => $validated['primary_cleaner_id'],
                    'role_in_cleaning' => 'primary',
                    'response_status' => 'pending',
                ]);
            }

            if (!empty($validated['assistants'])) {
                foreach ($validated['assistants'] as $assistantId) {
                    if ($assistantId != ($validated['primary_cleaner_id'] ?? null)) {
                        CleaningAssignment::create([
                            'cleaning_schedule_id' => $schedule->id,
                            'user_id' => $assistantId,
                            'role_in_cleaning' => 'assistant',
                            'response_status' => 'pending',
                        ]);
                    }
                }
            }
        });

        return redirect()->route('manager.cleanings.index')->with('success', 'Limpeza agendada com sucesso!');
    }

    /**
     * Ver Detalhes (Show)
     */
    public function show(CleaningSchedule $schedule)
    {
        // Carregar relações necessárias para a view show.blade.php
        $schedule->load(['accommodation', 'users', 'cleaningAssignments']);

        return view('manager.cleanings.show', compact('schedule'));
    }

    /**
     * Formulário de Edição (Edit)
     */
    public function edit(CleaningSchedule $schedule)
    {
        $userCompanyId = auth()->user()->company_id;

        // Precisamos da lista de cleaners novamente para os dropdowns
        $cleaners = User::where('company_id', $userCompanyId)
            ->where('role', 'cleaner')
            ->where('status', 'active')
            ->orderBy('first_name')
            ->get();

        $schedule->load(['primaryCleaners', 'assistants']);

        return view('manager.cleanings.edit', compact('schedule', 'cleaners'));
    }

    /**
     * Atualizar Limpeza (Update)
     */
    public function update(Request $request, CleaningSchedule $schedule)
    {
        $validated = $request->validate([
            'scheduled_date' => 'required|date',
            'scheduled_time' => 'required',
            'status' => 'required|in:scheduled,in_progress,completed,cancelled',
            'notes' => 'nullable|string|max:1000',
            'primary_cleaner_id' => 'nullable|exists:users,id',
            'assistants' => 'nullable|array',
            'assistants.*' => 'exists:users,id'
        ]);

        DB::transaction(function () use ($validated, $schedule) {
            // 1. Atualizar dados básicos
            $schedule->update([
                'scheduled_date' => $validated['scheduled_date'],
                'scheduled_time' => $validated['scheduled_time'],
                'status' => $validated['status'],
                'notes' => $validated['notes'],
            ]);

            // 2. Sincronizar Equipas (Apagar atuais e recriar é mais seguro para evitar duplicados/conflitos de roles)
            // Nota: Em produção real, poderias querer verificar se mudou para não apagar o histórico de 'response_status'

            // Apagar assignments antigos
            CleaningAssignment::where('cleaning_schedule_id', $schedule->id)->delete();

            // Recriar Primário
            if (!empty($validated['primary_cleaner_id'])) {
                CleaningAssignment::create([
                    'cleaning_schedule_id' => $schedule->id,
                    'user_id' => $validated['primary_cleaner_id'],
                    'role_in_cleaning' => 'primary',
                    'response_status' => 'pending', // Reseta status para pendente pois pode ser uma nova data
                ]);
            }

            // Recriar Assistentes
            if (!empty($validated['assistants'])) {
                foreach ($validated['assistants'] as $assistantId) {
                    if ($assistantId != ($validated['primary_cleaner_id'] ?? null)) {
                        CleaningAssignment::create([
                            'cleaning_schedule_id' => $schedule->id,
                            'user_id' => $assistantId,
                            'role_in_cleaning' => 'assistant',
                            'response_status' => 'pending',
                        ]);
                    }
                }
            }
        });

        return redirect()->route('manager.cleanings.index')->with('success', 'Agendamento atualizado com sucesso!');
    }

    /**
     * Apagar Limpeza (Destroy)
     */
    public function destroy(CleaningSchedule $schedule)
    {
        // Assignments são apagados em cascata se a FK tiver onDelete('cascade') na migração
        // Caso contrário, apagar manualmente:
        // $schedule->cleaningAssignments()->delete();

        $schedule->delete();

        return redirect()->route('manager.cleanings.index')->with('success', 'Agendamento eliminado.');
    }
}
