<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Ont;
use App\Models\Hotel;
use App\Models\Villa;
use App\Models\Room;
use App\Models\Region;
use App\Models\Historial;
use Illuminate\Support\Facades\DB;
use Illuminate\Validation\Rule;

class OntController extends Controller
{
    public function index()
    {
        $onts = Ont::with(['room', 'villa', 'hotel', 'region'])
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

        $hotels = Hotel::with(['villas.rooms', 'villas'])->get();
        $villas = Villa::orderBy('name', 'asc')->get();
        $rooms = Room::orderBy('number', 'asc')->get();

        $regions = Region::orderBy('name', 'asc')->get();

        $userRegions = auth()->user()->regions;

        return view('redes.ont.index', compact('onts', 'hotels', 'regions', 'userRegions', 'villas', 'rooms'));
    }

    public function store(Request $request)
    {
        $user = auth()->id();
        
        try {
            $validated = $request->validate([
                'name' => 'required|string|max:255|unique:onts',
                'brand' => 'required',
                'model' => 'required',
                'serial' => [
                    'required',
                    'unique:onts',
                ],
                'mac' => [
                    'required',
                    'regex:/^([0-9A-Fa-f]{2}[:-]){5}([0-9A-Fa-f]{2})$/',
                    'unique:onts',
                ],
                'ip' => [
                    'required',
                    'ip',
                    Rule::unique('onts'),
                ],
                'hotel_id' => 'required|exists:hotels,id',
                'region_id' => 'required',
                'villa_id' => [
                    'required_if:location_type,villa',
                    'nullable',
                    Rule::exists('villas', 'id')->where('hotel_id', $request->hotel_id)
                ],
                'room_id' => [
                    'nullable',
                    Rule::exists('rooms', 'id')->where('villa_id', $request->villa_id)
                ],
            ], [
                'name.unique' => 'Este nombre ya está en uso por otro switch.',
                'ip.unique' => 'Esta dirección IP ya está en uso por otro switch.',
                'mac.regex' => 'El formato de la dirección MAC no es válido.',
                'mac.unique' => 'Esta dirección MAC ya está registrada.',
                'serial.unique' => 'Este número de serie ya está registrado.',
                'total_ports.min' => 'El switch debe tener al menos 1 puerto.',
                'total_ports.max' => 'El número máximo de puertos permitido es 128.',
            ]);

            $registro = Ont::create($validated);
            $registro->save();

            $user = auth()->user();

            Historial::create([
                'accion' => 'Creacion',
                'descripcion' => "Se agregó Ont con el nombre: {$registro->name} y con N/S: {$registro->serial}",
                'user_id' => $user->id,
                'region_id' => $registro->region_id,
            ]);

            toastr()
                ->timeOut(3000)
                ->addSuccess("Se creó {$registro->name} ({$registro->serial}) correctamente.");

            return redirect()->route('ont.index');

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

    public function update(Request $request, $id)
    {
        $user = auth()->id();
        try{
            $ont = Ont::findOrFail($id);

            $validated = $request->validate([
                'name' => 'required|string|max:255',
                'brand' => 'nullable|string|max:100',
                'model' => 'nullable|string|max:100',
                'serial' => 'nullable|string|max:100',
                'mac' => 'nullable|string|max:17|regex:/^([0-9A-Fa-f]{2}[:-]){5}([0-9A-Fa-f]{2})$/',
                'ip' => 'nullable|ipv4',
                'hotel_id' => 'required|exists:hotels,id',
                'villa_id' => 'required|exists:villas,id',
                'room_id' => 'required|exists:rooms,id',
                'region_id' => 'required|exists:regions,id',
            ]);

            $user = auth()->user();
            $ont->update($validated);

            Historial::create([
                'accion' => 'Actualización',
                'descripcion' => "Se actualizó ONT con el nombre: {$ont->name} y con N/S: {$ont->serial}",
                'user_id' => $user->id,
                'region_id' => $ont->region_id,
            ]);

            toastr()
                ->timeOut(3000)
                ->addSuccess("Se actualizó {$ont->name} ({$ont->serial}) correctamente.");

            return redirect()->route('ont.index');

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

    public function destroy($id)
    {
        $ont = Ont::findOrFail($id);
        $user = auth()->user();

        Historial::create([
            'accion' => 'Eliminación',
            'descripcion' => "Se eliminó ONT con el nombre: {$ont->name} y con N/S: {$ont->serial}",
            'user_id' => $user->id,
            'region_id' => $ont->region_id,
        ]);
        $ont->delete();
        toastr()
            ->timeOut(3000)
            ->addSuccess("Se eliminó {$ont->name} ({$ont->serial}) correctamente.");
        return redirect()->route('ont.index');
    }
}
