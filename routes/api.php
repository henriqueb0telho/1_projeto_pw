<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Cleaner\CleanerController;
use App\Http\Controllers\Admin\AccommodationController;
use App\Http\Controllers\Admin\CompanyController;
use App\Http\Controllers\Admin\UserController;
use App\Http\Controllers\Manager\CleaningScheduleController;

/*
|--------------------------------------------------------------------------
| API RESTful Routes
|--------------------------------------------------------------------------
*/

// Rota de verificação do utilizador autenticado (Sanctum)
Route::get('/user', function (Request $request) {
    return $request->user();
})->middleware('auth:sanctum');

// Proteção global com Sanctum
Route::middleware('auth:sanctum')->group(function () {

    /**
     * RECURSOS PARA TRABALHADORES (CLEANERS)
     * Focado na execução das tarefas
     */
    Route::prefix('cleaner')->group(function () {
        // GET /api/cleaner/assignments - Lista tarefas atribuídas
        Route::get('/assignments', [CleanerController::class, 'dashboard']);

        // PATCH /api/cleaner/assignments/{id}/status - Atualização parcial (estado)
        Route::patch('/assignments/{assignment}/status', [CleanerController::class, 'updateStatus']);

        // POST /api/cleaner/assignments/{id}/responses - Criar uma resposta (aceitar/rejeitar)
        Route::post('/assignments/{assignment}/responses', [CleanerController::class, 'respond']);

        // POST /api/cleaner/assignments/{id}/reschedule - Solicitar reagendamento
        Route::post('/assignments/{assignment}/reschedule', [CleanerController::class, 'requestReschedule']);
    });

    /**
     * RECURSOS PARA GESTORES (MANAGERS)
     * Focado no planeamento e gestão da empresa
     */
    Route::prefix('manager')->middleware('role:manager')->group(function () {
        // CRUD de Agendamentos (Schedules)
        Route::get('/schedules', [CleaningScheduleController::class, 'index']);
        Route::post('/schedules', [CleaningScheduleController::class, 'store']);
        Route::get('/schedules/{schedule}', [CleaningScheduleController::class, 'show']);
        Route::put('/schedules/{schedule}', [CleaningScheduleController::class, 'update']);
        Route::delete('/schedules/{schedule}', [CleaningScheduleController::class, 'destroy']);
    });

    /**
     * RECURSOS ADMINISTRATIVOS (ADMIN)
     * Focado na gestão global da plataforma
     */
    Route::prefix('admin')->middleware('role:admin')->group(function () {
        // Utilização de API Resources para alojamentos, empresas e utilizadores
        Route::apiResource('accommodations', AccommodationController::class);
        Route::apiResource('companies', CompanyController::class);
        Route::apiResource('users', UserController::class);

        // Rota específica para ações administrativas
        Route::patch('/users/{user}/toggle-status', [UserController::class, 'toggleStatus']);
    });
});
