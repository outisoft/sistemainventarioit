<?php

namespace App\Http\Controllers;

use App\Models\AccessPoint;
use App\Models\Historial;
use App\Models\Swittch;
use App\Models\Region;
use Illuminate\Http\Request;
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
        $accessPoints = AccessPoint::with(['region', 'swittch'])
            ->when(!auth()->user()->hasRole('Administrator'), function ($query) {
                $query->where('region_id', auth()->user()->region_id);
            })
            ->get();
        $regions = Region::orderBy('name', 'asc')->get();
        $switches = Swittch::orderBy('name', 'asc')->get();
        
        return view('equipos.access_points.index', compact('accessPoints', 'switches', 'regions'));
    }

    public function store(Request $request)
    {
        $user = auth()->id();
        
        try {
            $validated = $request->validate([
                'region_id' => 'required',
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
            ], [
                'name.unique' => 'Este nombre ya está en uso por otro AP.',
                'ip.unique' => 'Esta dirección IP ya está en uso por otro AP.',
                'mac.regex' => 'El formato de la dirección MAC no es válido.',
                'mac.unique' => 'Esta dirección MAC ya está registrada.',
                'serial.unique' => 'Este número de serie ya está registrado.',
            ]);

            $registro = AccessPoint::create($validated);

            $registro->save();

            Historial::create([
                'accion' => 'Creacion',
                'descripcion' => "Se agregó el AP con el nombre: {$registro->name} y con N/S: {$registro->serial}",
                'user_id' => $user,
                'region_id' => auth()->user()->region_id,
            ]);

            toastr()
                ->timeOut(3000)
                ->addSuccess("Se creó {$registro->name} ({$registro->serial}) correctamente.");


            return redirect()->route('access-points.index');

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

    public function update(Request $request, AccessPoint $accessPoint)
    {
        $user = auth()->id();
        
        try {
            $validated = $request->validate([
                'region_id' => 'required',
                'name' => [
                    'required',
                    'string',
                    'max:255',
                    Rule::unique('access_points')->ignore($accessPoint->id),
                ],
                'marca' => 'required',
                'model' => 'required',
                'serial' => [
                    'required',
                    Rule::unique('access_points')->ignore($accessPoint->id),
                ],
                'mac' => [
                    'required',
                    'regex:/^([0-9A-Fa-f]{2}[:-]){5}([0-9A-Fa-f]{2})$/',
                    Rule::unique('access_points')->ignore($accessPoint->id),
                ],
                'ip' => [
                    'required',
                    'ip',
                    Rule::unique('access_points')->ignore($accessPoint->id),
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
            $accessPoint->update($validated);

            Historial::create([
                'accion' => 'Actualización',
                'descripcion' => "Se actualizó el AP de nombre: {$accessPoint->name} y con N/S: {$accessPoint->serial}",
                'user_id' => $user,
                'region_id' => auth()->user()->region_id,
            ]);

            toastr()
                ->timeOut(3000)
                ->addSuccess("Se actualizó {$accessPoint->name} ({$accessPoint->serial}) correctamente.");


            return redirect()->route('access-points.index');

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

    public function destroy(String $id)
    {
        $registro = AccessPoint::findOrFail($id);
        $registro->delete();

        $user = auth()->id();

        Historial::create([
            'accion' => 'Eliminacion',
            'descripcion' => "Se elimino el {$registro->name} con N/S {$registro->serial}",
            'user_id' => $user,
            'region_id' => auth()->user()->region_id,
        ]);

        toastr()
            ->timeOut(3000) // 3 second
            ->addSuccess("Se elimino el {$registro->name} correctamente.");

        return redirect()->route('access-points.index');
    }
}

