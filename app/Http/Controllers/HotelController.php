<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class HotelController extends Controller
{
    
    public function getDepartamentos(Hotel $hotel)
    {
        try {
            $departamentos = $hotel->departamentos;
            return response()->json($departamentos);
        } catch (\Exception $e) {
            \Log::error('Error en getDepartamentos: ' . $e->getMessage());
            return response()->json(['error' => $e->getMessage()], 500);
        }
    }
}
