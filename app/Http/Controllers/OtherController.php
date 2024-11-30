<?php

namespace App\Http\Controllers;

use App\Models\Tipo;
use App\Models\Equipo;
use App\Models\Historial;
use App\Models\Region;
use Illuminate\Http\Request;
use Illuminate\Validation\Rule;

class OtherController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
        $this->middleware('can:other.index')->only('index');
        $this->middleware('can:other.create')->only('create', 'store');
        $this->middleware('can:other.edit')->only('edit', 'update');
        $this->middleware('can:other.show')->only('show');
        $this->middleware('can:other.destroy')->only('destroy');
    }
    
    public function index()
    {
        $tipo = Tipo::where('name', 'OTHER')->first();

        $equipos = Equipo::where('tipo_id', $tipo->id)
            ->with(['region'])
            ->when(!auth()->user()->hasRole('Administrator'), function ($query) {
                $query->where('region_id', auth()->user()->region_id);
            })
            ->get();

        $regions = Region::orderBy('name', 'asc')->get();

        // Iterar sobre los equipos y verificar si están asignados a un empleado
        foreach ($equipos as $equipo) {
            $equipo->estado = $equipo->empleados->isEmpty() ? 'Libre' : 'En Uso';
        }
        return view('equipos.other.index', compact('equipos', 'regions'));
    }

    public function store(Request $request)
    {
        $user = auth()->id();
        
        try {
            $validated = $request->validate([
                'tipo_id' => 'required',
                'no_contrato' => 'required|string|max:255',
                'marca' => 'required',
                'model' => 'required',
                'serial' => [
                    'required',
                    'unique:equipos',
                ],
                'region_id' => 'required',
            ], [
                'serial.unique' => 'Este número de serie ya está registrado.',
            ]);

            $registro = Equipo::create($validated);
            $registro->save();

            Historial::create([
                'accion' => 'Creacion',
                'descripcion' => "Se agregó equipo con el nombre: {$registro->no_contrato} y con N/S: {$registro->serial}",
                'user_id' => $user,
                'region_id' => auth()->user()->region_id,
            ]);

            toastr()
                ->timeOut(3000)
                ->addSuccess("Se creó {$registro->no_contrato} ({$registro->serial}) correctamente.");

            return redirect()->route('other.index');

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
        try {
            $data = $request->validate([
                'no_contrato' => [
                    'required',
                    'string',
                    'max:255',
                ],
                'marca' => 'required',
                'model' => 'required',
                'serial' => 'required|unique:equipos,serial,' . $id,
                'region_id' => 'required',
            ], [
                'serial.unique' => 'Este número de serie ya está registrado.',
            ]);

            $registro = Equipo::findOrFail($id);
            $registro->update($data);

            Historial::create([
                'accion' => 'Actualización',
                'descripcion' => "Se actualizó SW con el nombre: {$registro->no_contrato} y con N/S: {$registro->serial}",
                'user_id' => $user,
                'region_id' => auth()->user()->region_id,
            ]);

            toastr()
                ->timeOut(3000)
                ->addSuccess("Se actualizó {$registro->no_contrato} ({$registro->serial}) correctamente.");

            return redirect()->route('other.index');

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
        $registro = Equipo::findOrFail($id);
        $registro->delete();

        $user = auth()->id();

        Historial::create([
            'accion' => 'Eliminacion',
            'descripcion' => "Se elimino el {$registro->no_contrato} con N/S {$registro->serial}",
            'user_id' => $user,
            'region_id' => auth()->user()->region_id,
        ]);

        toastr()
            ->timeOut(3000) // 3 second
            ->addSuccess("Se elimino el {$registro->no_contrato} correctamente.");

        return redirect()->route('other.index');
    }
}
