<?php

namespace App\Http\Controllers;

use App\Models\CCTV\CctvSwitch;
use App\Models\Region;
use Illuminate\Http\Request;
use App\Http\Requests\CCTV\StoreSwitchRequest;
use App\Http\Requests\CCTV\UpdateSwitchRequest;
use App\Models\SpecificLocation;
use App\Models\Historial;

class CctvSwitchController extends Controller
{
    public function index()
    {
        $switches = CctvSwitch::with(['region', 'location'])->orderBy('name', 'desc')->get();
        $regions = Region::orderBy('name')->get();
        $locations = SpecificLocation::orderBy('name')->get();
        $userRegions = auth()->user()->regions;

        return view('cctv.switch.index', compact('switches', 'regions', 'locations', 'userRegions'));
    }

    public function store(StoreSwitchRequest $request)
    {
        $validated = $request->validated();

        CctvSwitch::create($validated);

        Historial::create([
                'accion' => 'Creacion',
                'descripcion' => "Se registro el switch de CCTV {$validated['name']} con numero de serie {$validated['serial']}",
                'user_id' => auth()->id(),
                'region_id' => $validated['region_id'],
            ]);

        toastr()
                ->timeOut(3000)
                ->addSuccess("Switch {$validated['name']} creado.");

        return redirect()->route('cctv-switch.index');
    }

    public function update(UpdateSwitchRequest $request, CctvSwitch $cctvSwitch)
    {
        $validated = $request->validated();

        $cctvSwitch->update($validated);

        Historial::create([
                'accion' => 'Actualizacion',
                'descripcion' => "Se actualizo el switch de CCTV {$validated['name']} con numero de serie {$validated['serial']}",
                'user_id' => auth()->id(),
                'region_id' => $validated['region_id'],
            ]);

        toastr()
                ->timeOut(3000)
                ->addSuccess("Switch {$cctvSwitch->name} actualizado.");

        return redirect()->route('cctv-switch.index');
    }

    public function organigrama()
    {
        $switches = CctvSwitch::with(['connectedSwitches', 'cameras'])->get();
        $principal = $switches->where('tipo', 'principal')->first();

        $equipos = [];

            foreach ($switches as $sw) {
                $equipos['SW' . $sw->id] = [
                    'tipo' => $sw->tipo,
                    'nombre' => $sw->name,
                    'ip' => $sw->ip,
                    'puertos' => $sw->puertos,
                    'modelo' => $sw->model,
                    'marca' => $sw->brand,
                ];

                foreach ($sw->cameras as $cam) {
                    $equipos['CAM' . $cam->id] = [
                        'tipo' => 'camara',
                        'nombre' => $cam->name,
                        'ip' => $cam->ip,
                        'modelo' => $cam->model,
                        'marca' => $cam->brand,
                        'puerto' => $cam->connected_port,
                    ];
                }
            }

        return view('cctv.organigrama', compact('principal', 'equipos'));
    }

    public function destroy(CctvSwitch $cctvSwitch)
    {
        $cctvSwitch->delete();

        Historial::create([
                'accion' => 'Eliminacion',
                'descripcion' => "Se elimino el switch de CCTV {$cctvSwitch->name} con numero de serie {$cctvSwitch->serial}",
                'user_id' => auth()->id(),
                'region_id' => $cctvSwitch->region_id,
            ]);

        toastr()
                ->timeOut(3000)
                ->addSuccess("Switch {$cctvSwitch->name} eliminado.");

        return redirect()->route('cctv-switch.index');
    }
}
