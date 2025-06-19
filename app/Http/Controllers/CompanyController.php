<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Validator;
use App\Models\Company;
use App\Models\Region;
use App\Models\Historial;

class CompanyController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
        $this->middleware('can:companies.index')->only('index');
        $this->middleware('can:companies.create')->only('create', 'store');
        $this->middleware('can:companies.edit')->only('edit', 'update');
        $this->middleware('can:companies.destroy')->only('destroy');
    }
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $regions = Region::orderBy('name', 'asc')->get();

        $companies = Company::with(['region'])
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

        return view('companies.index', compact('companies', 'userRegions', 'regions'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        try {
            $data = $request->validate([
                'name' => 'required|string|max:255',
                'description' => 'nullable|string|max:1000',
                'region_id' => 'required|exists:regions,id',
            ], [
                'name.required' => 'El nombre de la empresa es obligatorio.',
                'name.string' => 'El nombre de la empresa debe ser una cadena de texto.',
                'name.max' => 'El nombre de la empresa no puede exceder los 255 caracteres.',
                'description.string' => 'La descripción debe ser una cadena de texto.',
                'description.max' => 'La descripción no puede exceder los 1000 caracteres.',
                'region_id.required' => 'La región es obligatoria.',
                'region_id.exists' => 'La región seleccionada no es válida.',
            ]);

            $registro = Company::create($data);
            $user = auth()->user();

            Historial::create([
                'accion' => 'Creacion',
                'descripcion' => "Se creó la empresa {$registro->name}",
                'user_id' => $user->id,
                'region_id' => $registro->region_id,
            ]);

            toastr()
                ->timeOut(3000)
                ->addSuccess("Name {$registro->name} creado.");

            return redirect()->route('companies.index');

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
        // Logic to show a specific company
    }
    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Company $company)
    {
        try {
            $data = $request->validate([
                'name' => 'required|string|max:255',
                'description' => 'nullable|string|max:1000',
                'region_id' => 'required|exists:regions,id',
            ], [
                'name.required' => 'El nombre de la empresa es obligatorio.',
                'name.string' => 'El nombre de la empresa debe ser una cadena de texto.',
                'name.max' => 'El nombre de la empresa no puede exceder los 255 caracteres.',
                'description.string' => 'La descripción debe ser una cadena de texto.',
                'description.max' => 'La descripción no puede exceder los 1000 caracteres.',
                'region_id.required' => 'La región es obligatoria.',
                'region_id.exists' => 'La región seleccionada no es válida.',
            ]);

            $company->update($data);
            $user = auth()->user();

            Historial::create([
                'accion' => 'Actualizacion',
                'descripcion' => "Se actualizó la empresa {$company->name}",
                'user_id' => $user->id,
                'region_id' => $company->region_id,
            ]);

            toastr()
                ->timeOut(3000)
                ->addSuccess("Name {$company->name} actualizado.");

            return redirect()->route('companies.index');

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
    public function destroy($id)
    {
        try {
            $company = Company::findOrFail($id);
            $user = auth()->user();

            Historial::create([
                'accion' => 'Eliminacion',
                'descripcion' => "Se eliminó la empresa {$company->name}",
                'user_id' => $user->id,
                'region_id' => $company->region_id,
            ]);

            $company->delete();

            toastr()
                ->timeOut(3000)
                ->addSuccess("Name {$company->name} eliminado.");

            return redirect()->route('companies.index');

        } catch (\Exception $e) {
            toastr()
                ->timeOut(5000)
                ->addError("Error al eliminar la empresa: {$e->getMessage()}");
            return back();
        }
    }
}
