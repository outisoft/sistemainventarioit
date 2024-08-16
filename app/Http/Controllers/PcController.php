<?php

namespace App\Http\Controllers;

use App\Models\Tipo;
use App\Models\Equipo;
use App\Models\Historial;
use Illuminate\Http\Request;

class PcController extends Controller
{
    public function index()
    {
        $tipoLaptop = Tipo::where('name', 'DESKTOP')->first();

        $equipos = Equipo::where('tipo_id', $tipoLaptop->id)->get();

        // Iterar sobre los equipos y verificar si están asignados a un empleado
        foreach ($equipos as $equipo) {
            $equipo->estado = $equipo->empleados->isEmpty() ? 'Libre' : 'En Uso';
        }
        return view('pc.index', compact('equipos'));
    }

    public function create()
    {
        $empleados = Empleado::all();
        return view('pc.create', compact('empleados'));
    }

    public function store(Request $request)
    {
        //dd($request);
        $tipo = $request->input('tipo_id');
        
        $user = auth()->id();

        $data = $request->validate([
            'tipo_id' => 'required',
            'marca' => 'required',
            'model' => 'required',
            'serial' => 'required',
            'name' => 'required',
            'ip' => 'required',
        ]);
        $registro = Equipo::create($data);
        $registro->save();
        Historial::create([
            'accion' => 'Creacion',
            'descripcion' => "Se agrego la {$registro->tipo->name} - {$registro->name}",
            'user_id' => $user,
        ]);
        toastr()
            ->timeOut(3000) // 3 second
            ->addSuccess("Se creo {$registro->name} correctamente.");
        return redirect()->route('pc.index');
    }

    public function update(Request $request, $id)
    {
        //$tipo = $request->input('tipo_id');
        $user = auth()->id();

        $data = $request->validate([
            'marca' => 'required',
            'model' => 'required',
            'serial' => 'required',
            'name' => 'required',
            'ip' => 'required',
        ]);

        $registro = Equipo::findOrFail($id);
        //dd($data);
        $registro->update($data);

        Historial::create([
            'accion' => 'Actualizacion',
            'descripcion' => "Se actualizo el {$registro->tipo->name} del equipo {$registro->name}",
            'user_id' => $user,
        ]);
        toastr()
            ->timeOut(3000) // 3 second
            ->addSuccess("Se actualizo el {$registro->name} correctamente.");

        return redirect()->route('pc.index');

    }

    public function destroy(string $id)
    {
        $registro = Equipo::findOrFail($id);
        $registro->delete();

        $user = auth()->id();

        Historial::create([
            'accion' => 'Eliminacion',
            'descripcion' => "Se elimino el {$registro->tipo->name} - {$registro->name} correctamente",
            'user_id' => $user,
        ]);

        toastr()
            ->timeOut(3000) // 3 second
            ->addSuccess("Se elimino el {$registro->tipo->name}.");

        return redirect()->route('pc.index');
    }

    // Implementa los demás métodos (show, edit, update, destroy) según sea necesario
}