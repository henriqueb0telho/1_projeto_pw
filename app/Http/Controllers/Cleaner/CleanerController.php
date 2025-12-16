<?php

namespace App\Http\Controllers\Cleaner;

use App\Http\Controllers\Controller;
use App\Models\CleaningAssignment;
use App\Models\CleaningAssignmentReschedule;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class CleanerController extends Controller
{
// app/Http/Controllers/Cleaner/CleanerController.php

    public function dashboard()
    {
        $userId = auth()->id();

        // 1. Tarefas Pendentes
        $pendingAssignments = \App\Models\CleaningAssignment::with(['cleaningSchedule.accommodation'])
            ->where('user_id', $userId)
            ->where('response_status', 'pending')
            ->whereDoesntHave('rescheduleRequests', function ($q) {
                $q->where('status', 'pending');
            })
            ->get();

        // 2. Tarefas Aceites (Ativas)
        $activeAssignments = \App\Models\CleaningAssignment::with(['cleaningSchedule.accommodation'])
            ->where('user_id', $userId)
            ->where('response_status', 'accepted')
            ->get()
            ->sortBy(function ($assignment) {
                return $assignment->cleaningSchedule->scheduled_date;
            });

        // 3. Pedidos de Reschedule
        $reschedulePending = \App\Models\CleaningAssignment::with(['cleaningSchedule.accommodation', 'rescheduleRequests'])
            ->where('user_id', $userId)
            ->whereHas('rescheduleRequests', function ($q) {
                $q->where('status', 'pending');
            })
            ->get();

        // ATENÇÃO: O nome da view aqui deve coincidir com a pasta onde guardou o ficheiro blade
        // Pelo erro que mostrou, parece estar em resources/views/dashboard/cleaner.blade.php
        return view('cleaner.agenda', compact('pendingAssignments', 'activeAssignments', 'reschedulePending'));
    }

    /**
     * Aceitar ou Rejeitar uma limpeza
     */
    public function respond(Request $request, CleaningAssignment $assignment)
    {
        // Validar que a tarefa pertence ao user
        if ($assignment->user_id !== auth()->id()) {
            abort(403);
        }

        $validated = $request->validate([
            'response' => 'required|in:accepted,rejected'
        ]);

        $assignment->update([
            'response_status' => $validated['response'],
            'responded_at' => now(),
        ]);

        $msg = $validated['response'] === 'accepted' ? 'Tarefa aceite com sucesso!' : 'Tarefa rejeitada.';
        return back()->with('success', $msg);
    }

    /**
     * Pedir Reschedule
     */
    public function requestReschedule(Request $request, CleaningAssignment $assignment)
    {
        if ($assignment->user_id !== auth()->id()) {
            abort(403);
        }

        $validated = $request->validate([
            'requested_date' => 'required|date|after_or_equal:today',
            'requested_time' => 'required',
            'reason' => 'required|string|max:500',
        ]);

        DB::transaction(function () use ($validated, $assignment) {
            // Criar o pedido de reschedule
            CleaningAssignmentReschedule::create([
                'cleaning_assignment_id' => $assignment->id,
                'requested_date' => $validated['requested_date'],
                'requested_time' => $validated['requested_time'],
                'reason' => $validated['reason'],
                'status' => 'pending'
            ]);

            // O assignment continua tecnicamente como 'pending' ou podes criar um status customizado
            // Aqui mantemos 'pending' mas a query do dashboard filtra quem tem rescheduleRequests
        });

        return back()->with('success', 'Pedido de alteração enviado ao gerente.');
    }

    /**
     * Atualizar status da limpeza (Start/Complete) - Lógica existente
     */
    public function updateStatus(Request $request, $assignmentId)
    {
        $assignment = CleaningAssignment::with('cleaningSchedule')->findOrFail($assignmentId);
        $schedule = $assignment->cleaningSchedule;

        if ($request->action == 'start') {
            $schedule->update(['status' => 'in_progress']);
        } elseif ($request->action == 'complete') {
            $schedule->update([
                'status' => 'completed',
                'actual_duration' => $request->duration
            ]);
        }

        return back()->with('success', 'Estado da limpeza atualizado.');
    }
}
