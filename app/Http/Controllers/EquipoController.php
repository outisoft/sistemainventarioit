<?php

namespace App\Http\Controllers;

use App\Models\Equipo;
use App\Models\Historial;
use Illuminate\Http\Request;

class EquipoController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {   
        $equipos = Equipo::all();
        return view('equipos.index', compact('equipos'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('equipos.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $data = $request->validate([
            'tipo' => 'required',
            'no_equipo' => '',
            'estado' => '',
            'equipo' => '',
            'marca' => '',
            'modelo' => '',
            'serie' => '',
            'nombre_equipo' => '',
            'ip' => '',
            'no_contrato' => '',
            'so' => '',
            'office' => '',
            'clave' => '',
        ]);
        dd($request);

        $registro = Equipo::create($data);

        Historial::create([
            'accion' => 'creacion',
            'descripcion' => "Se creó el registro {$registro->tipo}",
            'registro_id' => $registro->id,
        ]);
        return response()->json(['message' => 'Registro creado exitosamente']); 
        //return redirect()->route('equipos.index')->with('success', 'Registro creado exitosamente.');
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        $registro = Equipo::findOrFail($id);
        return view('equipos.show', compact('registro'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        $registro = Equipo::findOrFail($id);
        return view('equipos.edit', compact('registro'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        $data = $request->validate([
            'tipo' => 'required',
        ]);

        $registro = Equipo::findOrFail($id);
        $registro->update($data);

        Historial::create([
            'accion' => 'actualizacion',
            'descripcion' => "Se actualizo el registro {$registro->tipo}",
            'registro_id' => $registro->id,
        ]);

        return redirect()->route('equipos.index')->with('success', 'Registro actualizado exitosamente.');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $registro = Equipo::findOrFail($id);
        $registro->delete();

        Historial::create([
            'accion' => 'Eliminacion',
            'descripcion' => "Se elimino el registro {$registro->tipo}",
            'registro_id' => $registro->id,
        ]);
        return response()->json(['message' => 'Eliminacion exitosa']);
        /*Session::flash('success', 'Registro eliminado exitosamente.');

        return Redirect::route('inventario.index');*/
    }

    public function search(Request $request)
    {
        $query = $request->get('query');
        $equipos = Equipo::where('tipo', 'like', '%' . $query . '%')
                            ->get();

        return view('equipos._employee_list', compact('equipos'));
    }
}
