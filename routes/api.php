<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "api" middleware group. Make something great!
|
*/

Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
    return $request->user();
});

Route::get('/hoteles/{hotel}/departamentos', [HotelController::class, 'getDepartamentos']); //new

Route::get('/hotels/{hotel}/villas', function ($hotelId) {
    return response()->json(
        \App\Models\Villa::where('hotel_id', $hotelId)
            ->select('id', 'name')
            ->get()
    );
});

Route::get('/villas/{villa}/rooms', function (string $villaId) {
    try {
        $rooms = \App\Models\Room::where('villa_id', $villaId)
            ->with('region') // Si necesitas datos de la región
            ->orderBy('number')
            ->get(['id', 'number', 'region_id']);
        
        return response()->json($rooms);
    } catch (\Exception $e) {
        return response()->json([
            'error' => 'Error al cargar habitaciones',
            'details' => $e->getMessage()
        ], 500);
    }
});

Route::get('/hotels/{hotel}/specific-locations', function ($hotelId) {
    return response()->json(
        \App\Models\SpecificLocation::where('hotel_id', $hotelId)
            ->select('id', 'name')
            ->get()
    );
});