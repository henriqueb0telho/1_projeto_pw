<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class DashboardController extends Controller
{
    public function index(Request $request)
    {
        $user = Auth::user();

        if ($user->isAdmin()) {
            return app(AdminDashboardController::class)->index();
        }

        if ($user->isManager()) {
            return app(ManagerDashboardController::class)->index();
        }

        if ($user->isCleaner()) {
            // Passamos o request porque o controller do cleaner usa filtros
            return app(CleanerDashboardController::class)->index($request);
        }

        return view('dashboard'); // Fallback
    }
}
