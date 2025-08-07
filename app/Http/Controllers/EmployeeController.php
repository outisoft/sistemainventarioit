<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Employee;
use App\Models\Region;
use App\Models\Departamento;
use App\Models\Hotel;
use App\Models\Position;
use App\Models\Historial;
use App\Models\Company;
use Illuminate\Validation\Rule;
use Illuminate\Validation\ValidationException;
use App\Http\Requests\StoreEmployeeRequest;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;

class EmployeeController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
        $this->middleware('can:employees.index')->only('index');
        $this->middleware('can:employees.create')->only('create', 'store');
        $this->middleware('can:employees.edit')->only('edit', 'update');
        $this->middleware('can:employees.show')->only('show');
        $this->middleware('can:employees.destroy')->only('destroy');
    }
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $regions = Region::orderBy('name', 'asc')->get();

        $regions = Region::orderBy('name')->get();
        $departamentos = Departamento::orderBy('name')->get();
        $hotels = Hotel::orderBy('name')->get();
        $companies = Company::orderBy('name')->get();

        $unassignedPositions = Position::whereDoesntHave('employees')
            ->with('region', 'departments', 'hotel') // Cargar relaciones para mostrarlas en el select
            ->get();

        $employees = Employee::with(['position'])
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
        
        $userRegions = auth()->user()->regions;

        return view('employees.index', compact('employees', 'userRegions', 'regions', 'departamentos', 'hotels', 'unassignedPositions', 'companies'));
    }

    /**
     * Store a newly created resource in storage.
     */
    // ... (dentro de EmployeeController)

    public function store(Request $request) // El Form Request se encargará de la validación condicional
    {
        try {
            $data = $request->validate([
                // Reglas que siempre aplican
                'no_employee' => 'required|string|max:50|unique:employees,no_employee',
                'name' => 'required|string|max:255',
                'region_id' => 'required|exists:regions,id',
                'position_choice' => 'required|in:new,existing',

                // --- REGLAS CONDICIONALES ---

                // Reglas para el Puesto Existente
                'position_id_existing' => [
                    'required_if:position_choice,existing', // Requerido solo si se elige 'existing'
                    'exists:positions,id'
                ],

                // Reglas para el Puesto Nuevo
                'email' => [
                    'required_if:position_choice,new', // Requerido solo si se elige 'new'
                    'nullable', // Permite que sea nulo si no es requerido
                    'email',
                    'max:255',
                    'unique:positions,email'
                ],
                'company_id' => 'nullable|exists:companies,id',
                'puesto' => 'required_if:position_choice,new|nullable|string|max:255',
                'departamento_id' => 'required_if:position_choice,new|nullable|exists:departamentos,id',
                'hotel_id' => 'required_if:position_choice,new|nullable|exists:hotels,id',
                'ad' => 'nullable|string|max:255|unique:positions,ad',
            ], [
                'no_employee.unique' => 'Este numero de empleado ya esta en uso.',
                'email.unique' => 'Este email ya está en uso por otro puesto.',
                'hotel_id.required' => 'El campo hotel es obligatorio.',
                'departamento_id.required' => 'El campo departamento es obligatorio.',
                'ad.unique' => 'Esta AD ya está en uso por otro puesto.',
            ]);

            $employee = DB::transaction(function () use ($request) {

                $positionId = null;

                // --- LÓGICA CONDICIONAL ---
                if ($request->input('position_choice') === 'new') {
                    // El usuario quiere crear un puesto nuevo (lógica que ya teníamos)
                    $newPosition = Position::create([
                        'email' => $request->input('email'),
                        'position' => $request->input('puesto'),
                        'department_id' => $request->input('departamento_id'),
                        'hotel_id' => $request->input('hotel_id'),
                        'region_id' => $request->input('region_id'),
                        'ad' => $request->input('ad'),
                        'company_id' => $request->input('company_id', null),
                    ]);
                    $positionId = $newPosition->id;

                } else { // 'existing'
                    // El usuario seleccionó un puesto existente
                    $positionId = $request->input('position_id_existing');
                }

                // Crear el Empleado, usando el positionId obtenido de una de las dos rutas
                $newEmployee = Employee::create([
                    'no_employee' => $request->input('no_employee'),
                    'name' => $request->input('name'),
                    'region_id' => $request->input('region_id'),
                    'position_id' => $positionId,
                ]);

                $user = auth()->user();

                Historial::create([
                    'accion' => 'Creacion',
                    'descripcion' => "Se creó el empleado {$newEmployee->name}, con el numero de empleado {$newEmployee->no_employee} y se le asigno el puesto de trabajo: {$newEmployee->position->position}.",
                    'user_id' => $user->id,
                    'region_id' => $newEmployee->region_id,
                ]);            

                return $newEmployee;
            });

            toastr()
                ->timeOut(3000)
                ->addSuccess("Empleado creado correctamente.");

            return redirect()->route('employees.index', $employee);

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

    /**
     * Display the specified resource.
     */
    public function show($id)
    {
        $employee = Employee::with(['position', 'region'])->findOrFail($id);
        $position = Position::with('employee')->findOrFail($employee->position_id);
        $equipments = $position->equipments()->with('complements')->first();
        
        return view('assignment.show', compact('position', 'equipments'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Employee $employee)
    {
        try {
            $data = $request->validate([
                'no_employee' => 
                [
                    'numeric',
                    'required',
                    Rule::unique('employees')->ignore($employee->id),
                    'digits_between:5,8',
                ],
                'name' => 'required',
                'region_id' => 'required',
            ], [
                'no_employee.unique' => 'Este numero de empleado ya esta en uso.',
            ]);

            $employee->update($data);

            $user = auth()->user();

            Historial::create([
                'accion' => 'Actualizacion',
                'descripcion' => "Se actualizo el empleado: {$employee->name} con numero de empleado: {$employee->no_employee}",
                'user_id' => $user->id,
                'region_id' => $employee->region_id,
            ]);
            // Mostrar notificación Toastr para éxito

            toastr()
                ->timeOut(3000) // 3 second
                ->addSuccess("Empleado {$employee->name} actualizado.");
            return redirect()->route('employees.index');

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

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        try {
            $employee = Employee::findOrFail($id);
            $employee->delete();

            $user = auth()->user();

            Historial::create([
                'accion' => 'Eliminacion',
                'descripcion' => "Se eliminó el empleado: {$employee->name} con numero de empleado: {$employee->no_employee}",
                'user_id' => $user->id,
                'region_id' => $employee->region_id,
            ]);

            toastr()
                ->timeOut(3000)
                ->addSuccess("Empleado {$employee->name} eliminado.");
            return redirect()->route('employees.index');

        } catch (\Exception $e) {
            toastr()
                ->timeOut(5000)
                ->addError("Error al eliminar el empleado: {$e->getMessage()}");
            return back();
        }
    }
}
