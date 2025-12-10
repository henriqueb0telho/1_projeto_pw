<?php

namespace App\Http\Controllers;

use App\Models\User;
use App\Models\CleaningSchedule;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Carbon\Carbon;

class ManagerDashboardController extends Controller
{
    public function index()
    {
        $user = Auth::user();
        $companyId = $user->company_id;

        // 1. Estatísticas Rápidas da Empresa
        $stats = [
            'total_cleaners' => User::where('company_id', $companyId)->where('role', 'cleaner')->count(),
            'cleanings_today' => CleaningSchedule::whereHas('accommodation', function($q) use ($companyId) {
                $q->where('company_id', $companyId);
            })->whereDate('scheduled_date', Carbon::today())->count(),
            'pending_issues' => CleaningSchedule::whereHas('accommodation', function($q) use ($companyId) {
                $q->where('company_id', $companyId);
            })->where('status', 'scheduled')
                ->where('scheduled_date', '<', Carbon::today())
                ->count(), // Limpezas atrasadas
        ];

        // 2. Limpezas de Hoje (Live Status)
        $todaysCleanings = CleaningSchedule::with(['accommodation', 'users'])
            ->whereHas('accommodation', function($q) use ($companyId) {
                $q->where('company_id', $companyId);
            })
            ->whereDate('scheduled_date', Carbon::today())
            ->orderBy('scheduled_time')
            ->get();

        // 3. Próximas Limpezas (Resumo)
        $upcomingCleanings = CleaningSchedule::with('accommodation')
            ->whereHas('accommodation', function($q) use ($companyId) {
                $q->where('company_id', $companyId);
            })
            ->where('scheduled_date', '>', Carbon::today())
            ->orderBy('scheduled_date')
            ->take(5)
            ->get();

        return view('dashboard.manager', compact('stats', 'todaysCleanings', 'upcomingCleanings'));
    }
}
