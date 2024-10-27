<?php

namespace App\Http\Controllers;
use App\Models\Tipo;
use App\Models\Equipo;
use App\Models\Historial;
use Illuminate\Http\Request;
use Illuminate\Validation\Rule;
use Illuminate\Validation\ValidationException;

class OtherController extends Controller
{
    public function __construct()
    {
        $this->middleware('can:other.index')->only('index');
        $this->middleware('can:other.create')->only('create', 'store');
        $this->middleware('can:other.edit')->only('edit', 'update');
        $this->middleware('can:other.show')->only('show');
        $this->middleware('can:other.destroy')->only('destroy');
    }
    
    public function index()
    {
        $tipo = Tipo::where('name', 'OTHER')->first();

        $equipos = Equipo::where('tipo_id', $tipo->id)->get();

        // Iterar sobre los equipos y verificar si están asignados a un empleado
        foreach ($equipos as $equipo) {
            $equipo->estado = $equipo->empleados->isEmpty() ? 'Libre' : 'En Uso';
        }
        return view('equipos.other.index', compact('equipos'));
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
            ], [
                'serial.unique' => 'Este número de serie ya está registrado.',
            ]);

            $registro = Equipo::create($validated);
            $registro->save();

            Historial::create([
                'accion' => 'Creacion',
                'descripcion' => "Se agregó equipo con el nombre: {$registro->no_contrato} y con N/S: {$registro->serial}",
                'user_id' => $user,
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

    public function update(Request $request, Equipo $equipo)
    {
        $user = auth()->id();
        
        try {
            $validated = $request->validate([
                'no_contrato' => [
                    'required',
                    'string',
                    'max:255',
                ],
                'marca' => 'required',
                'model' => 'required',
                'serial' => [
                    'required',
                    Rule::unique('equipos')->ignore($equipo->id),
                ],
            ], [
                'serial.unique' => 'Este número de serie ya está registrado.',
            ]);

            $equipo->update($validated);

            Historial::create([
                'accion' => 'Actualización',
                'descripcion' => "Se actualizó SW con el nombre: {$equipo->no_contrato} y con N/S: {$equipo->serial}",
                'user_id' => $user,
            ]);

            toastr()
                ->timeOut(3000)
                ->addSuccess("Se actualizó {$equipo->no_contrato} ({$equipo->serial}) correctamente.");

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
}
