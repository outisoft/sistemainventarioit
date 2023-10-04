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
        // Filtrar equipos por tipo
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
        
        $tipo = $request->input('tipo');

        // Guarda los datos en la tabla correspondiente según el tipo de equipo
        switch ($tipo) {
            case 'cpu':
                // Guarda en la tabla de CPUs
                $data = $request->validate([
                    'tipo' => 'required',
                    'no_equipo' => 'required',
                    'estado' => 'required',
                    'equipo' => 'required',
                    'marca_equipo' => 'required',
                    'modelo_equipo' => 'required',
                    'serie_equipo' => 'required',
                    'nombre_equipo' => 'required',
                    'ip' => 'required',
                    'contrato' => 'required',
                ]);
                $registro = Equipo::create($data);
                $registro->marca = $request->input('marca_equipo');
                $registro->modelo = $request->input('modelo_equipo');
                $registro->serie = $request->input('serie_equipo');
                $registro->no_contrato = $request->input('contrato');
                $registro->save();
                Historial::create([
                    'accion' => 'creacion',
                    'descripcion' => "Se creó el registro {$registro->tipo}",
                    'registro_id' => $registro->id,
                ]);
                return response()->json(['message' => 'Registro creado exitosamente']); 

                break;

            case 'monitor':
                // Guarda en la tabla de monitores
                $data = $request->validate([
                    'tipo' => 'required',
                    'marca_monitor' => 'required',
                    'modelo_monitor' => 'required',
                    'serie_monitor' => 'required',
                    'no_contrato' => 'required',
                ]);
                $registro = Equipo::create($data);
                $registro->marca = $request->input('marca_monitor');
                $registro->modelo = $request->input('modelo_monitor');
                $registro->serie = $request->input('serie_monitor');
                $registro->save();
                Historial::create([
                    'accion' => 'creacion',
                    'descripcion' => "Se creó el registro {$registro->tipo}",
                    'registro_id' => $registro->id,
                ]);
                return response()->json(['message' => 'Registro creado exitosamente']); 
                break;

            case 'teclado':
                // Guarda en la tabla de teclados
                $data = $request->validate([
                    'tipo' => 'required',
                    'marca_teclado' => 'required',
                    'serie_teclado' => 'required',
                ]);
                $registro = Equipo::create($data);
                $registro->marca = $request->input('marca_teclado');
                $registro->serie = $request->input('serie_teclado');
                $registro->save();
                Historial::create([
                    'accion' => 'creacion',
                    'descripcion' => "Se creó el registro {$registro->tipo}",
                    'registro_id' => $registro->id,
                ]);
                return response()->json(['message' => 'Registro creado exitosamente']); 
                break;
            
            case 'mouse':
                // Guarda en la tabla de MOUSES
                $data = $request->validate([
                    'tipo' => 'required',
                    'marca_mouse' => 'required',
                    'serie_mouse' => 'required',
                ]);
                $registro = Equipo::create($data);
                $registro->marca = $request->input('marca_mouse');
                $registro->serie = $request->input('serie_mouse');
                $registro->save();
                Historial::create([
                    'accion' => 'creacion',
                    'descripcion' => "Se creó el registro {$registro->tipo}",
                    'registro_id' => $registro->id,
                ]);
                return response()->json(['message' => 'Registro creado exitosamente']); 
                break;
            
            case 'cargador':
                // Guarda en la tabla de MOUSES
                $data = $request->validate([
                    'tipo' => 'required',
                    'marca_cargador' => 'required',
                    'modelo_cargador' => 'required',
                    'serie_cargador' => 'required',
                ]);
                $registro = Equipo::create($data);
                $registro->marca = $request->input('marca_cargador');
                $registro->modelo = $request->input('modelo_cargador');
                $registro->serie = $request->input('serie_cargador');
                $registro->save();
                Historial::create([
                    'accion' => 'creacion',
                    'descripcion' => "Se creó el registro {$registro->tipo}",
                    'registro_id' => $registro->id,
                ]);
                return response()->json(['message' => 'Registro creado exitosamente']); 
                break;

            case 'no_breack':
                // Guarda en la tabla de MOUSES
                $data = $request->validate([
                    'tipo' => 'required',
                    'marca_breack' => 'required',
                    'modelo_breack' => 'required',
                    'serie_breack' => 'required',
                ]);
                $registro = Equipo::create($data);
                $registro->marca = $request->input('marca_breack');
                $registro->modelo = $request->input('modelo_breack');
                $registro->serie = $request->input('serie_breack');
                $registro->save();
                Historial::create([
                    'accion' => 'creacion',
                    'descripcion' => "Se creó el registro {$registro->tipo}",
                    'registro_id' => $registro->id,
                ]);
                return response()->json(['message' => 'Registro creado exitosamente']); 
                break;
            
            case 'impresora':
                // Guarda en la tabla de MOUSES
                $data = $request->validate([
                    'tipo' => 'required',
                    'marca_impresora' => 'required',
                    'modelo_impresora' => 'required',
                    'serie_impresora' => 'required',
                ]);
                $registro = Equipo::create($data);
                $registro->marca = $request->input('marca_impresora');
                $registro->modelo = $request->input('modelo_impresora');
                $registro->serie = $request->input('serie_impresora');
                $registro->save();
                Historial::create([
                    'accion' => 'creacion',
                    'descripcion' => "Se creó el registro {$registro->tipo}",
                    'registro_id' => $registro->id,
                ]);
                return response()->json(['message' => 'Registro creado exitosamente']); 
                break;

            case 'lector':
                // Guarda en la tabla de MOUSES
                $data = $request->validate([
                    'tipo' => 'required',
                    'marca_lector' => 'required',
                    'modelo_lector' => 'required',
                    'serie_lector' => 'required',
                ]);
                $registro = Equipo::create($data);
                $registro->marca = $request->input('marca_lector');
                $registro->modelo = $request->input('modelo_lector');
                $registro->serie = $request->input('serie_lector');
                $registro->save();
                Historial::create([
                    'accion' => 'creacion',
                    'descripcion' => "Se creó el registro {$registro->tipo}",
                    'registro_id' => $registro->id,
                ]);
                return response()->json(['message' => 'Registro creado exitosamente']); 
                break;

            case 'scanner':
                // Guarda en la tabla de MOUSES
                $data = $request->validate([
                    'tipo' => 'required',
                    'marca_escanner' => 'required',
                    'modelo_escanner' => 'required',
                    'serie_escanner' => 'required',
                ]);
                $registro = Equipo::create($data);
                $registro->marca = $request->input('marca_escanner');
                $registro->modelo = $request->input('modelo_escanner');
                $registro->serie = $request->input('serie_escanner');
                $registro->save();
                Historial::create([
                    'accion' => 'creacion',
                    'descripcion' => "Se creó el registro {$registro->tipo}",
                    'registro_id' => $registro->id,
                ]);
                return response()->json(['message' => 'Registro creado exitosamente']); 
                break;

            case 'aplicacion':
                // Guarda en la tabla de MOUSES
                $data = $request->validate([
                    'tipo' => 'required',
                    'nombre_app' => 'required',
                    'clave_app' => 'required',
                ]);
                $registro = Equipo::create($data);
                $registro->clave = $request->input('clave_app');
                $registro->save();
                Historial::create([
                    'accion' => 'creacion',
                    'descripcion' => "Se creó el registro {$registro->tipo}",
                    'registro_id' => $registro->id,
                ]);
                return response()->json(['message' => 'Registro creado exitosamente']); 
                break;

            case 'so':
                // Guarda en la tabla de MOUSES
                $data = $request->validate([
                    'tipo' => 'required',
                    'so' => 'required',
                    'clave_so' => 'required',
                ]);
                $registro = Equipo::create($data);
                $registro->clave = $request->input('clave_so');
                $registro->save();
                Historial::create([
                    'accion' => 'creacion',
                    'descripcion' => "Se creó el registro {$registro->tipo}",
                    'registro_id' => $registro->id,
                ]);
                return response()->json(['message' => 'Registro creado exitosamente']); 
                break;

            case 'office':
                // Guarda en la tabla de MOUSES
                $data = $request->validate([
                    'tipo' => 'required',
                    'office' => 'required',
                    'clave_office' => 'required',
                ]);
                $registro = Equipo::create($data);
                $registro->clave = $request->input('clave_office');
                $registro->save();
                Historial::create([
                    'accion' => 'creacion',
                    'descripcion' => "Se creó el registro {$registro->tipo}",
                    'registro_id' => $registro->id,
                ]);
                return response()->json(['message' => 'Registro creado exitosamente']); 
                break;
            // Agrega más casos para otros tipos de equipo aquí
        }      
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
                            ->orWhere('marca', 'like', '%' . $query . '%')
                            ->orWhere('estado', 'like', '%' . $query . '%')
                            ->get();

        return view('equipos._employee_list', compact('equipos'));
    }
}
