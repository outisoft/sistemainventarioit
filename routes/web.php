<?php

use App\Http\Controllers\ProfileController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\InventarioController;
use App\Http\Controllers\HistorialController;
use App\Http\Controllers\EmpleadoController;
use App\Http\Controllers\UserController;
use App\Http\Controllers\EquipoController;
use App\Http\Controllers\ChartController;

Route::middleware('auth')->group(function () {
    
    Route::get('/home', function () {return view('home');})->name('home');

    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');

    Route::resource('inventario', InventarioController::class);// Rutas Inventario
    Route::resource('empleados', EmpleadoController::class);// Rutas Empleados
    Route::resource('equipo', EquipoController::class);// Rutas Equipos
    Route::resource('users', UserController::class);// Rutas Usuario

    Route::get('/inventario/{id}/historial', [InventarioController::class, 'historial'])->name('inventario.historial');// Nueva ruta para mostrar el historial
    Route::get('/historial', [HistorialController::class, 'index'])->name('historial.index');//muestra view historial
    Route::get('/export', [InventarioController::class, 'export'])->name('export');//expotador de reporte en excel
    Route::post('/import', [InventarioController::class, 'import'])->name('import');//importador de reporte en excel

    Route::post('/asignar-rol/{usuarioId}/{rol}', [EmpleadoController::class, 'asignarRol'])->name('asignar.rol');

    Route::post('/empleados/search', [EmpleadoController::class, 'search'])->name('empleados.search');//buscador de empleados
    Route::post('/inventario/search', [InventarioController::class, 'search'])->name('inventario.search');//buscador de inventario
    Route::post('/users/search', [UserController::class, 'search'])->name('users.search');//buscador de usuarios
    Route::post('/equipo/search', [EquipoController::class, 'search'])->name('equipo.search');//buscador de usuarios

    Route::get('/asignacion', [EmpleadoController::class, 'agregar'])->name('asignacion.index');
    Route::post('/asignacion/asignar', [EmpleadoController::class, 'asignar'])->name('asignacion.asignar');
    Route::get('/asignacion/desvincular/{empleado_id}/{equipo_id}', [EmpleadoController::class, 'desvincular'])->name('asignacion.desvincular');

    Route::get('/grafica-usuarios', [ChartController::class, 'userChart'])->name('usuarios.chart');
    Route::get('/grafica-tablas', [ChartController::class, 'index'])->name('charts.index');

    // Ruta para la gráfica de usuarios
    Route::get('/usuarios-grafica', 'GraficaController@usuariosGrafica');

    // Ruta para la gráfica de empleados
    Route::get('/empleados-grafica', 'GraficaController@empleadosGrafica');

    // Ruta para la gráfica de equipos
    Route::get('/equipos-grafica', 'GraficaController@equiposGrafica');

});

Route::get('/', function () {
    return view('welcome');
});

//Route::get('/home', function () {return view('home');})->middleware(['auth', 'verified'])->name('home');


require __DIR__.'/auth.php';
