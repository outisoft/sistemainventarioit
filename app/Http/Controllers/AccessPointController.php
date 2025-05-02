<?php

namespace App\Http\Controllers;

use App\Models\AccessPoint;
use App\Models\Historial;
use App\Models\Swittch;
use App\Models\Region;
use App\Models\Hotel;
use App\Models\DeviceLocation;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Validation\Rule;

class AccessPointController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
        $this->middleware('can:access_points.index')->only('index');
        $this->middleware('can:access_points.create')->only('create', 'store');
        $this->middleware('can:access_points.edit')->only('edit', 'update');
        $this->middleware('can:access_points.show')->only('show');
        $this->middleware('can:access_points.destroy')->only('destroy');
    }

    public function index()
    {
        $user = auth()->user();

        $accessPoints = AccessPoint::with(['region', 'swittch', 'hotel'])
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
        $regions = Region::orderBy('name', 'asc')->get();
        $switches = Swittch::orderBy('name', 'asc')->get();

        $userRegions = auth()->user()->regions;

        $hotels = Hotel::with(['villas.rooms', 'villas'])->get();
        
        return view('equipos.access_points.index', compact('userRegions', 'accessPoints', 'switches', 'regions', 'hotels'));
    }

    public function store(Request $request)
    {        
        try {
            $user = auth()->user();
    
            $data = $request->validate([
                'name' => [
                    'required',
                    'unique:access_points',
                ],
                'marca' => 'required',
                'model' => 'required',
                'serial' => [
                    'required',
                    'unique:access_points',
                ],
                'mac' => [
                    'required',
                    'regex:/^([0-9A-Fa-f]{2}[:-]){5}([0-9A-Fa-f]{2})$/',
                    'unique:access_points',
                ],
                'ip' => [
                    'required',
                    'ip',
                    Rule::unique('access_points'),
                ],
                'swittch_id' => 'required|exists:swittches,id',
                'port_number' => 'required|integer',
                'hotel_id' => 'required|exists:hotels,id',
                'location_type' => 'required|in:villa,specific',
                'villa_id' => [
                    'required_if:location_type,villa',
                    'nullable',
                    Rule::exists('villas', 'id')->where('hotel_id', $request->hotel_id)
                ],
                'room_id' => [
                    'nullable',
                    Rule::exists('rooms', 'id')->where('villa_id', $request->villa_id)
                ],
                'specific_location_id' => [
                    'required_if:location_type,specific',
                    'nullable',
                    Rule::exists('specific_locations', 'id')->where('hotel_id', $request->hotel_id)
                ]
            ], [
                'name.unique' => 'Este nombre ya está en uso por otro AP.',
                'ip.unique' => 'Esta dirección IP ya está en uso por otro AP.',
                'mac.regex' => 'El formato de la dirección MAC no es válido.',
                'mac.unique' => 'Esta dirección MAC ya está registrada.',
                'serial.unique' => 'Este número de serie ya está registrado.',
            ]);

            $swittch = Swittch::findOrFail($data['swittch_id']);

            $accessPoint = AccessPoint::create([
                'name' => $data['name'],
                'marca' => $data['marca'],
                'model' => $data['model'],
                'serial' => $data['serial'],
                'mac' => $data['mac'],
                'ip' => $data['ip'],
                'swittch_id' => $data['swittch_id'],
                'port_number' => $data['port_number'],
                'region_id' => $swittch->region_id,
                'hotel_id' => $data['hotel_id'],
                // Otros campos
            ]);
        
            // Crear la ubicación
            $locationData = [
                'locatable_id' => $accessPoint->id,
                'locatable_type' => AccessPoint::class
            ];
            
            if ($data['location_type'] === 'villa') {
                $locationData['villa_id'] = $data['villa_id'];
                $locationData['room_id'] = $data['room_id'];
            } else {
                $locationData['specific_location_id'] = $data['specific_location_id'];
            }
            
            DeviceLocation::create($locationData);

            Historial::create([
                'accion' => 'Creacion',
                'descripcion' => "Se agregó el AP con el nombre: {$data['name']} y con N/S: {$data['serial']}",
                'user_id' => $user->id,
                'region_id' => $swittch->region_id,
            ]);

            toastr()
                ->timeOut(3000)
                ->addSuccess("Se creó {$data['name']} ({$data['serial']}) correctamente.");

            return redirect()->back();

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

    public function getAvailablePort(Swittch $switch)
    {
        $usedPorts = $switch->accessPoints()->pluck('port_number')->toArray();
        $availablePorts = array_values(array_diff(range(1, $switch->total_ports), $usedPorts));
        
        return response()->json([
            'available_ports' => $availablePorts,
            'free_ports' => count($availablePorts)
        ]);
    }

    public function show(AccessPoint $accessPoint)
    {
        $swittch = Swittch::find($accessPoint->swittch_id);
        return view('equipos.access_points.show', compact('accessPoint', 'swittch'));
    }

    public function update(Request $request, $id)
    {
        $user = auth()->id();
        
        try {
            $data = $request->validate([
                'name' => [
                    'required',
                    'string',
                    'max:255',
                    'unique:access_points,name,' . $id,
                ],
                'marca' => 'required',
                'model' => 'required',
                'serial' => [
                    'required',
                    'unique:access_points,serial,' . $id,
                ],
                'mac' => [
                    'required',
                    'regex:/^([0-9A-Fa-f]{2}[:-]){5}([0-9A-Fa-f]{2})$/',
                    'unique:access_points,mac,' . $id,
                ],
                'ip' => [
                    'required',
                    'ip',
                    'unique:access_points,ip,' . $id,
                ],
                'swittch_id' => 'required|exists:swittches,id',
                'port_number' => 'required',

            ], [
                'name.unique' => 'Este nombre ya está en uso por otro AP.',
                'ip.unique' => 'Esta dirección IP ya está en uso por otro AP.',
                'mac.regex' => 'El formato de la dirección MAC no es válido.',
                'mac.unique' => 'Esta dirección MAC ya está registrada.',
                'serial.unique' => 'Este número de serie ya está registrado.',
            ]);

            $switch = Swittch::findOrFail($data['swittch_id']);

            $accessPoint = AccessPoint::findOrFail($id);

            $accessPoint->update([
                'region_id' => $switch->region_id,
                'name' => $data['name'],
                'marca' => $data['marca'],
                'model' => $data['model'],
                'serial' => $data['serial'],
                'mac' => $data['mac'],
                'ip' => $data['ip'],
                'swittch_id' => $data['swittch_id'],
                'port_number' => $data['port_number'],
            ]);

            Historial::create([
                'accion' => 'Actualización',
                'descripcion' => "Se actualizó el AP de nombre: {$accessPoint->name} y con N/S: {$accessPoint->serial}",
                'user_id' => $user,
                'region_id' => $switch->region_id,
            ]);

            toastr()
                ->timeOut(3000)
                ->addSuccess("Se actualizó {$accessPoint->name} ({$accessPoint->serial}) correctamente.");


            return redirect()->back();

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

    public function details(Hotel $hotel)
    {
        $switches = Swittch::orderBy('name', 'asc')->get();
        $regions = Region::orderBy('name', 'asc')->get();
        $hotels = Hotel::orderBy('name', 'asc')->get();
        $userRegions = auth()->user()->regions;

        $accessPoints = $hotel->accessPoints()->orderBy('name')->get();
        return view('equipos.access_points.details', compact('accessPoints', 'hotel', 'regions', 'userRegions', 'hotels', 'switches'));
    }

    public function destroy(String $id)
    {
        $registro = AccessPoint::findOrFail($id);
        $registro->delete();

        $user = auth()->id();

        Historial::create([
            'accion' => 'Eliminacion',
            'descripcion' => "Se elimino el {$registro->name} con N/S {$registro->serial}",
            'user_id' => $user,
            'region_id' => $registro->region_id,
        ]);

        toastr()
            ->timeOut(3000) // 3 second
            ->addSuccess("Se elimino el {$registro->name} correctamente.");

        return redirect()->back();
    }
}

