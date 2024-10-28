<?php

namespace App\Http\Controllers;
use App\Models\Tipo;
use App\Models\Complement;
use App\Models\Historial;
use Illuminate\Http\Request;

class ComplementController extends Controller
{
    public function __construct()
    {
        $this->middleware('can:complements.index')->only('index');
        $this->middleware('can:complements.create')->only('create', 'store');
        $this->middleware('can:complements.edit')->only('edit', 'update');
        $this->middleware('can:complements.show')->only('show');
        $this->middleware('can:complements.destroy')->only('destroy');
    }
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $equipos = Complement::with('type')->get();

        return view('equipos.complements.index', compact('equipos'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $tipo = $request->input('type_id');
        
        $user = auth()->id();

        $data = $request->validate([
            'type_id' => 'required',
            'brand' => 'required',
            'model' => 'required',
            'serial' => 'required|unique:complements,serial',
        ]);
        $registro = Complement::create($data);
        $registro->save();
        Historial::create([
            'accion' => 'Creacion',
            'descripcion' => "Se agrego {$registro->type->name} con N/S: {$registro->serial}",
            'user_id' => $user,
        ]);
        toastr()
            ->timeOut(3000) // 3 second
            ->addSuccess("Se creo {$registro->type->name} ({$registro->serial}) correctamente.");
        return redirect()->route('complements.index');
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        $user = auth()->id();

        $data = $request->validate([
            'brand' => 'required',
            'model' => 'required',
            'serial' => 'required|unique:complements,serial,' . $id,
        ]);

        $registro = Complement::findOrFail($id);
        $registro->update($data);

        Historial::create([
            'accion' => 'Actualizacion',
            'descripcion' => "Se actualizo el {$registro->type->name} con N/S: {$registro->serial}",
            'user_id' => $user,
        ]);
        toastr()
            ->timeOut(3000) // 3 second
            ->addSuccess("Se actualizo el {$registro->serial} correctamente.");

        return redirect()->route('complements.index');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $registro = Complement::findOrFail($id);
        $registro->delete();

        $user = auth()->id();

        Historial::create([
            'accion' => 'Eliminacion',
            'descripcion' => "Se elimino el {$registro->type->name} con N/S {$registro->serial}.",
            'user_id' => $user,
        ]);

        toastr()
            ->timeOut(3000) // 3 second
            ->addSuccess("Se elimino la {$registro->type->name}.");

        return redirect()->route('complements.index');
    }
}
