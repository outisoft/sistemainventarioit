<?php

namespace App\Http\Controllers;

use App\Models\Swittch;
use App\Models\Historial;
use App\Models\Hotel;
use App\Models\Complement;
use App\Models\DeviceLocation;
use App\Models\Region;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Validation\Rule;

class SwitchController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
        $this->middleware('can:switches.index')->only('index');
        $this->middleware('can:switches.create')->only('create', 'store');
        $this->middleware('can:switches.edit')->only('edit', 'update');
        $this->middleware('can:switches.show')->only('show');
        $this->middleware('can:switches.destroy')->only('destroy');
    }
    
    public function index()
    {
        $switches = Swittch::with(['hotel', 'accessPoints', 'region'])
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
        
        $hotels = Hotel::with(['villas', 'specificLocations'])->orderBy('name', 'asc')->get();
        $regions = Region::orderBy('name', 'asc')->get();

        $userRegions = auth()->user()->regions->pluck('id')->toArray();
        
        return view('equipos.switches.index', compact('switches', 'hotels', 'regions'));
    }

    public function store(Request $request)
    {
        $user = auth()->id();
        
        try {
            $validated = $request->validate([
                'name' => 'required|string|max:255|unique:swittches',
                'marca' => 'required',
                'model' => 'required',
                'serial' => [
                    'required',
                    'unique:swittches',
                ],
                'mac' => [
                    'required',
                    'regex:/^([0-9A-Fa-f]{2}[:-]){5}([0-9A-Fa-f]{2})$/',
                    'unique:swittches',
                ],
                'ip' => [
                    'required',
                    'ip',
                    Rule::unique('swittches'),
                ],
                'total_ports' => 'required|integer|min:1|max:128',
                'hotel_id' => 'required|exists:hotels,id',
                'observacion' => 'required',
                'region_id' => 'required',
                'usage_type' => 'required',
                'location_type' => 'required|in:villa,specific',
                'villa_id' => [
                    'required_if:location_type,villa',
                    'nullable',
                    Rule::exists('villas', 'id')->where('hotel_id', $request->hotel_id)
                ],
                'specific_location_id' => [
                    'required_if:location_type,specific',
                    'nullable',
                    'exists:specific_locations,id,hotel_id,'.$request->hotel_id
                ]
            ], [
                'name.unique' => 'Este nombre ya está en uso por otro switch.',
                'ip.unique' => 'Esta dirección IP ya está en uso por otro switch.',
                'mac.regex' => 'El formato de la dirección MAC no es válido.',
                'mac.unique' => 'Esta dirección MAC ya está registrada.',
                'serial.unique' => 'Este número de serie ya está registrado.',
                'total_ports.min' => 'El switch debe tener al menos 1 puerto.',
                'total_ports.max' => 'El número máximo de puertos permitido es 128.',
            ]);

            $registro = Swittch::create($validated);
            $registro->save();

            $locationData = [
                'locatable_id' => $registro->id,
                'locatable_type' => Swittch::class
            ];
            
            if ($request->location_type === 'villa') {
                $locationData['villa_id'] = $request->villa_id;
            } else {
                $locationData['specific_location_id'] = $request->specific_location_id;
            }
            
            DeviceLocation::create($locationData);

            $user = auth()->user();
            $regionId = null;

            if ($user->hasRole('Administrator')) {
                // Si el usuario es administrador, usa la región seleccionada en el registro
                $regionId = $request->input('region_id');
            } else {
                // Si el usuario es básico, usa la región a la que pertenece
                $regionId = $user->regions->pluck('id')->first();
            }


            Historial::create([
                'accion' => 'Creacion',
                'descripcion' => "Se agregó SW con el nombre: {$registro->name} y con N/S: {$registro->serial}",
                'user_id' => $user->id,
                'region_id' => $regionId,
            ]);

            toastr()
                ->timeOut(3000)
                ->addSuccess("Se creó {$registro->name} ({$registro->serial}) correctamente.");

            return redirect()->route('switches.index');

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

    public function show(Swittch $switch)
    {
        $cAsignados = $switch->complements;

        $cDisponibles = Complement::whereDoesntHave('switches')
            ->whereHas('type', function($query) {
                $query->where('name', 'NO BREACK');
            })
            ->get();

        return view('equipos.switches.show', compact('switch', 'cAsignados', 'cDisponibles'));
    }

    public function asignarBreack(Request $request, Swittch $switch)
    {
        $request->validate([
            'complements_id' => 'required|array',
            'complementos.*' => 'exists:complements,id|unique:breack_switch,complement_id',
        ]);

        foreach ($request->complements_id as $complement_id) {
            $complement = Complement::find($complement_id);

            if ($complement->switch_id) {
                toastr()
                    ->timeOut(3000) // 3 seconds
                    ->addError("El complemento {$complement->type->name} (N/S: {$complement->serial}) ya está asignado a otro equipo.");

                return redirect()->route('equipo.show', $switch);
            }
        }

        $switch->breack()->attach($request->complements_id);

        $complement = Complement::where('id', $request->complements_id)->with('type')->first();

        $user = auth()->id();

        Historial::create([
            'accion' => 'Asignacion',
            'descripcion' => "Se asigno al equipo {$switch->name} (S/N:{$switch->serial}) un NO BREACK (N/S: {$complement->serial})",
            'user_id' => $user,
            'region_id' => $complement->region_id,
        ]);

        toastr()
            ->timeOut(3000) // 3 seconds
            ->addSuccess("Complemento {$complement->type->name} asignado.");

        return redirect()->route('switches.show', $switch);
    }

    public function desasignarBreack($switch_id, $complement_id)
    {
        $equipo = Swittch::find($switch_id);
        $equipo->breack()->detach($complement_id);

        $complement = Complement::where('id', $complement_id)->with('type')->first();

        $user = auth()->id();

        Historial::create([
            'accion' => 'Desvinculó',
            'descripcion' => "Se desvinculó al equipo {$equipo->name} (S/N: {$equipo->serial} ) el NO BREACK (S/N: {$complement->serial} )",
            'user_id' => $user,
            'region_id' => $complement->region_id,
        ]);

        toastr()
            ->timeOut(3000) // 3 second
            ->addSuccess("Complemento {$equipo->name} desvinculado.");
        
        return redirect()->route('switches.show', $equipo);
    }

    public function update(Request $request, Swittch $switch)
    {
        $user = auth()->id();
        
        try {
            $validated = $request->validate([
                'region_id' => 'required',
                'name' => [
                    'required',
                    'string',
                    'max:255',
                    Rule::unique('swittches')->ignore($switch->id),
                ],
                'marca' => 'required',
                'model' => 'required',
                'serial' => [
                    'required',
                    Rule::unique('swittches')->ignore($switch->id),
                ],
                'mac' => [
                    'required',
                    'regex:/^([0-9A-Fa-f]{2}[:-]){5}([0-9A-Fa-f]{2})$/',
                    Rule::unique('swittches')->ignore($switch->id),
                ],
                'ip' => [
                    'required',
                    'ip',
                    Rule::unique('swittches')->ignore($switch->id),
                ],
                'total_ports' => 'required|integer|min:1|max:128',
                'hotel_id' => 'required|exists:hotels,id',
                'observacion' => 'required',
            ], [
                'name.unique' => 'Este nombre ya está en uso por otro switch.',
                'ip.unique' => 'Esta dirección IP ya está en uso por otro switch.',
                'mac.regex' => 'El formato de la dirección MAC no es válido.',
                'mac.unique' => 'Esta dirección MAC ya está registrada.',
                'serial.unique' => 'Este número de serie ya está registrado.',
                'total_ports.min' => 'El switch debe tener al menos 1 puerto.',
                'total_ports.max' => 'El número máximo de puertos permitido es 128.',
            ]);

            $switch->update($validated);

            $user = auth()->user();
            $regionId = null;

            if ($user->hasRole('admin')) {
                // Si el usuario es administrador, usa la región seleccionada en el formulario de edición
                $regionId = $request->input('region_id');
            } else {
                // Si el usuario es básico, usa la región a la que pertenece
                $regionId = $user->regions->pluck('id')->first();
            }

            Historial::create([
                'accion' => 'Actualización',
                'descripcion' => "Se actualizó SW con el nombre: {$switch->name} y con N/S: {$switch->serial}",
                'user_id' => $user->id,
                'region_id' => $regionId,
            ]);

            toastr()
                ->timeOut(3000)
                ->addSuccess("Se actualizó {$switch->name} ({$switch->serial}) correctamente.");

            return redirect()->route('switches.index');

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

    public function showSwitches($hotelId)
    {
        $hotel = Hotel::findOrFail($hotelId);
        $switches = $hotel->switches; // Asumiendo que tienes una relación definida en el modelo Hotel

        return view('equipos.switches.details', compact('hotel', 'switches'));
    }

    public function destroy(String $id)
    {
        $registro = Swittch::findOrFail($id);
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

        return redirect()->route('switches.index');
    }

}
