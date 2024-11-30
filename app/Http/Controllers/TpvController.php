<?php

namespace App\Http\Controllers;

use App\Models\Tpv;
use App\Models\Hotel;
use App\Models\Departamento;
use App\Models\Region;
use App\Models\Historial;
use Illuminate\Http\Request;

class TpvController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
        $this->middleware('can:tpvs.index')->only('index');
        $this->middleware('can:tpvs.create')->only('create', 'store');
        $this->middleware('can:tpvs.edit')->only('edit', 'update');
        $this->middleware('can:tpvs.show')->only('show');
        $this->middleware('can:tpvs.destroy')->only('destroy');
    }

    public function index()
    {
        $hoteles = Hotel::all();
        $departamentos = Departamento::all();
        $tpvs = tpv::with(['region', 'hotel', 'departments'])
            ->when(!auth()->user()->hasRole('Administrator'), function ($query) {
                $query->where('region_id', auth()->user()->region_id);
            })
            ->orderBy('name', 'asc')
            ->get();
        
        $regions = Region::all();
        
        return view('tpvs.index', compact('tpvs','hoteles', 'departamentos', 'regions'));
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
        try {
            //dd($request);
            $data = $request->validate([
                'region_id' => 'required',
                'area' => 'required',
                'departamento_id' => 'required',
                'hotel_id' => 'required|exists:hotels,id',
                'equipment' => 'required',
                'brand' => 'required',
                'model' => 'required',
                'no_serial' => 'required',
                'name' => 'required|unique:tpvs',
                'ip' => 'required|unique:tpvs',
                'link' => 'required',
            ]);

            $registro = Tpv::create($data);

            //dd($request);
            $user = auth()->id();

            Historial::create([
                'accion' => 'Creacion',
                'descripcion' => "Se registro la Tpv {$registro->name} correctamente",
                'user_id' => $user,
                'region_id' => auth()->user()->region_id,
            ]);

            toastr()
                ->timeOut(3000) // 3 second
                ->addSuccess("Registro creado exitosamente.");

            return redirect()->route('tpvs.index');
        } catch (\Illuminate\Validation\ValidationException $e) {
            $errors = $e->validator->errors();

            if ($errors->has('name')) {
                toastr()->timeOut(6000)->addError("El nombre de TPV ya existe.");
            }

            if ($errors->has('ip')) {
                toastr()->timeOut(6000)->addError("La Ip ya está en uso.");
            }

            return redirect()->back()->withErrors($e->validator)->withInput();
        }
    }

    /**
     * Display the specified resource.
     */
    public function show(Tpv $tpv)
    {
        $hotel = Hotel::find($tpv->hotel_id);
        $departamento = Departamento::find($tpv->departamento_id); 
        return view('tpvs.show', compact('tpv', 'hotel', 'departamento'));
    }

    public function edit(Tpv $tpv)
    {
        return response()->json([
            'tpv' => $tpv,
        ]);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, $id)
    {
        $data = $request->validate([
            'region_id' => 'required|exists:regions,id',
            'area' => 'required',
            'departamento_id' => 'required',
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

        $user = auth()->id();

        Historial::create([
            'accion' => 'Actualizacion',
            'descripcion' => "Se actualizo la TPV {$registro->name} correctamente",
            'user_id' => $user,
            'region_id' => auth()->user()->region_id,
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
            'user_id' => $tpv->id,
            'region_id' => auth()->user()->region_id,
        ]);

        toastr()
            ->timeOut(3000) // 3 second
            ->addSuccess("TPV {$tpv->name} eliminado.");
        return redirect()->route('tpvs.index');
    }
}
