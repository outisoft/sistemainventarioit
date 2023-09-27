<?php

use App\Http\Controllers\ProfileController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\InventarioController;
use App\Http\Controllers\HistorialController;
use App\Http\Controllers\EmpleadoController;
use App\Http\Controllers\UserController;



Route::middleware('auth')->group(function () {
    Route::resource('inventario', InventarioController::class);// Rutas Inventario
    Route::resource('empleados', EmpleadoController::class);// Rutas Empleados
    Route::get('/inventario/{id}/historial', [InventarioController::class, 'historial'])->name('inventario.historial');// Nueva ruta para mostrar el historial
    Route::get('/historial', [HistorialController::class, 'index'])->name('historial.index');//muestra view historial
    Route::get('/export', [InventarioController::class, 'export'])->name('export');//expotador de reporte en excel
    Route::post('/asignar-rol/{usuarioId}/{rol}', [EmpleadoController::class, 'asignarRol'])->name('asignar.rol');
    Route::resource('users', UserController::class);// Rutas Usuario
    Route::post('/empleados/search', [EmpleadoController::class, 'search'])->name('empleados.search');//buscador de empleados
    Route::post('/inventario/search', [InventarioController::class, 'search'])->name('inventario.search');//buscador de inventario
    Route::post('/users/search', [UserController::class, 'search'])->name('users.search');//buscador de usuarios

});

Route::get('/', function () {
    return view('welcome');
});

Route::get('/dashboard', function () {
    return view('dashboard');
})->middleware(['auth', 'verified'])->name('dashboard');

Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

require __DIR__.'/auth.php';
