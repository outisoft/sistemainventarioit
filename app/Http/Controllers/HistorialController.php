<?php

namespace App\Http\Controllers;

use App\Models\Historial;
use Illuminate\Http\Request;
use Carbon\Carbon;

class HistorialController extends Controller
{
    public function index()
    {
        $historial = Historial::with('user')->latest()->get();

        $diaActual = Carbon::now()->isoFormat('dddd D de MMMM del Y');
        // Ejemplo: "jueves 4 de junio del 2020"

        return view('historial.index', compact('historial', 'diaActual'));
    }
}
