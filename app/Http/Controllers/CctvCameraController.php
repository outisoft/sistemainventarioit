<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Requests\CCTV\StoreCameraRequest;
use App\Http\Requests\CCTV\UpdateCameraRequest;
use Illuminate\Http\RedirectResponse;
use App\Models\Historial;
use App\Models\CCTV\CctvCamera;
use App\Models\CCTV\CctvSwitch;
use App\Models\SpecificLocation;
use App\Models\CCTV\TypeCamera;
use App\Models\Region;

class CctvCameraController extends Controller
{
    public function index()
    {
        //camera list con locations, switches, types and regions
        $cameras = CctvCamera::with(['location', 'switch', 'type_camera', 'region'])->orderBy('name', 'desc')->get();
        $regions = Region::orderBy('name')->get();
        $switches = CctvSwitch::orderBy('name')->get();
        $locations = SpecificLocation::orderBy('name')->get();
        $types = TypeCamera::orderBy('name')->get();
        $userRegions = auth()->user()->regions;
        return view('cctv.camera.index', compact('cameras', 'userRegions', 'switches', 'locations', 'regions', 'types'));
    }

    public function store(StoreCameraRequest  $request): RedirectResponse
    {
        $validated = $request->validated();

        CctvCamera::create($validated);

        Historial::create([
                'accion' => 'Creacion',
                'descripcion' => "Se registro la camara de CCTV {$validated['name']} con numero de serie {$validated['serial']}",
                'user_id' => auth()->id(),
                'region_id' => $validated['region_id'],
            ]);

        toastr()
                ->timeOut(3000)
                ->addSuccess("Camera {$validated['name']} created.");

        return redirect()->route('cctv-camera.index');
    }

    public function update(UpdateCameraRequest $request, CctvCamera $cctvCamera): RedirectResponse
    {
        $validated = $request->validated();

        $cctvCamera->update($validated);

        Historial::create([
                'accion' => 'Actualizacion',
                'descripcion' => "Se actualizo la camara de CCTV {$validated['name']} con numero de serie {$validated['serial']}",
                'user_id' => auth()->id(),
                'region_id' => $validated['region_id'],
            ]);

        toastr()
                ->timeOut(3000)
                ->addSuccess("Camera {$validated['name']} updated.");

        return redirect()->route('cctv-camera.index');
    }

    public function destroy(CctvCamera $cctvCamera): RedirectResponse
    {
        $cctvCamera->delete();

        Historial::create([
                'accion' => 'Eliminacion',
                'descripcion' => "Se elimino la camara de CCTV {$cctvCamera->name} con numero de serie {$cctvCamera->serial}",
                'user_id' => auth()->id(),
                'region_id' => $cctvCamera->region_id,
            ]);

        toastr()
                ->timeOut(3000)
                ->addSuccess("Camera {$cctvCamera->name} deleted.");

        return redirect()->route('cctv-camera.index');
    }
}
