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

        $resultados = \DB::table('employees')
            ->join('positions', 'employees.position_id', '=', 'positions.id')
            ->leftJoin('phone_position', 'positions.id', '=', 'phone_position.position_id')
            ->leftJoin('phones', 'phone_position.phone_id', '=', 'phones.id')
            ->select(
                'employees.name as nombre',
                'positions.position as puesto',
                'positions.department as departamento',
                'employees.hotel as hotel',
                'phones.extension as extension',
                'employees.email as correo'
            )
            ->when($termino, function ($query) use ($termino) {
                $query->where(function($q) use ($termino) {
                    $q->where('employees.name', 'LIKE', "%{$termino}%")
                      ->orWhere('positions.position', 'LIKE', "%{$termino}%")
                      ->orWhere('positions.department', 'LIKE', "%{$termino}%")
                      ->orWhere('employees.hotel', 'LIKE', "%{$termino}%")
                      ->orWhere('phones.extension', 'LIKE', "%{$termino}%")
                      ->orWhere('employees.email', 'LIKE', "%{$termino}%");
                });
            })
            ->orderBy('employees.name')
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
