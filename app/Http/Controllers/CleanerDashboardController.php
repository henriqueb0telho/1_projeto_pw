<?php
//
//namespace App\Http\Controllers;
//
//use App\Models\CleaningSchedule;
//use App\Models\CleaningAssignment;
//use Illuminate\Http\Request;
//use Illuminate\Support\Facades\Auth;
//
//class CleanerDashboardController extends Controller
//{
//    public function index(Request $request)
//    {
//        $query = CleaningSchedule::with([
//            'accommodation',
//            'cleaningAssignments' => function($query) {
//                $query->where('user_id', Auth::id());
//            }
//        ])
//            ->whereHas('cleaningAssignments', function($query) {
//                $query->where('user_id', Auth::id());
//            });
//
//        // Filters
//        if ($request->has('status') && $request->status !== '') {
//            $query->where('status', $request->status);
//        }
//
//        if ($request->has('date_from') && $request->date_from !== '') {
//            $query->where('scheduled_date', '>=', $request->date_from);
//        }
//
//        if ($request->has('date_to') && $request->date_to !== '') {
//            $query->where('scheduled_date', '<=', $request->date_to);
//        }
//
//        $cleanings = $query->orderBy('scheduled_date', 'desc')
//            ->orderBy('scheduled_time', 'desc')
//            ->paginate(15);
//
//        return view('dashboard.cleaner', compact('cleanings'));
//    }
//
//    public function updateStatus(Request $request, CleaningSchedule $cleaning)
//    {
//        // Verify the cleaner is assigned to this cleaning
//        $assignment = CleaningAssignment::where('cleaning_schedule_id', $cleaning->id)
//            ->where('user_id', Auth::id())
//            ->firstOrFail();
//
//        $action = $request->input('action');
//
//        switch ($action) {
//            case 'accept':
//                $assignment->update([
//                    'response_status' => 'accepted',
//                    'responded_at' => now()
//                ]);
//                break;
//
//            case 'decline':
//                $assignment->update([
//                    'response_status' => 'rejected',
//                    'responded_at' => now()
//                ]);
//                break;
//
//            case 'reschedule':
//                $assignment->update([
//                    'response_status' => 'rejected',
//                    'responded_at' => now()
//                ]);
//
//                // Create reschedule request
//                $assignment->rescheduleRequests()->create([
//                    'requested_date' => $request->input('reschedule_date'),
//                    'requested_time' => $request->input('reschedule_time'),
//                    'reason' => $request->input('reason'),
//                    'status' => 'pending'
//                ]);
//                break;
//
//            case 'start':
//                if ($assignment->isAccepted()) {
//                    $cleaning->update([
//                        'status' => 'in_progress'
//                    ]);
//                }
//                break;
//
//            case 'complete':
//                if ($cleaning->status === 'in_progress') {
//                    $cleaning->update([
//                        'status' => 'completed',
//                        'actual_duration' => $request->input('actual_duration')
//                    ]);
//                }
//                break;
//        }
//
//        return redirect()->route('cleaner.dashboard.index')
//            ->with('success', 'Cleaning assignment updated successfully.');
//    }
//}


namespace App\Http\Controllers;

use App\Models\CleaningSchedule;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class CleanerDashboardController extends Controller
{
    // 1. Mostrar o Dashboard
    public function index(Request $request)
    {
        $user = Auth::user();

        // Vai buscar as limpezas atribuídas ao utilizador logado
        // Ordena: Primeiro as que faltam fazer, depois por data/hora
        $cleanings = $user->assignedCleaningSchedules()
            ->with('accommodation') // Carrega dados do alojamento para mostrar morada/nome
            ->orderByRaw("FIELD(status, 'in_progress', 'scheduled', 'completed')")
            ->orderBy('scheduled_date', 'asc')
            ->orderBy('scheduled_time', 'asc')
            ->get();

        return view('dashboard.cleaner', compact('cleanings'));
    }

    // 2. Ação dos Botões (Iniciar / Concluir)
    public function updateStatus(Request $request, $id)
    {
        $cleaning = CleaningSchedule::findOrFail($id);

        // Validação de segurança: O user está mesmo atribuído a esta limpeza?
        if (!$cleaning->users->contains(Auth::id())) {
            abort(403, 'Não tem permissão para alterar esta limpeza.');
        }

        $action = $request->input('action'); // 'start' ou 'complete'

        if ($action === 'start') {
            $cleaning->update(['status' => 'in_progress']);
        }

        if ($action === 'complete') {
            $cleaning->update([
                'status' => 'completed',
                'actual_duration' => $request->input('duration'), // Se enviarmos a duração
            ]);
        }

        return redirect()->back()->with('success', 'Estado atualizado com sucesso!');
    }
}
