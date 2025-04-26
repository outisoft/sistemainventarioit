<?php
namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Room;
use Illuminate\Http\Request;

class RoomController extends Controller
{
    public function index(Request $request)
    {
        $villaId = $request->query('villa_id');

        if (!$villaId) {
            return response()->json(['error' => 'El parámetro villa_id es requerido'], 400);
        }

        $rooms = Room::where('villa_id', $villaId)->get();

        return response()->json($rooms);
    }
}
