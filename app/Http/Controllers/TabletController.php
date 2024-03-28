<?php

namespace App\Http\Controllers;

use App\Models\Tablet;
use App\Models\Historial;
use Illuminate\Http\Request;

class TabletController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $tablets = Tablet::get();
        return view('tablets.index', compact('tablets'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        //dd($request);

        $data = $request->validate([
            'operario' => 'required',
            'puesto' => 'required',
            'email' => ['required', 'string', 'email', 'max:255', 'unique:' . Tablet::class],
            'usuario' => 'required',
            'password' => 'required',
            'numero_tableta' => 'required',
            'serial' => 'required',
            'numero_telefono' => 'required',
            'imei' => 'required',
            'sim' => 'required',
            'politica' => 'required',
            'configurada' => 'required',
            'carta_firmada' => 'required',
            'observacion' => 'required',
            'giacode' => 'required',
            'personalsdscode' => 'required',
            'folio_baja' => 'required',
        ]);

        $registro = Tablet::create($data);

        //dd($request);

        Historial::create([
            'accion' => 'Creacion',
            'descripcion' => "Se creó el registro de tableta para {$registro->operario}",
            'registro_id' => $registro->id,
        ]);

        toastr()
            ->timeOut(3000) // 3 second
            ->addSuccess("Registro creado exitosamente.");

        return redirect()->route('tablets.index');
    }

    /**
     * Display the specified resource.
     */
    public function show(Tablet $tablet)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit($id)
    {
        $tablets = Tablet::findOrFail($id);

        //dd($configurada);
        return view('tablets.edit', compact('tablets'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, $id)
    {
        //dd($request);
        $data = $request->validate([
            'operario' => 'required',
            'puesto' => 'required',
            'email' => 'required|email',
            'usuario' => 'required',
            'password' => 'required',
            'numero_tableta' => 'required',
            'serial' => 'required',
            'numero_telefono' => 'required',
            'imei' => 'required',
            'sim' => 'required',
            'politica' => 'required',
            'configurada' => 'required',
            'carta_firmada' => 'required',
            'observacion' => 'required',
            'giacode' => 'required',
            'personalsdscode' => 'required',
            'folio_baja' => 'required',
        ]);

        $registro = Tablet::findOrFail($id);
        $registro->update($data);

        Historial::create([
            'accion' => 'actualizacion',
            'descripcion' => "Se actualizo el registro de {$registro->operario}",
            'registro_id' => $registro->id,
        ]);

        toastr()
            ->timeOut(3000) // 3 second
            ->addSuccess("Registro {$registro->operario} actualizado.");

        return redirect()->route('tablets.index');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Tablet $tablet)
    {
        //
    }
}
