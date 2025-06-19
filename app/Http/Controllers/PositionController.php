<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Position;
use Illuminate\Support\Facades\Auth;
use App\Models\Hotel;
use App\Models\Region;
use App\Models\Historial;
use App\Models\Company;
use Illuminate\Validation\Rule;
use Illuminate\Validation\ValidationException;

class PositionController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
        $this->middleware('can:positions.index')->only('index');
        $this->middleware('can:positions.create')->only('create', 'store');
        $this->middleware('can:positions.edit')->only('edit', 'update');
        $this->middleware('can:positions.show')->only('show');
        $this->middleware('can:positions.destroy')->only('destroy');
    }

    public function index()
    {
        $hoteles = Hotel::orderBy('name', 'asc')->get();
        $regions = Region::orderBy('name', 'asc')->get();
        $companies = Company::orderBy('name', 'asc')->get();

        $positions = Position::with(['region', 'hotel', 'departments', 'company'])
            ->when(!auth()->user()->hasRole('Administrator'), function ($query) {
                $regionIds = auth()->user()->regions->pluck('id');
                if ($regionIds->isNotEmpty()) {
                    $query->whereHas('region', function ($q) use ($regionIds) {
                        $q->whereIn('regions.id', $regionIds);
                    });
                }
            })
            ->orderBy('email', 'asc')
            ->get();
        
        $userRegions = auth()->user()->regions;

        return view('positions.index', compact('positions', 'hoteles', 'regions', 'userRegions', 'companies'));
    }

    public function store(Request $request)
    {
        try {
            $data = $request->validate([
                'email' => [
                    'required', 
                    'string', 
                    'email', 
                    'max:255', 
                    'unique:' . Position::class
                ],
                'position' => 'required',
                'department_id' => 'required',
                'hotel_id' => 'required|exists:hotels,id',
                'ad' => [
                    'required',
                    'unique:positions'
                ],
                'company_id' => 'nullable|exists:companies,id',
                'region_id' => 'required',
            ], [
                'email.unique' => 'Este email ya está en uso por otro puesto.',
                'hotel_id.required' => 'El campo hotel es obligatorio.',
                'departamento_id.required' => 'El campo departamento es obligatorio.',
                'ad.unique' => 'Esta AD ya está en uso por otro puesto.',
            ]);

            $registro = Position::create($data);
            $user = auth()->user();

            Historial::create([
                'accion' => 'Creacion',
                'descripcion' => "Se creó el puesto {$registro->position}, con el ad {$registro->ad}",
                'user_id' => $user->id,
                'region_id' => $registro->region_id,
            ]);

            toastr()
                ->timeOut(3000)
                ->addSuccess("Puesto {$registro->position} creado.");

            return redirect()->route('positions.index');

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

    public function edit(Position $position)
    {
        return response()->json([
            'position' => $position,
        ]);
    }

    public function update(Request $request, Position $position)
    {
        try {
            $data = $request->validate([
                'email' => [
                    'required', 
                    'string', 
                    'email', 
                    'max:255', 
                    Rule::unique('positions')->ignore($position->id),
                ],
                'position' => 'required',
                'department_id' => 'required|exists:departamentos,id',
                'hotel_id' => 'required|exists:hotels,id',
                'ad' => [
                    'required',
                    Rule::unique('positions')->ignore($position->id),
                ],
                'company_id' => 'nullable|exists:companies,id',
                'region_id' => 'required',
            ], [
                'email.unique' => 'Este email ya está en uso por otro puesto.',
                'hotel_id.required' => 'El campo hotel es obligatorio.',
                'department_id.required' => 'El campo departamento es obligatorio.',
                'ad.unique' => 'Esta AD ya está en uso para otro puesto.',
            ]);

            $position->update($data);

            $user = auth()->user();

            Historial::create([
                'accion' => 'Actualizacion',
                'descripcion' => "Se actualizo el puesto {$position->position} con ad: {$position->ad}",
                'user_id' => $user->id,
                'region_id' => $position->region_id,
            ]);
            // Mostrar notificación Toastr para éxito

            toastr()
                ->timeOut(3000) // 3 second
                ->addSuccess("Puesto {$position->position} actualizado.");
            return redirect()->route('positions.index');

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

    public function getPosition($position)
    {
        $position = Position::with('employee')->where('ad', $position)
            ->orWhere('email', $position)
            ->first();

        return response()->json($position);
    }

    public function show($id)
    {
        $position = Position::with('employee')->findOrFail($id);
        $equipments = $position->equipments()->with('complements')->first();
        
        return view('assignment.show', compact('position', 'equipments'));
    }

    // Método para eliminar un registro
    public function destroy($id)
    {
        $registro = Position::findOrFail($id);
        $registro->delete();

        $user = auth()->id();

        Historial::create([
            'accion' => 'Eliminacion',
            'descripcion' => "Se elimino el puesto {$registro->position}, con el ad {$registro->ad}",
            'user_id' => $user,
            'region_id' => $registro->region_id,
        ]);

        toastr()
            ->timeOut(3000) // 3 second
            ->addSuccess("Puesto {$registro->position} eliminado.");
        return redirect()->route('positions.index');
    }
}
