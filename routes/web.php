<?php
use App\Http\Controllers\ClienteController;
use App\Http\Controllers\PagoController;
use App\Http\Controllers\HistorialController;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\RecepcionistaController;
use Illuminate\Support\Facades\Route;

// Ruta raíz
Route::get('/', function () {
    return redirect()->route('login');
});

// Rutas protegidas por autenticación
Route::middleware('auth')->group(function () {

    // Dashboard
    Route::get('/dashboard', [DashboardController::class, 'index'])->name('dashboard');

    // Clientes - todos los usuarios autenticados pueden ver y registrar
    Route::resource('clientes', ClienteController::class)->only([
        'index', 'create', 'store', 'show'
    ]);

    // Clientes - solo el dueño puede editar y eliminar
    Route::resource('clientes', ClienteController::class)->only([
        'edit', 'update', 'destroy'
    ])->middleware('rol:dueno');

    // Pagos - todos los usuarios autenticados
    Route::resource('pagos', PagoController::class)->only([
        'index', 'create', 'store', 'show'
    ]);

    // Historial - solo el dueño
    Route::get('/historial', [HistorialController::class, 'index'])
        ->middleware('rol:dueno')
        ->name('historial.index');

    // Recepcionistas - solo el dueño
    Route::resource('recepcionistas', RecepcionistaController::class)->only([
        'index', 'create', 'store', 'destroy'
    ])->middleware('rol:dueno');

});

require __DIR__.'/auth.php';