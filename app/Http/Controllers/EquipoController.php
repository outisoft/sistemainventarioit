<?php

namespace App\Http\Controllers;

use App\Models\Equipo;
use App\Models\Historial;
use App\Models\Tipo;
use Illuminate\Http\Request;
use App\Exports\EquipoExport;
use App\Imports\EquipoImport;
use Maatwebsite\Excel\Facades\Excel;
use Illuminate\Support\Facades\Validator;


class EquipoController extends Controller
{
    public function __construct()
    {
        $this->middleware('can:equipos.index')->only('index');
        $this->middleware('can:equipos.create')->only('create', 'store');
        $this->middleware('can:equipos.edit')->only('edit', 'update');
        $this->middleware('can:equipos.show')->only('show');
        $this->middleware('can:equipos.destroy')->only('destroy');
    }
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        // Filtrar equipos por tipo
        // Obtener todos los equipos
        $equipos = Equipo::with('tipo')->get();

        // Iterar sobre los equipos y verificar si están asignados a un empleado
        foreach ($equipos as $equipo) {
            $equipo->estado = $equipo->empleados->isEmpty() ? 'Libre' : 'En Uso';
        }

        return view('equipos.index', compact('equipos'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $tipos = Tipo::all();
        return view('equipos.create', compact('tipos'));
    }

    public function store(Request $request)
    {
        //dd($request);
        $tipo = $request->input('tipo_id');

        // Guarda los datos en la tabla correspondiente según el tipo de equipo
        switch ($tipo) {
            case '1':
                // Guarda en la tabla de Aplicacion
                $data = $request->validate([
                    'tipo_id' => 'required',
                    'nombre_app' => 'required',
                    'clave_app' => 'required',
                ]);
                $registro = Equipo::create($data);
                $registro->clave = $request->input('clave_app');
                $registro->save();
                Historial::create([
                    'accion' => 'Creacion',
                    'descripcion' => "Se agrego la {$registro->tipo->name} - {$registro->nombre_app}",
                    'registro_id' => $registro->id,
                ]);
                toastr()
                    ->timeOut(3000) // 3 second
                    ->addSuccess("Se agrego la app {$registro->nombre_app} correctamente.");
                return redirect()->route('equipo.index');
                break;

            case '2':
                // Guarda en la tabla de cargador
                $data = $request->validate([
                    'tipo_id' => 'required',
                    'marca_cargador' => 'required',
                    'modelo_cargador' => 'required',
                    'serie_cargador' => 'required',
                ]);
                $registro = Equipo::create($data);
                $registro->marca = $request->input('marca_cargador');
                $registro->modelo = $request->input('modelo_cargador');
                $registro->serie = $request->input('serie_cargador');
                $registro->save();
                Historial::create([
                    'accion' => 'Creacion',
                    'descripcion' => "Se agrego el {$registro->tipo->name} de la marca {$registro->marca} y modelo {$registro->modelo}",
                    'registro_id' => $registro->id,
                ]);
                toastr()
                    ->timeOut(3000) // 3 second
                    ->addSuccess("Se agrego un nuevo {$registro->tipo->name} exitosamente.");
                return redirect()->route('equipo.index');
                break;



            case '3':
                // Guarda en la tabla de CPUs
                $data = $request->validate([
                    'tipo_id' => 'required',
                    'orden_cpu' => 'required',
                    'marca_cpu' => 'required',
                    'modelo_cpu' => 'required',
                    'serie_cpu' => 'required',
                    'nombre_equipo_cpu' => 'required',
                    'ip_cpu' => 'required',
                    'contrato_cpu' => 'required',
                ]);
                $registro = Equipo::create($data);
                $registro->orden = $request->input('orden_cpu');
                $registro->marca = $request->input('marca_cpu');
                $registro->modelo = $request->input('modelo_cpu');
                $registro->serie = $request->input('serie_cpu');
                $registro->nombre_equipo = $request->input('nombre_equipo_cpu');
                $registro->ip = $request->input('ip_cpu');
                $registro->no_contrato = $request->input('contrato_cpu');
                $registro->save();

                Historial::create([
                    'accion' => 'Creacion',
                    'descripcion' => "Se agrego un {$registro->tipo->name} de la Marca {$registro->marca} y Modelo {$registro->modelo}",
                    'registro_id' => $registro->id,
                ]);
                toastr()
                    ->timeOut(3000) // 3 second
                    ->addSuccess("Se agrego un {$registro->tipo->name} exitosamente");
                return redirect()->route('equipo.index');

                break;

            case '4':
                // Guarda en la tabla de IMPRESORA
                $data = $request->validate([
                    'tipo_id' => 'required',
                    'marca_impresora' => 'required',
                    'modelo_impresora' => 'required',
                    'serie_impresora' => 'required',
                ]);
                $registro = Equipo::create($data);
                $registro->marca = $request->input('marca_impresora');
                $registro->modelo = $request->input('modelo_impresora');
                $registro->serie = $request->input('serie_impresora');
                $registro->save();
                Historial::create([
                    'accion' => 'Creacion',
                    'descripcion' => "Se agrego una {$registro->tipo->name} de la Marca {$registro->marca} y Modelo {$registro->modelo}",
                    'registro_id' => $registro->id,
                ]);
                toastr()
                    ->timeOut(3000) // 3 second
                    ->addSuccess("Se agrego una {$registro->tipo->name} exitosamente.");
                return redirect()->route('equipo.index');
                break;
            case '5':
                // Guarda en la tabla de Laptop
                $data = $request->validate([
                    'tipo_id' => 'required',
                    'orden' => 'required',
                    'marca_equipo' => 'required',
                    'modelo_equipo' => 'required',
                    'serie_equipo' => 'required',
                    'nombre_equipo' => 'required',
                    'ip' => 'required',
                    'contrato' => 'required',
                ]);
                $registro = Equipo::create($data);
                $registro->marca = $request->input('marca_equipo');
                $registro->modelo = $request->input('modelo_equipo');
                $registro->serie = $request->input('serie_equipo');
                $registro->no_contrato = $request->input('contrato');
                $registro->save();
                Historial::create([
                    'accion' => 'Creacion',
                    'descripcion' => "Se agrego una {$registro->tipo->name} de la marca {$registro->marca} y modelo {$registro->modelo}",
                    'registro_id' => $registro->id,
                ]);
                toastr()
                    ->timeOut(3000) // 3 second
                    ->addSuccess("Se agrego una {$registro->tipo->name} correctamente.");
                return redirect()->route('equipo.index');

                break;

            case '6':
                // Guarda en la tabla de Lector
                $data = $request->validate([
                    'tipo_id' => 'required',
                    'marca_lector' => 'required',
                    'modelo_lector' => 'required',
                    'serie_lector' => 'required',
                ]);
                $registro = Equipo::create($data);
                $registro->marca = $request->input('marca_lector');
                $registro->modelo = $request->input('modelo_lector');
                $registro->serie = $request->input('serie_lector');
                $registro->save();
                Historial::create([
                    'accion' => 'Creacion',
                    'descripcion' => "Se agrego un {$registro->tipo->name} de la marca {$registro->marca} y modelo {$registro->modelo}",
                    'registro_id' => $registro->id,
                ]);
                toastr()
                    ->timeOut(3000) // 3 second
                    ->addSuccess("Se agrego {$registro->tipo->name} correctamente.");
                return redirect()->route('equipo.index');
                break;

            case '7':
                // Guarda en la tabla de monitores
                $data = $request->validate([
                    'tipo_id' => 'required',
                    'marca_monitor' => 'required',
                    'modelo_monitor' => 'required',
                    'serie_monitor' => 'required',
                    'no_contrato' => 'required',
                ]);
                $registro = Equipo::create($data);
                $registro->marca = $request->input('marca_monitor');
                $registro->modelo = $request->input('modelo_monitor');
                $registro->serie = $request->input('serie_monitor');
                $registro->save();
                Historial::create([
                    'accion' => 'Creacion',
                    'descripcion' => "Se agrego un {$registro->tipo->name} de la marca {$registro->marca} y modelo {$registro->modelo}",
                    'registro_id' => $registro->id,
                ]);
                toastr()
                    ->timeOut(3000) // 3 second
                    ->addSuccess("Se agrego un {$registro->tipo->name} exitosamente.");
                return redirect()->route('equipo.index');
                break;

            case '8':
                // Guarda en la tabla de MOUSES
                $data = $request->validate([
                    'tipo_id' => 'required',
                    'marca_mouse' => 'required',
                    'serie_mouse' => 'required',
                ]);
                $registro = Equipo::create($data);
                $registro->marca = $request->input('marca_mouse');
                $registro->serie = $request->input('serie_mouse');
                $registro->save();
                Historial::create([
                    'accion' => 'Creacion',
                    'descripcion' => "Se agrego un {$registro->tipo->name} de la marca {$registro->marca}",
                    'registro_id' => $registro->id,
                ]);
                toastr()
                    ->timeOut(3000) // 3 second
                    ->addSuccess("Se agrego un {$registro->tipo->name} correctamente.");
                return redirect()->route('equipo.index');
                break;

            case '9':
                // Guarda en la tabla de no_breack
                $data = $request->validate([
                    'tipo_id' => 'required',
                    'marca_breack' => 'required',
                    'modelo_breack' => 'required',
                    'serie_breack' => 'required',
                ]);
                $registro = Equipo::create($data);
                $registro->marca = $request->input('marca_breack');
                $registro->modelo = $request->input('modelo_breack');
                $registro->serie = $request->input('serie_breack');
                $registro->save();
                Historial::create([
                    'accion' => 'Creacion',
                    'descripcion' => "Se agrego un {$registro->tipo->name} de la marca {$registro->marca} y modelo {$registro->modelo}",
                    'registro_id' => $registro->id,
                ]);
                toastr()
                    ->timeOut(3000) // 3 second
                    ->addSuccess("Se agrego un nuevo {$registro->tipo->name} exitosamente.");
                return redirect()->route('equipo.index');
                break;

            case '10':
                // Guarda en la tabla de OFFICE
                $data = $request->validate([
                    'tipo_id' => 'required',
                    'office' => 'required',
                    'clave_office' => ['required', 'regex:/^[A-Z0-9]{5}-[A-Z0-9]{5}-[A-Z0-9]{5}-[A-Z0-9]{5}-[A-Z0-9]{5}$/'],
                ]);

                if ($data === "") {
                    toastr()
                        ->timeOut(3000) // 3 second
                        ->addError(" El código de activación no cumple con la estructura requerida");
                    return redirect()->route('equipo.create');
                }

                $registro = Equipo::create($data);
                $registro->clave = $request->input('clave_office');
                $registro->save();
                Historial::create([
                    'accion' => 'Creacion',
                    'descripcion' => "Se agrego nueva licencia {$registro->tipo->name} - {$registro->office}",
                    'registro_id' => $registro->id,
                ]);
                toastr()
                    ->timeOut(3000) // 3 second
                    ->addSuccess("Se agrego nueva licencia de {$registro->tipo->name} exitosamente.");
                return redirect()->route('equipo.index');
                break;
            case '11':
                // Guarda en la tabla de SCANNER
                $data = $request->validate([
                    'tipo_id' => 'required',
                    'marca_escanner' => 'required',
                    'modelo_escanner' => 'required',
                    'serie_escanner' => 'required',
                ]);
                $registro = Equipo::create($data);
                $registro->marca = $request->input('marca_escanner');
                $registro->modelo = $request->input('modelo_escanner');
                $registro->serie = $request->input('serie_escanner');
                $registro->save();
                Historial::create([
                    'accion' => 'Creacion',
                    'descripcion' => "Se agrego un {$registro->tipo->name} de la marca {$registro->marca} y modelo {$registro->modelo}",
                    'registro_id' => $registro->id,
                ]);
                toastr()
                    ->timeOut(3000) // 3 second
                    ->addSuccess("Se agrego un nuevo {$registro->tipo->name} exitosamente.");
                return redirect()->route('equipo.index');
                break;

            case '12':
                //registro de SO
                $rules = [
                    'clave_so' => ['required', 'regex:/^[A-Z0-9]{5}-[A-Z0-9]{5}-[A-Z0-9]{5}-[A-Z0-9]{5}-[A-Z0-9]{5}$/'],
                ];

                $validator = Validator::make($request->all(), $rules);

                if ($validator->fails()) {
                    toastr()
                        ->timeOut(3000) // 3 second
                        ->addError(" El código de activación no cumple con la estructura requerida");
                }

                // Guarda en la tabla de SO
                $data = $request->validate([
                    'tipo_id' => 'required',
                    'so' => 'required',
                    'clave_so' => ['required', 'regex:/^[A-Z0-9]{5}-[A-Z0-9]{5}-[A-Z0-9]{5}-[A-Z0-9]{5}-[A-Z0-9]{5}$/'],
                ]);

                $registro = Equipo::create($data);
                $registro->clave = $request->input('clave_so');
                $registro->save();
                Historial::create([
                    'accion' => 'Creacion',
                    'descripcion' => "Se agrego nueva licencia de {$registro->tipo->name} - {$registro->so}",
                    'registro_id' => $registro->id,
                ]);
                toastr()
                    ->timeOut(3000) // 3 second
                    ->addSuccess("Se agrego nueva licencia de {$registro->tipo->name} exitosamente.");
                return redirect()->route('equipo.index');
                break;


            case '13':
                // Guarda en la tabla de teclados
                $data = $request->validate([
                    'tipo_id' => 'required',
                    'marca_teclado' => 'required',
                    'serie_teclado' => 'required',
                ]);
                $registro = Equipo::create($data);
                $registro->marca = $request->input('marca_teclado');
                $registro->serie = $request->input('serie_teclado');
                $registro->save();
                Historial::create([
                    'accion' => 'Creacion',
                    'descripcion' => "Se agrego un {$registro->tipo->name} de la marca {$registro->marca}",
                    'registro_id' => $registro->id,
                ]);
                toastr()
                    ->timeOut(3000) // 3 second
                    ->addSuccess("Se agrego un nuevo {$registro->tipo->name} exitosamente.");
                return redirect()->route('equipo.index');
                break;


                // Agrega más casos para otros tipos de equipo aquí
        }
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        $registro = Equipo::findOrFail($id);
        $tipo = Tipo::find($registro->tipo_id);
        return view('equipos.show', compact('registro', 'tipo'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        $equipos = Equipo::findOrFail($id);
        $tipos = Tipo::all();
        //dd($equipos);
        return view('equipos.edit', compact('equipos', 'tipos'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        $tipo = $request->input('tipo_id');

        // Guarda los datos en la tabla correspondiente según el tipo de equipo
        switch ($tipo) {
            case 1:
                //dd($request);
                $data = $request->validate([
                    'tipo_id' => 'required',
                    'nombre_app' => 'required',
                    'clave' => 'required',
                ]);

                $registro = Equipo::findOrFail($id);
                //dd($data);
                $registro->update($data);

                Historial::create([
                    'accion' => 'Actualizacion',
                    'descripcion' => "Se actualizo la {$registro->tipo->name} - {$registro->nombre_app}",
                    'registro_id' => $registro->id,
                ]);
                toastr()
                    ->timeOut(3000) // 3 second
                    ->addSuccess("Se actualizo la {$registro->tipo->name} correctamente.");

                return redirect()->route('equipo.index');
                break;

            case 2:
                //dd($request);
                $data = $request->validate([
                    'tipo_id' => 'required',
                    'marca' => 'required',
                    'modelo' => 'required',
                    'serie' => 'required',
                ]);

                $registro = Equipo::findOrFail($id);
                //dd($data);
                $registro->update($data);

                Historial::create([
                    'accion' => 'Actualizacion',
                    'descripcion' => "Se actualizo el {$registro->tipo->name} de la marca {$registro->marca} y modelo {$registro->modelo}",
                    'registro_id' => $registro->id,
                ]);
                toastr()
                    ->timeOut(3000) // 3 second
                    ->addSuccess("Se actualizo el {$registro->tipo->name} correctamente.");

                return redirect()->route('equipo.index');
                break;

            case 3:
                //dd($request);
                $data = $request->validate([
                    'tipo_id' => 'required',
                    'orden' => 'required',
                    'marca' => 'required',
                    'modelo' => 'required',
                    'serie' => 'required',
                    'nombre_equipo' => 'required',
                    'ip' => 'required',
                    'no_contrato' => 'required',
                ]);

                $registro = Equipo::findOrFail($id);
                //dd($data);
                $registro->update($data);

                Historial::create([
                    'accion' => 'Actualizacion',
                    'descripcion' => "Se actualizo el {$registro->tipo->name} de la marca {$registro->marca} y modelo {$registro->modelo}",
                    'registro_id' => $registro->id,
                ]);
                toastr()
                    ->timeOut(3000) // 3 second
                    ->addSuccess("Se actualizo el {$registro->tipo->name} correctamente.");

                return redirect()->route('equipo.index');
                break;
            case 4:
                //dd($request);
                $data = $request->validate([
                    'tipo_id' => 'required',
                    'marca' => 'required',
                    'modelo' => 'required',
                    'serie' => 'required',
                ]);

                $registro = Equipo::findOrFail($id);
                //dd($data);
                $registro->update($data);

                Historial::create([
                    'accion' => 'Actualizacion',
                    'descripcion' => "Se actualizo la {$registro->tipo->name} con la marca {$registro->marca} y modelo {$registro->modelo}",
                    'registro_id' => $registro->id,
                ]);
                toastr()
                    ->timeOut(3000) // 3 second
                    ->addSuccess("Se actualizo la {$registro->tipo->name} correctamente.");

                return redirect()->route('equipo.index');
                break;
            case 5:
                //Laptop
                $data = $request->validate([
                    'tipo_id' => 'required',
                    'orden' => 'required',
                    'marca' => 'required',
                    'modelo' => 'required',
                    'serie' => 'required',
                    'nombre_equipo' => 'required',
                    'ip' => 'required',
                    'no_contrato' => 'required',
                ]);

                $registro = Equipo::findOrFail($id);
                //dd($data);
                $registro->update($data);

                Historial::create([
                    'accion' => 'Actualizacion',
                    'descripcion' => "Se actualizo la {$registro->tipo->name} con la marca {$registro->marca} y modelo {$registro->modelo}",
                    'registro_id' => $registro->id,
                ]);
                toastr()
                    ->timeOut(3000) // 3 second
                    ->addSuccess("Se actualizo la {$registro->tipo->name} correctamente.");

                return redirect()->route('equipo.index');
                break;

            case 6:
                //Lector
                $data = $request->validate([
                    'tipo_id' => 'required',
                    'marca' => 'required',
                    'modelo' => 'required',
                    'serie' => 'required',
                ]);

                $registro = Equipo::findOrFail($id);
                //dd($data);
                $registro->update($data);

                Historial::create([
                    'accion' => 'Actualizacion',
                    'descripcion' => "Se actualizo el {$registro->tipo->name} con la marca {$registro->marca} y modelo {$registro->modelo}",
                    'registro_id' => $registro->id,
                ]);
                toastr()
                    ->timeOut(3000) // 3 second
                    ->addSuccess("Se actualizo el {$registro->tipo->name} correctamente.");

                return redirect()->route('equipo.index');
                break;

            case 7:
                //Monitor
                $data = $request->validate([
                    'tipo_id' => 'required',
                    'marca' => 'required',
                    'modelo' => 'required',
                    'serie' => 'required',
                    'no_contrato' => 'required',
                ]);

                $registro = Equipo::findOrFail($id);
                //dd($data);
                $registro->update($data);

                Historial::create([
                    'accion' => 'Actualizacion',
                    'descripcion' => "Se actualizo el {$registro->tipo->name} - {$registro->marca}",
                    'registro_id' => $registro->id,
                ]);
                toastr()
                    ->timeOut(3000) // 3 second
                    ->addSuccess("Registro {$registro->tipo->name} actualizado.");

                return redirect()->route('equipo.index');
                break;

            case 8:
                //Mouse
                $data = $request->validate([
                    'tipo_id' => 'required',
                    'marca' => 'required',
                    'serie' => 'required',
                ]);

                $registro = Equipo::findOrFail($id);
                //dd($data);
                $registro->update($data);

                Historial::create([
                    'accion' => 'Actualizacion',
                    'descripcion' => "Se actualizo el {$registro->tipo->name} - {$registro->marca}",
                    'registro_id' => $registro->id,
                ]);
                toastr()
                    ->timeOut(3000) // 3 second
                    ->addSuccess("Se actualizo el {$registro->tipo->name} correctamente.");

                return redirect()->route('equipo.index');
                break;
            case 9:
                //No Breack
                $data = $request->validate([
                    'tipo_id' => 'required',
                    'marca' => 'required',
                    'modelo' => 'required',
                    'serie' => 'required',
                ]);

                $registro = Equipo::findOrFail($id);
                //dd($data);
                $registro->update($data);

                Historial::create([
                    'accion' => 'Actualizacion',
                    'descripcion' => "Se actualizo el {$registro->tipo->name} - {$registro->marca}",
                    'registro_id' => $registro->id,
                ]);
                toastr()
                    ->timeOut(3000) // 3 second
                    ->addSuccess("Se actualizo el {$registro->tipo->name} correctamente.");

                return redirect()->route('equipo.index');
                break;

            case 10:
                //Office
                $data = $request->validate([
                    'tipo_id' => 'required',
                    'office' => 'required',
                    'clave' => 'required',
                ]);

                $registro = Equipo::findOrFail($id);
                //dd($data);
                $registro->update($data);

                Historial::create([
                    'accion' => 'Actualizacion',
                    'descripcion' => "Se actualizo el {$registro->tipo->name} - {$registro->office}",
                    'registro_id' => $registro->id,
                ]);
                toastr()
                    ->timeOut(3000) // 3 second
                    ->addSuccess("Se actualizo el {$registro->tipo->name} Correctamente.");

                return redirect()->route('equipo.index');
                break;

            case 11:
                //Scanner
                $data = $request->validate([
                    'tipo_id' => 'required',
                    'marca' => 'required',
                    'modelo' => 'required',
                    'serie' => 'required',
                ]);

                $registro = Equipo::findOrFail($id);
                //dd($data);
                $registro->update($data);

                Historial::create([
                    'accion' => 'Actualizacion',
                    'descripcion' => "Se actualizo el {$registro->tipo->name} de la marca {$registro->marca} y modelo {$registro->modelo}",
                    'registro_id' => $registro->id,
                ]);
                toastr()
                    ->timeOut(3000) // 3 second
                    ->addSuccess("Se actualizo {$registro->tipo->name} correctamente.");

                return redirect()->route('equipo.index');
                break;

            case 12:
                //SO
                $data = $request->validate([
                    'tipo_id' => 'required',
                    'so' => 'required',
                    'clave' => 'required',
                ]);

                $registro = Equipo::findOrFail($id);
                //dd($data);
                $registro->update($data);

                Historial::create([
                    'accion' => 'Actualizacion',
                    'descripcion' => "Se actualizo el {$registro->tipo->name} - {$registro->so}",
                    'registro_id' => $registro->id,
                ]);
                toastr()
                    ->timeOut(3000) // 3 second
                    ->addSuccess("Se actualizo {$registro->tipo->name} correctamente.");

                return redirect()->route('equipo.index');
                break;

            case 13:
                //Teclado
                $data = $request->validate([
                    'tipo_id' => 'required',
                    'marca' => 'required',
                    'serie' => 'required',
                ]);

                $registro = Equipo::findOrFail($id);
                //dd($data);
                $registro->update($data);

                Historial::create([
                    'accion' => 'Actualizacion',
                    'descripcion' => "Se actualizo el {$registro->tipo->name} de la marca {$registro->marca}",
                    'registro_id' => $registro->id,
                ]);
                toastr()
                    ->timeOut(3000) // 3 second
                    ->addSuccess("Se actualizo el {$registro->tipo->name} correcatamente.");

                return redirect()->route('equipo.index');
                break;
        }
        //dd($request);
        /*$data = $request->validate([
            'tipo_id' => 'required',
        ]);

        $registro = Equipo::findOrFail($id);
        //dd($data);
        $registro->update($data);

        Historial::create([
            'accion' => 'Actualizacion',
            'descripcion' => "Se actualizo el registro {$registro->tipo->name} - {$registro->marca}",
            'registro_id' => $registro->id,
        ]);
        toastr()
            ->timeOut(3000) // 3 second
            ->addSuccess("Registro {$registro->tipo->name} actualizado.");

        return redirect()->route('equipo.index');*/
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $registro = Equipo::findOrFail($id);
        $registro->delete();

        Historial::create([
            'accion' => 'Eliminacion',
            'descripcion' => "Se elimino el {$registro->tipo->name} correctamente",
            'registro_id' => $registro->id,
        ]);

        toastr()
            ->timeOut(3000) // 3 second
            ->addSuccess("Se elimino el {$registro->tipo->name}.");

        return redirect()->route('equipo.index');
    }

    public function search(Request $request)
    {


        $query = $request->get('query');
        $equipos = Equipo::where('tipo_id', 'like', '%' . $query . '%')
            ->orWhere('marca', 'like', '%' . $query . '%')
            ->orWhere('nombre_equipo', 'like', '%' . $query . '%')
            ->get();

        // Iterar sobre los equipos y verificar si están asignados a un empleado
        foreach ($equipos as $equipo) {
            $equipo->estado = $equipo->empleados->isEmpty() ? 'Libre' : 'En Uso';
        }

        return view('equipos._employee_list', compact('equipos'));
    }

    public function export()
    {
        $equipos = Equipo::all();
        toastr()
            ->timeOut(3000) // 3 second
            ->addSuccess("Exportacion de datos correctamente.");

        return Excel::download(new EquipoExport($equipos), 'equipos.xlsx');
    }

    public function import()
    {
        Excel::import(new EquipoImport, request()->file('file'));

        toastr()
            ->timeOut(3000) // 3 second
            ->addSuccess("Importacion de datos correctamente.");

        return redirect()->route('equipo.index');
    }
}
