<?php

namespace App\Http\Controllers;

use App\Models\User;
use App\Models\Empleado;
use App\Models\Equipo;
use Illuminate\Http\Request;

class ChartController extends Controller
{
    public function userChart()
    {
        //$data = User::all();
        $numUsuarios = User::count();
        $numEmpleados = Empleado::count();
        $numEquipos = Equipo::count();

        $data = [
            ['label' => 'Usuarios', 'value' => $numUsuarios],
            ['label' => 'Empleados', 'value' => $numEmpleados],
            ['label' => 'Equipos', 'value' => $numEquipos],
        ];      

        return view('users.chart')->with('data', $data);
    }
}
