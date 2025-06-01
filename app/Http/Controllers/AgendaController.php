<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Empleado; // Asegúrate de tener estos modelos creados
use App\Models\Puesto;
use App\Models\Phone;

class AgendaController extends Controller
{
    public function index()
    {
        return view('agenda.index');
    }

    public function buscar(Request $request)
    {
        $termino = $request->input('q');
        
        $resultados = Empleado::select(
                'empleados.nombre as nombre',
                'empleados.puesto as puesto',
                'empleados.departments.name as departamento',
                'empleados.hotel.name as hotel',
                'empleados.email as correo'
            )
            ->when($termino, function ($query) use ($termino) {
                return $query->where(function($q) use ($termino) {
                    $q->where('empleados.nombre', 'LIKE', "%{$termino}%")
                      ->orWhere('puestos.nombre', 'LIKE', "%{$termino}%")
                      ->orWhere('puestos.department.name', 'LIKE', "%{$termino}%")
                      ->orWhere('empleados.hotel.name', 'LIKE', "%{$termino}%")
                      ->orWhere('empleados.email', 'LIKE', "%{$termino}%");
                });
            })
            ->orderBy('empleados.name')
            ->get();

        return response()->json($resultados);
    }

    public function buscar2(Request $request)
    {
        $termino = $request->input('q');
        
        $resultados = Empleado::select(
                'empleados.nombre as nombre',
                'puestos.nombre as puesto',
                'puestos.departamento as departamento',
                'empleados.hotel as hotel',
                'telefonos.extension as extension',
                'empleados.email as correo'
            )
            ->join('puestos', 'empleados.puesto_id', '=', 'puestos.id')
            ->join('telefonos', 'empleados.id', '=', 'telefonos.empleado_id')
            ->when($termino, function ($query) use ($termino) {
                return $query->where(function($q) use ($termino) {
                    $q->where('empleados.nombre', 'LIKE', "%{$termino}%")
                      ->orWhere('puestos.nombre', 'LIKE', "%{$termino}%")
                      ->orWhere('puestos.departamento', 'LIKE', "%{$termino}%")
                      ->orWhere('empleados.hotel', 'LIKE', "%{$termino}%")
                      ->orWhere('telefonos.extension', 'LIKE', "%{$termino}%")
                      ->orWhere('empleados.email', 'LIKE', "%{$termino}%");
                });
            })
            ->orderBy('empleados.nombre')
            ->get();

        return response()->json($resultados);
    }
}
