<?php

namespace App\Http\Controllers;
use App\Models\Tablet;
use App\Models\Historial;
use App\Models\Policy;
use App\Models\Coming2;
use App\Models\Region;
use Barryvdh\DomPDF\Facade\Pdf as FacadePdf;
use Carbon\Carbon;
use Illuminate\Support\Facades\DB;

use Illuminate\Http\Request;

class Coming2Controller extends Controller
{
    public function __construct()
    {
        $this->middleware('can:coming2.index')->only('index');
        $this->middleware('can:coming2.create')->only('create', 'store');
        $this->middleware('can:coming2.edit')->only('edit', 'update');
        $this->middleware('can:coming2.show')->only('show');
        $this->middleware('can:coming2.destroy')->only('destroy');
    }

    public function index()
    {
        $regions = Region::orderBy('name', 'asc')->get();
        $politicas = Policy::orderBy('name')->get();
        $tablets = Coming2::with(['region'])
            ->when(!auth()->user()->hasRole('Administrator'), function ($query) {
                $regionIds = auth()->user()->regions->pluck('id');
                if ($regionIds->isNotEmpty()) {
                    $query->whereHas('region', function ($q) use ($regionIds) {
                        $q->whereIn('regions.id', $regionIds);
                    });
                }
            })
            ->orderBy('operario', 'asc')
            ->get();
        
        $userRegions = auth()->user()->regions;
        
        return view('coming2.index', compact('userRegions', 'tablets', 'politicas', 'regions'));
    }

    public function store(Request $request)
    {
        try {
            $data = $request->validate([
                'region_id' => 'required',
                'operario' => 'required',
                'puesto' => 'required',
                'email' => ['required', 'string', 'email', 'max:255', 'unique:' . Coming2::class],
                'usuario' => ['required', 'unique:' . Coming2::class],
                'password' => ['required'],
                'numero_tableta' => ['required', 'unique:' . Coming2::class],
                'model' => 'required',
                'serial' => ['required', 'unique:' . Coming2::class],
                'numero_telefono' => ['required', 'unique:' . Coming2::class],
                'imei' => ['required', 'unique:' . Coming2::class],
                'sim' => ['required', 'unique:' . Coming2::class],
                'policy_id' => 'required',
                'configurada' => 'required',
                'carta_firmada' => 'required',
                'observacion' => 'required',
                'folio_baja' => ['required', 'unique:' . Coming2::class],
            ], [
                'email.unique' => 'Este email ya está en uso por otro operario.',
                'usuario.unique' => 'El nombre de usuario ya esta en uso.',
                'numero_tableta.unique' => 'El numero de tableta ya esta en uso.',
                'serial.unique' => 'El numero de serie ya esta en uso.',
                'numero_telefono.unique' => 'El numero de telefono ya esta en uso.',
                'imei.unique' => 'El numero de IMEI ya esta en uso.',
                'sim.unique' => 'El numero de SIM ya esta en uso.',
                'folio_baja.unique' => 'El numero de folio de baja ya esta en uso.',
            ]);

            $registro = Coming2::create($data);

            $registro->regions()->sync($request->regions);

            //dd($request);
            $user = auth()->id();

            Historial::create([
                'accion' => 'Creacion',
                'descripcion' => "Se creó la tableta para {$registro->operario} con numero de serie {$registro->serial}",
                'user_id' => $user,
                'region_id' => $registro->regions()->sync($request->regions),
            ]);

            toastr()
                ->timeOut(3000) // 3 second
                ->addSuccess("Registro creado exitosamente.");

            return redirect()->route('coming2.index');

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

    public function show(Coming2 $coming2)
    {
        $policies = Policy::orderBy('name')->get();
        return view('coming2.show', compact('coming2', 'policies'));
    }

    public function edit(string $id)
    {
        $tablets = Coming2::findOrFail($id);
        $politicas = Policy::orderBy('name')->get();
        $regions = Region::orderBy('name')->get();
        $userRegions = auth()->user()->regions;
        return view('coming2.edit', compact('userRegions', 'tablets', 'politicas', 'regions'));
    }

    public function update(Request $request, $id)
    {
        try {
            $data = $request->validate([
                'region_id' => 'required',
                'operario' => 'required',
                'puesto' => 'required',
                'email' => 'required|string|email|max:255|unique:coming2s,email,' . $id,
                'usuario' => ['required', 'unique:coming2s,usuario,' . $id],
                'password' => ['required'],
                'numero_tableta' => ['required', 'unique:coming2s,numero_tableta,' . $id],
                'model' => 'required',
                'serial' => ['required', 'unique:coming2s,serial,' . $id],
                'numero_telefono' => ['required', 'unique:coming2s,numero_telefono,' . $id],
                'imei' => ['required', 'unique:coming2s,imei,' . $id],
                'sim' => ['required', 'unique:coming2s,sim,' . $id],
                'policy_id' => 'required',
                'configurada' => 'required',
                'carta_firmada' => 'required',
                'observacion' => 'required',
                'folio_baja' => ['required', 'unique:coming2s,folio_baja,' . $id],
            ], [
                'email.unique' => 'Este email ya está en uso por otro operario.',
                'usuario.unique' => 'El nombre de usuario ya esta en uso.',
                'numero_tableta.unique' => 'El numero de tableta ya esta en uso.',
                'serial.unique' => 'El numero de serie ya esta en uso.',
                'numero_telefono.unique' => 'El numero de telefono ya esta en uso.',
                'imei.unique' => 'El numero de IMEI ya esta en uso.',
                'sim.unique' => 'El numero de SIM ya esta en uso.',
                'folio_baja.unique' => 'El numero de folio de baja ya esta en uso.',
            ]);

            $registro = Coming2::findOrFail($id);
            $registro->update($data);

            $user = auth()->id();

            Historial::create([
                'accion' => 'Actualizacion',
                'descripcion' => "Se actualizo la tableta de {$registro->operario} con numero de serie {$registro->serial}",
                'user_id' => $user,
                'region_id' => $registro->region_id,
            ]);

            toastr()
                ->timeOut(3000) // 3 second
                ->addSuccess("Registro {$registro->operario} actualizado.");

            return redirect()->route('coming2.index');
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

    public function trash($id)
    {
        $tablet = Coming2::findOrFail($id);
        $tablet->delete();

        $user = auth()->id();

        Historial::create([
            'accion' => 'Papelera',
            'descripcion' => "Se envio a la papelera la tablet con numero de serie {$tablet->serial}",
            'user_id' => $user,
            'region_id' => $tablet->region_id,
        ]);

        toastr()
            ->timeOut(3000) // 3 second
            ->addSuccess("Tablet eliminado.");
        return redirect()->route('coming2.index');
    }

    // Método para restaurar empleado
    public function restore($id)
    {
        $tablet = Coming2::withTrashed()->findOrFail($id);
        $tablet->restore();

        $user = auth()->id();

        Historial::create([
            'accion' => 'Papelera',
            'descripcion' => "Se restauro de la papelera la tablet con numero de serie {$tablet->serial}",
            'user_id' => $user,
            'region_id' => $tablet->region_id,
        ]);

        toastr()
            ->timeOut(3000) // 3 second
            ->addSuccess("Equipo restaurado correctamente.");
        return redirect()->route('co2.trashed');
    }

    // Método para listar empleados eliminados
    public function trashedEmpleados()
    {
        $politicas = Policy::orderBy('name')->get();
        $tablets = Coming2::onlyTrashed()->get();
        return view('coming2.trashed', compact('tablets', 'politicas'));
        //return response()->json($empleados);
    }

    public function destroy($id)
    {
        try {
            $tablet = Coming2::withTrashed()->findOrFail($id);
            $tablet->forceDelete();
            $user = auth()->id();

            // Crea un registro en el historial
            Historial::create([
                'accion' => 'Eliminacion',
                'descripcion' => "Se elimino la tableta de {$tablet->operario} con numero de serie {$tablet->serial}",
                'user_id' => $user,
                'region_id' => $tablet->region_id,
            ]);

            toastr()
                ->timeOut(3000) // 3 segundos
                ->addSuccess("Tablet de {$tablet->operario} eliminado.");

            // Redirige a la ruta especificada
            return redirect()->route('co2.trashed');
        } catch (\Exception $e) {
            // Muestra el error
            return back()->withErrors(['error' => $e->getMessage()]);
        }
    }

    public function save_pdf($id)
    {

        // Obtener la fecha actual
        $today = Carbon::now();

        // Formatear la fecha como "día, mes y año"
        $date = $today->format('d \d\e M \d\e\l Y');

        $tablet = Coming2::findOrFail($id);
        $pdf = FacadePdf::loadView('coming2.save-pdf', compact('tablet', 'date'));
        return $pdf->stream();
    }
}
