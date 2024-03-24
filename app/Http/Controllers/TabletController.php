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

        $request->validate([
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

        // Crear el usuario
        $tablet = Tablet::create([
            'operario' => $request->input('operario'),
            'puesto' => $request->input('puesto'),
            'email' => $request->input('email'),
            'usuario' => $request->input('usuario'),
            'password' => $request->input('password'),
            'numero_tableta' => $request->input('numero_tableta'),
            'serial' => $request->input('serial'),
            'numero_telefono' => $request->input('numero_telefono'),
            'imei' => $request->input('imei'),
            'sim' => $request->input('sim'),
            'politica' => $request->input('politica'),
            'configurada' => $request->input('configurada'),
            'carta_firmada' => $request->input('carta_firmada'),
            'observacion' => $request->input('observacion'),
            'giacode' => $request->input('giacode'),
            'personalsdscode' => $request->input('personalsdscode'),
            'folio_baja' => $request->input('folio_baja'),
        ]);
        //dd($request);

        Historial::create([
            'accion' => 'Creacion',
            'descripcion' => "Se creó el empleado {$tablet->name}",
            'registro_id' => $tablet->id,
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
    public function edit(Tablet $tablet)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Tablet $tablet)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Tablet $tablet)
    {
        //
    }
}
