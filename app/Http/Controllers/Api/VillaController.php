<?php
namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Villa;
use Illuminate\Http\Request;

class VillaController extends Controller
{
    public function index(Request $request)
    {
        $hotelId = $request->query('hotel_id');

        if (!$hotelId) {
            return response()->json(['error' => 'El parámetro hotel_id es requerido'], 400);
        }

        $villas = Villa::where('hotel_id', $hotelId)->get();

        return response()->json($villas);
    }
}
