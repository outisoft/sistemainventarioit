<?php

namespace App\Http\Controllers;

use App\Models\Tpv;
use App\Models\Hotel;
use App\Models\Historial;
use Illuminate\Http\Request;

class TpvController extends Controller
{
    public function __construct()
    {
        $this->middleware('can:tpvs.index')->only('index');
        $this->middleware('can:tpvs.create')->only('create', 'store');
        $this->middleware('can:tpvs.edit')->only('edit', 'update');
        $this->middleware('can:tpvs.show')->only('show');
        $this->middleware('can:tpvs.destroy')->only('destroy');
    }

    public function index()
    {
        $hotels = Hotel::all();
        $tpvs = tpv::with('hotel')->orderBy('name', 'asc')->get();
        return view('tpvs.index', compact('tpvs','hotels'));
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
            'area' => 'required',
            'hotel_id' => 'required|exists:hotels,id',
            'equipment' => 'required',
            'brand' => 'required',
            'model' => 'required',
            'no_serial' => 'required',
            'name' => 'required',
            'ip' => 'required',
            'link' => 'required',
        ]);

        $registro = Tpv::create($data);

        //dd($request);

        Historial::create([
            'accion' => 'Creacion',
            'descripcion' => "Se registro la Tpv {$registro->name} correctamente",
            'registro_id' => $registro->id,
        ]);

        toastr()
            ->timeOut(3000) // 3 second
            ->addSuccess("Registro creado exitosamente.");

        return redirect()->route('tpvs.index');
    }

    /**
     * Display the specified resource.
     */
    public function show(Tpv $tpv)
    {
        $hotel = Hotel::find($tpv->hotel_id); 
        return view('tpvs.show', compact('tpv', 'hotel'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Tpv $tpv)
    {
        $hoteles = Hotel::all();
        return view('tpvs.edit', compact('tpv', 'hoteles'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, $id)
    {
        $data = $request->validate([
            'area' => 'required',
            'hotel_id' => 'required|exists:hotels,id',
            'equipment' => 'required',
            'brand' => 'required',
            'model' => 'required',
            'no_serial' => 'required',
            'name' => 'required',
            'ip' => 'required',
            'link' => 'required',
        ]);

        //dd($data);

        $registro = Tpv::findOrFail($id);
        $registro->update($data);

        Historial::create([
            'accion' => 'Actualizacion',
            'descripcion' => "Se actualizo la TPV {$registro->name} correctamente",
            'registro_id' => $registro->id,
        ]);
        // Mostrar notificación Toastr para éxito

        toastr()
            ->timeOut(3000) // 3 second
            ->addSuccess("Tpv {$registro->name} actualizado.");
        return redirect()->route('tpvs.index');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Tpv $tpv)
    {
        $tpv->delete();

        Historial::create([
            'accion' => 'Eliminacion',
            'descripcion' => "Se elimino la Tpv {$tpv->name} correctamente",
            'registro_id' => $tpv->id,
        ]);

        toastr()
            ->timeOut(3000) // 3 second
            ->addSuccess("TPV {$tpv->name} eliminado.");
        return redirect()->route('tpvs.index');
    }

    public function search(Request $request)
    {
        $query = $request->get('query');
        $tpvs = Tpv::where('name', 'like', '%' . $query . '%')
            ->orWhere('no_serial', 'like', '%' . $query . '%')
            ->orWhere('area', 'like', '%' . $query . '%')
            ->orWhere('ip', 'like', '%' . $query . '%')
            ->get();

        return view('tpvs._tpvs_list', compact('tpvs'));
    }
}
