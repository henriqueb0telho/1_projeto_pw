<?php
////
////use App\Http\Controllers\CleanerDashboardController;
////use App\Http\Controllers\CleaningScheduleController;
////use Illuminate\Support\Facades\Route;
////use App\Http\Controllers\AccommodationController;
////
////Route::get('/', function () {
////    return view('welcome');
////});
////
////Route::middleware([
////    'auth:sanctum',
////    config('jetstream.auth_session'),
////    'verified',
////])->group(function () {
////    Route::get('/dashboard', function () {
////        return view('dashboard');
////    })->name('dashboard');
////
////    // Admin-only routes
////    Route::middleware(['admin'])->group(function () {
////        Route::get('/admin/accommodations', [AccommodationController::class, 'index'])->name('accommodations.index');
////        Route::get('/admin/accommodations/{accommodation}', [AccommodationController::class, 'show'])->name('accommodations.show');
////
////        // Cleanings
////        Route::get('/admin/cleanings', [CleaningScheduleController::class, 'index'])->name('cleanings.index');
////        Route::get('/admin/cleanings/create', [CleaningScheduleController::class, 'create'])->name('cleanings.create');
////        Route::post('/admin/cleanings', [CleaningScheduleController::class, 'store'])->name('cleanings.store');
////        Route::get('/admin/cleanings/{cleaning}', [CleaningScheduleController::class, 'show'])->name('cleanings.show');
////        Route::get('/admin/cleanings/{cleaning}/edit', [CleaningScheduleController::class, 'edit'])->name('cleanings.edit');
////        Route::put('/admin/cleanings/{cleaning}', [CleaningScheduleController::class, 'update'])->name('cleanings.update');
////        Route::delete('/admin/cleanings/{cleaning}', [CleaningScheduleController::class, 'destroy'])->name('cleanings.destroy');
////    });
////});
////
////Route::prefix('cleaner')->name('cleaner.')->middleware(['auth'])->group(function () {
////    Route::get('/dashboard', [CleanerDashboardController::class, 'index'])->name('dashboard.index');
////    Route::patch('/dashboard/{cleaning}/update-status', [CleanerDashboardController::class, 'updateStatus'])->name('dashboard.update-status');
////});
//
//
//use Illuminate\Support\Facades\Route;
//use App\Http\Controllers\DashboardController;
//
//// O nosso novo Controller Principal
//use App\Http\Controllers\CleanerDashboardController;
//use App\Http\Controllers\CleaningScheduleController;
//use App\Http\Controllers\AccommodationController;
//
//// Se tiver o ManagerController, importe-o aqui também
//// use App\Http\Controllers\ManagerDashboardController;
//
//Route::get('/', function () {
//    return view('welcome');
//});
//
//Route::middleware([
//    'auth:sanctum',
//    config('jetstream.auth_session'),
//    'verified',
//])->group(function () {
//
//    // -----------------------------------------------------------------------------
//    // 1. ROTA CENTRAL DO DASHBOARD (A Mágica acontece aqui)
//    // -----------------------------------------------------------------------------
//    // Em vez de retornar uma view fixa, chamamos o método index() que verifica o papel
//    Route::get('/dashboard', [DashboardController::class, 'index'])->name('dashboard');
//
//
//    // -----------------------------------------------------------------------------
//    // 2. ROTAS ESPECÍFICAS DO CLEANER
//    // -----------------------------------------------------------------------------
//    // O Cleaner acede ao painel visualmente via /dashboard acima.
//    // Mas precisamos destas rotas para as ações dos botões (Update Status).
//    Route::prefix('cleaner')->name('cleaner.')->group(function () {
//        // Mudei para POST porque os formulários HTML nativos não suportam PATCH diretamente sem @method
//        // Se usar @method('PATCH') no form, pode manter Route::patch
//        Route::post('/dashboard/{cleaning}/update-status', [CleanerDashboardController::class, 'updateStatus'])->name('update-status');
//    });
//
//
//    // -----------------------------------------------------------------------------
//    // 3. ROTAS DE ADMINISTRAÇÃO
//    // -----------------------------------------------------------------------------
//    Route::middleware(['admin'])->prefix('admin')->group(function () {
//
//        // Alojamentos
//        Route::get('/accommodations', [AccommodationController::class, 'index'])->name('accommodations.index');
//        Route::get('/accommodations/{accommodation}', [AccommodationController::class, 'show'])->name('accommodations.show');
//
//        // Limpezas (Usando resource para simplificar o código, já que tem todos os métodos)
//        // Isto cria automaticamente: index, create, store, show, edit, update, destroy
//        Route::resource('cleanings', CleaningScheduleController::class);
//    });
//
//    // -----------------------------------------------------------------------------
//    // 4. ROTAS DE MANAGER (Futuro)
//    // -----------------------------------------------------------------------------
//    // Route::middleware(['manager'])->prefix('manager')->group(function () { ... });
//
//});


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
