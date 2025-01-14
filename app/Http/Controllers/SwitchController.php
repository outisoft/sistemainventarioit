<?php

namespace App\Http\Controllers;

use App\Models\Swittch;
use App\Models\Historial;
use App\Models\Hotel;
use App\Models\Region;
use Illuminate\Http\Request;
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
                $query->where('region_id', auth()->user()->region_id);
            })
            ->get();
        $hotels = Hotel::orderBy('name', 'asc')->get();
        $regions = Region::orderBy('name', 'asc')->get();
        
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

            Historial::create([
                'accion' => 'Creacion',
                'descripcion' => "Se agregó SW con el nombre: {$registro->name} y con N/S: {$registro->serial}",
                'user_id' => $user,
                'region_id' => auth()->user()->region_id,
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
        return view('equipos.switches.show', compact('switch'));
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

            Historial::create([
                'accion' => 'Actualización',
                'descripcion' => "Se actualizó SW con el nombre: {$switch->name} y con N/S: {$switch->serial}",
                'user_id' => $user,
                'region_id' => auth()->user()->region_id,
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

    public function destroy(String $id)
    {
        $registro = Swittch::findOrFail($id);
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

        return redirect()->route('switches.index');
    }

}
