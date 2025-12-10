<?php

use App\Http\Controllers\Admin\UserController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\CleanerDashboardController;

Route::get('/', function () {
    return view('welcome');
});

Route::middleware([
    'auth:sanctum',
    config('jetstream.auth_session'),
    'verified',
])->group(function () {
    // 1. A Rota Mestra (O Jetstream redireciona para aqui após login)
    // O DashboardController (que criámos antes) decide se chama o index do Cleaner, Admin ou Manager
    Route::get('/dashboard', [DashboardController::class, 'index'])->name('dashboard');

    // 2. Rotas de Ação do Cleaner (Para os botões funcionarem)
    Route::prefix('cleaner')->name('cleaner.')->group(function () {
        // Rota para Iniciar/Concluir tarefa (POST porque altera dados)
        Route::post('/task/{id}/update', [CleanerDashboardController::class, 'updateStatus'])
            ->name('update_status');
    });


});
// Admin Users Routes
Route::prefix('admin')->middleware(['auth', 'verified'])->group(function () {
    Route::get('/users', [UserController::class, 'index'])->name('admin.users.index');
    Route::get('/users/create', [UserController::class, 'create'])->name('admin.users.create');
    Route::post('/users', [UserController::class, 'store'])->name('admin.users.store');
    Route::get('/users/{user}', [UserController::class, 'show'])->name('admin.users.show');
    Route::post('/users/{user}/force-logout', [UserController::class, 'forceLogout'])->name('admin.users.force-logout');
    Route::get('/users/{user}/edit', [UserController::class, 'edit'])->name('admin.users.edit');
    Route::put('/users/{user}', [UserController::class, 'update'])->name('admin.users.update');
    Route::patch('/users/{user}/toggle-status', [UserController::class, 'toggleStatus'])->name('admin.users.toggle-status');
    Route::delete('/users/{user}', [UserController::class, 'destroy'])->name('admin.users.destroy');
    Route::get('/users/export', [UserController::class, 'export'])->name('admin.users.export');
});
