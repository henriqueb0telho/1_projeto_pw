<?php

use App\Http\Controllers\Admin\CompanyController;
use App\Http\Controllers\Admin\UserController;
use App\Http\Controllers\Admin\AccommodationController;
use App\Http\Controllers\Manager\CleaningScheduleController;
use App\Http\Controllers\Cleaner\CleanerController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\CleanerDashboardController;

Route::get('/', function () {
    return view('landing');
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
Route::prefix('admin')->middleware(['auth', 'verified', 'role:admin'])->group(function () {
    /* ADMIN - COMPANIES */
    Route::get('/companies', [CompanyController::class, 'index'])->name('admin.companies.index');
    Route::get('/companies/create', [CompanyController::class, 'create'])->name('admin.companies.create');
    Route::post('/companies', [CompanyController::class, 'store'])->name('admin.companies.store');
    Route::get('/companies/{company}', [CompanyController::class, 'show'])->name('admin.companies.show');
    Route::get('/companies/{company}/edit', [CompanyController::class, 'edit'])->name('admin.companies.edit');
    Route::put('/companies/{company}', [CompanyController::class, 'update'])->name('admin.companies.update');
    Route::delete('/companies/{company}', [CompanyController::class, 'destroy'])->name('admin.companies.destroy');
    Route::get('/companies/export', [CompanyController::class, 'export'])->name('admin.companies.export');

    /* ADMIN - USERS */
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

    /* ADMIN - ACCOMMODATIONS */
    Route::get('/accommodations', [AccommodationController::class, 'index'])->name('admin.accommodations.index');
    Route::get('/accommodations/create', [AccommodationController::class, 'create'])->name('admin.accommodations.create');
    Route::post('/accommodations', [AccommodationController::class, 'store'])->name('admin.accommodations.store');
    Route::get('/accommodations/{accommodation}', [AccommodationController::class, 'show'])->name('admin.accommodations.show');
    Route::get('/accommodations/{accommodation}/edit', [AccommodationController::class, 'edit'])->name('admin.accommodations.edit');
    Route::put('/accommodations/{accommodation}', [AccommodationController::class, 'update'])->name('admin.accommodations.update');
    Route::patch('/accommodations/{accommodation}/toggle-status', [AccommodationController::class, 'toggleStatus'])->name('admin.accommodations.toggle-status');
    Route::delete('/accommodations/{accommodation}', [AccommodationController::class, 'destroy'])->name('admin.accommodations.destroy');
    Route::get('/accommodations/export', [AccommodationController::class, 'export'])->name('admin.accommodations.export');
});


// Manager Users Routes
Route::prefix('manager')->middleware(['auth', 'verified', 'role:manager'])->group(function () {
    /* MANAGER - CLEANINGS */
    Route::get('/cleanings', [CleaningScheduleController::class, 'index'])->name('manager.cleanings.index');
    Route::get('/cleanings/create', [CleaningScheduleController::class, 'create'])->name('manager.cleanings.create');
    Route::post('/cleanings', [CleaningScheduleController::class, 'store'])->name('manager.cleanings.store');
    Route::post('/schedules/reschedule/{reschedule}', [CleaningScheduleController::class, 'handleReschedule'])->name('manager.cleanings.handle-reschedule');
    Route::get('/cleanings/{schedule}', [CleaningScheduleController::class, 'show'])->name('manager.cleanings.show');
    Route::get('/cleanings/{schedule}/edit', [CleaningScheduleController::class, 'edit'])->name('manager.cleanings.edit');
    Route::put('/cleanings/{schedule}', [CleaningScheduleController::class, 'update'])->name('manager.cleanings.update');
    Route::delete('/cleanings/{schedule}', [CleaningScheduleController::class, 'destroy'])->name('manager.cleanings.destroy');
});


Route::prefix('cleaner')->middleware(['auth', 'verified', 'role:cleaner'])->group(function () {
    Route::get('/agenda', [CleanerController::class, 'dashboard'])->name('cleaner.dashboard');
    Route::post('/respond/{assignment}', [CleanerController::class, 'respond'])->name('cleaner.respond');
    Route::post('/reschedule/{assignment}', [CleanerController::class, 'requestReschedule'])->name('cleaner.reschedule');
    Route::post('/update-status/{assignment}', [CleanerController::class, 'updateStatus'])->name('cleaner.update_status');
});
