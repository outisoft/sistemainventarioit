<?php

namespace App\Http\Controllers;

use App\Models\Tpv;
use App\Models\Hotel;
use App\Models\Departamento;
use App\Models\Region;
use App\Models\Lease;
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
        $tpvs = tpv::with(['region', 'hotel', 'departments', 'leases'])
            ->when(!auth()->user()->hasRole('Administrator'), function ($query) {
                $regionIds = auth()->user()->regions->pluck('id');
                if ($regionIds->isNotEmpty()) {
                    $query->whereHas('region', function ($q) use ($regionIds) {
                        $q->whereIn('regions.id', $regionIds);
                    });
                }
            })
            ->orderBy('name', 'asc')
            ->get();
        
        $regions = Region::all();
        $leases = Lease::orderBy('lease', 'asc')->get();

        $userRegions = auth()->user()->regions;
        
        return view('tpvs.index', compact('leases', 'userRegions', 'tpvs','hoteles', 'departamentos', 'regions'));
    }

    public function store(Request $request)
    {
        try {
            $data = $request->validate([
                'region_id' => 'required',
                'area' => 'required',
                'departamento_id' => 'required',
                'hotel_id' => 'required|exists:hotels,id',
                'equipment' => 'required',
                'brand' => 'required',
                'model' => 'required',
                'no_serial' => 'required|unique:tpvs',
                'name' => 'required|unique:tpvs',
                'ip' => 'required|unique:tpvs',
                'link' => 'required',
                'lease' => 'required|boolean',
                'lease_id' => 'required_if:lease,1',
            ], [
                'no_serial.unique' => 'Este No. de serie ya existe.',
                'name.unique' => 'Este nombre de equipo ya existe.',
                'ip.unique' => 'Esta IP ya esta en uso.',
            ]);

            $registro = Tpv::create($data);

            $user = auth()->id();

            Historial::create([
                'accion' => 'Creacion',
                'descripcion' => "Se registro la Tpv {$registro->name} correctamente",
                'user_id' => $user,
                'region_id' => $registro->region_id,
            ]);

            toastr()
                ->timeOut(3000) // 3 second
                ->addSuccess("Registro creado exitosamente.");

            return redirect()->route('tpvs.index');
        } catch (\Exception $e) {
            foreach ($e->errors() as $field => $errors) {
                foreach ($errors as $error) {
                    toastr()
                        ->timeOut(5000)
                        ->addError($error);
                }
            }
            return back()->withErrors($e->errors())->withInput();
        }
    }

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

    public function getDepartments(Request $request)
    {
        $hotel_id = $request->hotel_id;
        $departamentos = Departamento::whereHas('hotels', function ($query) use ($hotel_id) {
            $query->where('hotel_id', $hotel_id);
        })->get();

        return response()->json($departamentos);
    }

    public function update(Request $request, $id)
    {
        try {
            $data = $request->validate([
                'region_id' => 'required|exists:regions,id',
                'area' => 'required',
                'departamento_id' => 'required',
                'hotel_id' => 'required|exists:hotels,id',
                'equipment' => 'required',
                'brand' => 'required',
                'model' => 'required',
                'no_serial' => 'required|unique:tpvs,ip,' . $id,
                'name' => 'required|unique:tpvs,ip,' . $id,
                'ip' => 'required|unique:tpvs,ip,' . $id,
                'link' => 'required',
                'lease' => 'required|boolean',
                'lease_id' => 'required_if:lease,1|exists:leases,id',
            ]);

            $registro = Tpv::findOrFail($id);
            $registro->update($data);

            $user = auth()->id();

            Historial::create([
                'accion' => 'Actualizacion',
                'descripcion' => "Se actualizo la TPV {$registro->name} correctamente",
                'user_id' => $user,
                'region_id' => $registro->region_id,
            ]);

            toastr()
                ->timeOut(3000) // 3 second
                ->addSuccess("Tpv {$registro->name} actualizado.");
            return redirect()->route('tpvs.index');
        } catch (ValidationException $e) {
            foreach ($e->errors() as $field => $errors) {
                foreach ($errors as $error) {
                    toastr()
                        ->timeOut(5000)
                        ->addError($error);
                }
            }
            
            return back()->withErrors($e->errors())->withInput();
        } catch (\Exception $e) {
            foreach ($e->errors() as $field => $errors) {
                foreach ($errors as $error) {
                    toastr()
                        ->timeOut(5000)
                        ->addError($error);
                }
            }
            return back()->withErrors($e->errors())->withInput();
        }
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
            'region_id' => $registro->region_id,
        ]);

        toastr()
            ->timeOut(3000) // 3 second
            ->addSuccess("TPV {$tpv->name} eliminado.");
        return redirect()->route('tpvs.index');
    }
}
