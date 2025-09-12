<?php

namespace App\Http\Controllers;

use App\Models\CCTV\CctvSwitch;
use App\Models\Region;
use Illuminate\Http\Request;
use App\Http\Requests\CCTV\StoreSwitchRequest;
use App\Http\Requests\CCTV\UpdateSwitchRequest;
use App\Models\SpecificLocation;
use App\Models\Historial;
use Endroid\QrCode\QrCode;
use Endroid\QrCode\Writer\PngWriter;

class CctvSwitchController extends Controller
{
    public function __construct()
    {
        $this->middleware('permission:cctv-switch.index')->only('index');
        $this->middleware('permission:cctv-switch.create')->only('create', 'store');
        $this->middleware('permission:cctv-switch.show')->only('show');
        $this->middleware('permission:cctv-switch.edit')->only('edit', 'update');
        $this->middleware('permission:cctv-switch.destroy')->only('destroy');
    }

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

    public function show(CctvSwitch $cctvSwitch)
    {
        $switch = CctvSwitch::with(['connectedSwitches', 'cameras'])->find($cctvSwitch->id);

        return view('cctv.switch.show', compact('switch'));
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

    public function downloadQRCode($switchId)
    {
        // Generar el QR con la URL de detalles del switch
        $switch = CctvSwitch::findOrFail($switchId);
        $url = route('cctv-switch.show', $switchId);

        $qr = QrCode::create($url)
            ->setSize(280);
        $writer = new PngWriter();
        $result = $writer->write($qr);

        $qrcode = $result->getString();

        // Descargar el QR como imagen PNG con el nombre del switch
        return response($qrcode)
            ->header('Content-Type', 'image/png')
            ->header('Content-Disposition', 'attachment; filename="' . $switch->name . '-qrcode.png"');
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
