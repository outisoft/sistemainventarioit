<?php

namespace App\Http\Controllers;
use App\Models\Tipo;
use App\Models\Equipo;
use App\Models\Historial;
use Illuminate\Http\Request;

class PrinterController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $tipoLaptop = Tipo::where('name', 'IMPRESORA')->first();

        $equipos = Equipo::where('tipo_id', $tipoLaptop->id)->get();

        // Iterar sobre los equipos y verificar si están asignados a un empleado
        foreach ($equipos as $equipo) {
            $equipo->estado = $equipo->empleados->isEmpty() ? 'Libre' : 'En Uso';
        }

        return view('equipos.printers.index', compact('equipos'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $tipo = $request->input('tipo_id');
        
        $user = auth()->id();

        $data = $request->validate([
            'tipo_id' => 'required',
            'marca' => 'required',
            'model' => 'required',
            'serial' => 'required',
            'ip' => 'required',
        ]);
        $registro = Equipo::create($data);
        $registro->save();
        Historial::create([
            'accion' => 'Creacion',
            'descripcion' => "Se agrego la {$registro->tipo->name} con S/N: {$registro->serial}",
            'user_id' => $user,
        ]);
        toastr()
            ->timeOut(3000) // 3 second
            ->addSuccess("Se creo {$registro->tipo->name} ({$registro->serial}) correctamente.");
        return redirect()->route('printers.index');
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, $id)
    {
        $user = auth()->id();

        $data = $request->validate([
            'marca' => 'required',
            'model' => 'required',
            'serial' => 'required',
            'ip' => 'required',
        ]);

        $registro = Equipo::findOrFail($id);
        //dd($data);
        $registro->update($data);

        Historial::create([
            'accion' => 'Actualizacion',
            'descripcion' => "Se actualizo la {$registro->tipo->name} con N/S: {$registro->serial}",
            'user_id' => $user,
        ]);
        toastr()
            ->timeOut(3000) // 3 second
            ->addSuccess("Se actualizo el {$registro->serial} correctamente.");

        return redirect()->route('printers.index');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $registro = Equipo::findOrFail($id);
        $registro->delete();

        $user = auth()->id();

        Historial::create([
            'accion' => 'Eliminacion',
            'descripcion' => "Se elimino la {$registro->tipo->name} con N/S {$registro->name} correctamente",
            'user_id' => $user,
        ]);

        toastr()
            ->timeOut(3000) // 3 second
            ->addSuccess("Se elimino la {$registro->tipo->name}.");

        return redirect()->route('printers.index');
    }
}
