<?php

namespace App\Http\Controllers;
use App\Models\Historial;
use Illuminate\Http\Request;

class HistorialController extends Controller
{
    public function index()
    {
        $historial = Historial::all();

        return view('historial.index', compact('historial'));
    }
}
