<?php
//
//namespace App\Http\Controllers;
//
//use App\Models\User;
//use App\Models\Company;
//use App\Models\CleaningSchedule;
//use Illuminate\Http\Request;
//
//class AdminDashboardController extends Controller
//{
//    public function index()
//    {
//        // 1. Métricas Globais da Plataforma
//        $metrics = [
//            'total_companies' => Company::count(),
//            'total_users' => User::count(),
//            'active_cleanings' => CleaningSchedule::where('status', 'in_progress')->count(),
//            'revenue_month' => '€ 0,00', // Placeholder para futura integração de faturação
//        ];
//
//        // 2. Últimas Empresas Registadas
//        $latestCompanies = Company::latest()->take(5)->get();
//
//        // 3. Resumo de Atividade (Limpezas Recentes em toda a plataforma)
//        $recentActivity = CleaningSchedule::with(['accommodation.company'])
//            ->latest('updated_at')
//            ->take(8)
//            ->get();
//
//        return view('dashboard.admin', compact('metrics', 'latestCompanies', 'recentActivity'));
//    }
//}


namespace App\Http\Controllers;

use App\Models\User;
use App\Models\Company;
use App\Models\CleaningSchedule;
use App\Models\Accommodation;
use App\Models\CleaningAssignmentReschedule;
use Illuminate\Http\Request;
use Carbon\Carbon;

class AdminDashboardController extends Controller
{
    public function index()
    {
        // --- 1. KPI Cards (Indicadores Principais) ---

        $totalCompanies = Company::count();
        // Assumindo que todas contam como ativas, ou adicione ->where('status', 'active') se tiver essa coluna
        $activeCompanies = $totalCompanies;

        $totalUsers = User::count();
        $managersCount = User::where('role', 'manager')->count();
        $cleanersCount = User::where('role', 'cleaner')->count();

        $totalAccommodations = Accommodation::where('is_active', true)->count();

        // Limpezas dos últimos 30 dias
        $totalCleanings = CleaningSchedule::where('scheduled_date', '>=', now()->subDays(30))->count();
        $completedCleanings = CleaningSchedule::where('scheduled_date', '>=', now()->subDays(30))
            ->where('status', 'completed')
            ->count();

        // --- 2. Gráficos / Listas (Top Empresas e Atividade) ---

        // Top 5 Empresas (Ordenadas por nº de alojamentos para simplificar)
        // Precisamos calcular 'cleanings_count' manualmente pois a relação direta pode não existir no model Company
        $topCompanies = Company::withCount('accommodations')
            ->orderByDesc('accommodations_count')
            ->take(5)
            ->get()
            ->map(function ($company) {
                // Adiciona a contagem de limpezas à coleção para a view usar {{ $company->cleanings_count }}
                $company->cleanings_count = CleaningSchedule::whereHas('accommodation', function ($q) use ($company) {
                    $q->where('company_id', $company->id);
                })->count();
                return $company;
            });

        // Atividade Recente (Transformamos as últimas limpezas num formato genérico para a view)
        $recentActivity = CleaningSchedule::with(['accommodation.company'])
            ->latest('updated_at')
            ->take(5)
            ->get()
            ->map(function ($cleaning) {
                return (object)[
                    'company_name' => $cleaning->accommodation->company->name ?? 'Empresa N/A',
                    'description' => "Status atualizado para: " . ucfirst($cleaning->status) . " em " . $cleaning->accommodation->name,
                    'created_at' => $cleaning->updated_at,
                    'status' => $cleaning->status
                ];
            });

        // --- 3. Estado do Sistema (Barras de Progresso e Alertas) ---

        // Evita divisão por zero
        $completionRate = $totalCleanings > 0 ? round(($completedCleanings / $totalCleanings) * 100) : 0;

        $scheduledCleanings = CleaningSchedule::where('status', 'scheduled')
            ->whereBetween('scheduled_date', [now(), now()->addDays(7)])
            ->count();

        $rescheduleRequests = CleaningAssignmentReschedule::where('status', 'pending')->count();

        // Retorna a view com TODAS as variáveis que o novo HTML exige
        return view('dashboard.admin', compact(
            'totalCompanies',
            'activeCompanies',
            'totalUsers',
            'managersCount',
            'cleanersCount',
            'totalAccommodations',
            'totalCleanings',
            'completedCleanings',
            'topCompanies',
            'recentActivity',
            'completionRate',
            'scheduledCleanings',
            'rescheduleRequests'
        ));
    }
}
