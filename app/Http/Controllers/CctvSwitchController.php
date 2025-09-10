<?php

namespace App\Http\Controllers;

use App\Models\CCTV\CctvSwitch;
use App\Models\Region;
use Illuminate\Http\Request;
use App\Models\SpecificLocation;

class CctvSwitchController extends Controller
{
    public function index()
    {
        $regions = Region::orderBy('name')->get();
        $locations = SpecificLocation::orderBy('name')->get();
        $switches = CctvSwitch::orderBy('name', 'desc')->get();
        $userRegions = auth()->user()->regions;

        return view('cctv.switch.index', compact('switches', 'regions', 'locations', 'userRegions'));
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'name' => 'required|string|unique:cctv_switches,name',
            'idf' => 'nullable|string',
            'zona' => 'nullable|in:A,B,C',
            'location_id' => 'nullable|exists:specific_locations,id',
            'brand' => 'required|string',
            'model' => 'required|string',
            'serial' => 'required|string|unique:cctv_switches,serial',
            'mac' => 'required|string|unique:cctv_switches,mac',
            'ip' => 'required|ip|unique:cctv_switches,ip',
            'password' => 'nullable|string',
            'tipo' => 'required|in:principal,secundario,idf',
            'connected_to_id' => 'nullable|exists:cctv_switches,id',
            'connected_port' => 'nullable|string',
            'from_provider' => 'boolean',
            'region_id' => 'required|exists:regions,id'
        ]);

        CctvSwitch::create($validated);

        toastr()
                ->timeOut(3000)
                ->addSuccess("Switch {$validated['name']} creado.");

        return redirect()->route('cctv-switch.index');
    }

    public function update(Request $request, CctvSwitch $cctvSwitch)
    {
        $validated = $request->validate([
            'name' => 'required|string|unique:cctv_switches,name,' . $cctvSwitch->id,
            'idf' => 'nullable|string',
            'zona' => 'nullable|in:A,B,C',
            'location_id' => 'nullable|exists:specific_locations,id',
            'brand' => 'required|string',
            'model' => 'required|string',
            'serial' => 'required|string|unique:cctv_switches,serial,' . $cctvSwitch->id,
            'mac' => 'required|string|unique:cctv_switches,mac,' . $cctvSwitch->id,
            'ip' => 'required|ip|unique:cctv_switches,ip,' . $cctvSwitch->id,
            'password' => 'nullable|string',
            'tipo' => 'required|in:principal,secundario,idf',
            'connected_to_id' => 'nullable|exists:cctv_switches,id',
            'connected_port' => 'nullable|string',
            'from_provider' => 'boolean',
            'region_id' => 'required|exists:regions,id'
        ]);

        $cctvSwitch->update($validated);

        toastr()
                ->timeOut(3000)
                ->addSuccess("Switch {$cctvSwitch->name} actualizado.");

        return redirect()->route('cctv-switch.index');
    }

    public function destroy(CctvSwitch $cctvSwitch)
    {
        $cctvSwitch->delete();

        return redirect()->route('cctv-switch.index')
                        ->with('success', 'Switch eliminado exitosamente.');
    }
}
