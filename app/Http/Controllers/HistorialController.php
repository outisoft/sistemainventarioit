<?php

namespace App\Http\Controllers;

use App\Models\Historial;
use App\Models\Region;
use Illuminate\Http\Request;
use Carbon\Carbon;

class HistorialController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
        $this->middleware('can:historial.index')->only('index');
    }
    public function index()
    {
        $historial = Historial::with(['region', 'user'])
            ->when(!auth()->user()->hasRole('Administrator'), function ($query) {
                $regionIds = auth()->user()->regions->pluck('id');
                if ($regionIds->isNotEmpty()) {
                    $query->whereHas('region', function ($q) use ($regionIds) {
                        $q->whereIn('regions.id', $regionIds);
                    });
                }
            })
            ->latest()
            ->get();

        $diaActual = Carbon::now()->isoFormat('dddd D de MMMM del Y');
        // Ejemplo: "jueves 4 de junio del 2020"
        $regions = Region::orderBy('name', 'asc')->get();

        return view('historial.index', compact('regions', 'historial', 'diaActual'));
    }
}
