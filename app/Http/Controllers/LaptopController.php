<?php

namespace App\Http\Controllers;
use App\Models\Tipo;
use App\Models\Equipo;
use App\Models\Historial;
use Illuminate\Http\Request;

class LaptopController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $tipoLaptop = Tipo::where('name', 'LAPTOP')->first();

        $equipos = Equipo::where('tipo_id', $tipoLaptop->id)->get();

        // Iterar sobre los equipos y verificar si están asignados a un empleado
        foreach ($equipos as $equipo) {
            $equipo->estado = $equipo->empleados->isEmpty() ? 'Libre' : 'En Uso';
        }
        return view('equipos.laptops.index', compact('equipos'));
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
            'name' => 'required',
            'ip' => 'required',
            'so' => 'required',
        ]);
        $registro = Equipo::create($data);
        $registro->save();
        Historial::create([
            'accion' => 'Creacion',
            'descripcion' => "Se agrego la {$registro->tipo->name} con N/S: {$registro->serial}",
            'user_id' => $user,
        ]);
        toastr()
            ->timeOut(3000) // 3 second
            ->addSuccess("Se creo {$registro->name} correctamente.");
        return redirect()->route('laptops.index');
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        $user = auth()->id();

        $data = $request->validate([
            'marca' => 'required',
            'model' => 'required',
            'serial' => 'required',
            'name' => 'required',
            'ip' => 'required',
            'so' => 'required',
        ]);

        $registro = Equipo::findOrFail($id);
        $registro->update($data);

        Historial::create([
            'accion' => 'Actualizacion',
            'descripcion' => "Se actualizo el {$registro->tipo->name} de N/S: {$registro->serial}",
            'user_id' => $user,
        ]);
        toastr()
            ->timeOut(3000) // 3 second
            ->addSuccess("Se actualizo el {$registro->name} correctamente.");

        return redirect()->route('laptops.index');
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
            'descripcion' => "Se elimino el {$registro->tipo->name} con N/S: {$registro->serial} correctamente",
            'user_id' => $user,
        ]);

        toastr()
            ->timeOut(3000) // 3 second
            ->addSuccess("Se elimino el {$registro->name}.");

        return redirect()->route('laptops.index');
    }
}
