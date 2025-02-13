<?php

namespace App\Http\Controllers;

use App\Models\Departamento;
use App\Models\Empleado;
use App\Models\Equipo;
use App\Models\Historial;
use App\Models\Hotel;
use App\Models\Tipo;
use App\Models\Region;
use Illuminate\Http\Request;
use App\Exports\EmpleadoExport;
use App\Imports\EmpleadoImport;
use Spatie\Permission\Models\Role;
use App\Models\User; // Asegúrate de importar tu modelo de usuario si es necesario
use Maatwebsite\Excel\Facades\Excel;
use Barryvdh\DomPDF\Facade\Pdf as FacadePdf;
use Carbon\Carbon;
//use SimpleSoftwareIO\QrCode\Facades\QrCode;
use Endroid\QrCode\QrCode;
use Endroid\QrCode\Writer\PngWriter;
use Illuminate\Validation\Rule;
use Illuminate\Support\Facades\Response;

class EmpleadoController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
        $this->middleware('can:empleados.index')->only('index');
        $this->middleware('can:empleados.create')->only('create', 'store');
        $this->middleware('can:empleados.edit')->only('edit', 'update');
        $this->middleware('can:empleados.show')->only('show');
        $this->middleware('can:empleados.destroy')->only('destroy');
        $this->middleware('can:empleados.asignacion')->only('agregar');
        $this->middleware('can:empleados.asignacion')->only('asignar');
        $this->middleware('can:empleados.asignacion')->only('desvincular');
        $this->middleware('can:empleados.detalles')->only('detalles');
    }

    public function index()
    {
        $hoteles = Hotel::all();
        $regions = Region::all();

        $empleados = Empleado::with(['region', 'hotel', 'departments'])
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
        
        return view('empleados.index', compact('userRegions', 'empleados', 'hoteles', 'regions'));
    }

    public function create()
    {
        $hoteles = Hotel::all();
        $departamentos = Departamento::all();
        return view('empleados.create', compact('hoteles', 'departamentos'));
    }

    public function store(Request $request)
    {
        try {
            $data = $request->validate([
                'no_empleado' => [
                    'numeric',
                    'required',
                    'unique:empleados',
                    'digits_between:5,8',
                ],
                'name' => 'required',
                'email' => [
                    'required', 
                    'string', 
                    'email', 
                    'max:255', 
                    'unique:' . Empleado::class
                ],
                'puesto' => 'required',
                'departamento_id' => 'required',
                'hotel_id' => 'required|exists:hotels,id',
                'ad' => [
                    'required',
                    'unique:empleados'
                ],
                'region_id' => 'required',
            ], [
                'no_empleado.unique' => 'Este numero de empleado ya esta en uso.',
                'email.unique' => 'Este email ya está en uso por otro empleado.',
                'hotel_id.required' => 'El campo hotel es obligatorio.',
                'departamento_id.required' => 'El campo departamento es obligatorio.',
                'ad.unique' => 'Esta AD ya está en uso por otro empleado.',
            ]);

            $registro = Empleado::create($data);
            $user = auth()->user();

            Historial::create([
                'accion' => 'Creacion',
                'descripcion' => "Se creó el empleado {$registro->name}, con numero de colaborador {$registro->no_empleado}",
                'user_id' => $user->id,
                'region_id' => $registro->region_id,
            ]);

            toastr()
                ->timeOut(3000)
                ->addSuccess("Empleado {$registro->name} creado.");

            return redirect()->route('empleados.index');

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

    public function edit(Empleado $empleado)
    {
        return response()->json([
            'empleado' => $empleado,
        ]);
    }

    // Método para mostrar un registro específico
    public function getEmpleado($no_empleado)
    {
        $empleado = Empleado::where('no_empleado', $no_empleado)
            ->orWhere('ad', $no_empleado)
            ->orWhere('email', $no_empleado)
            ->first();

        return response()->json($empleado);
    }


    public function getDepartamentos(Request $request)
    {
        $hotel = Hotel::find($request->hotel_id);
        $departamentos = $hotel->departments()
            ->orderBy('name', 'asc')
            ->get();
        return response()->json($departamentos);
    }

    // Método para actualizar un registro
    public function update(Request $request, Empleado $empleado)
    {
        try {
            $data = $request->validate([
                'no_empleado' => 
                [
                    'numeric',
                    'required',
                    Rule::unique('empleados')->ignore($empleado->id),
                    'digits_between:5,8',
                ],
                'name' => 'required',
                'email' => [
                    'required', 
                    'string', 
                    'email', 
                    'max:255', 
                    Rule::unique('empleados')->ignore($empleado->id),
                ],
                'puesto' => 'required',
                'departamento_id' => 'required|exists:departamentos,id',
                'hotel_id' => 'required|exists:hotels,id',
                'ad' => [
                    'required',
                    Rule::unique('empleados')->ignore($empleado->id),
                ],
                'region_id' => 'required',
            ], [
                'no_empleado.unique' => 'Este numero de empleado ya esta en uso.',
                'email.unique' => 'Este email ya está en uso por otro empleado.',
                'hotel_id.required' => 'El campo hotel es obligatorio.',
                'departamento_id.required' => 'El campo departamento es obligatorio.',
                'ad.unique' => 'Esta AD ya está en uso por otro empleado.',
            ]);

            $empleado->update($data);

            $user = auth()->user();

            Historial::create([
                'accion' => 'Actualizacion',
                'descripcion' => "Se actualizo el empleado: {$empleado->name}",
                'user_id' => $user->id,
                'region_id' => $empleado->region_id,
            ]);
            // Mostrar notificación Toastr para éxito

            toastr()
                ->timeOut(3000) // 3 second
                ->addSuccess("Empleado {$empleado->name} actualizado.");
            return redirect()->route('empleados.index');

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

    // Método para eliminar un registro
    public function destroy($id)
    {
        $registro = Empleado::findOrFail($id);
        $registro->delete();

        $user = auth()->id();

        Historial::create([
            'accion' => 'Eliminacion',
            'descripcion' => "Se elimino el empleado {$registro->name}",
            'user_id' => $user,
            'region_id' => $registro->region_id,
        ]);

        toastr()
            ->timeOut(3000) // 3 second
            ->addSuccess("Empleado {$registro->name} eliminado.");
        return redirect()->route('empleados.index');
    }

    public function asignarRol($usuarioId, $rol)
    {
        try {
            $usuario = User::find($usuarioId);

            if (!$usuario) {
                return redirect()->back()->with('error', 'Usuario no encontrado.');
            }

            $rol = Role::where('name', $rol)->first();

            if (!$rol) {
                return redirect()->back()->with('error', 'Rol no encontrado.');
            }

            $usuario->assignRole($rol);

            return redirect()->back()->with('success', 'Rol asignado correctamente.');
        } catch (\Exception $e) {
            return redirect()->back()->with('error', 'Ocurrió un error al asignar el rol.');
        }
    }

    public function generateQRCode($employeeId)
    {
        $employee = Empleado::findOrFail($employeeId);
        $url = route('employee.details', $employeeId);

        // Genera el código QR
        $qr = QrCode::create($url)
            ->setSize(280);
        $writer = new PngWriter();
        $result = $writer->write($qr);

        $qrcode = $result->getString();

        return view('empleados.qrcode', compact('qrcode', 'employee'));
    }

    public function downloadQRCode($employeeId)
    {
        $employee = Empleado::findOrFail($employeeId);
        $url = route('employee.details', $employeeId);

        // Genera el código QR
        $qr = QrCode::create($url)
            ->setSize(300);
        $writer = new PngWriter();
        $result = $writer->write($qr);

        $headers = [
            'Content-Type' => $result->getMimeType(),
            'Content-Disposition' => 'attachment; filename="qrcode_employee_' . $employeeId . '.png"',
        ];

        return Response::make($result->getString(), 200, $headers);
    }

    public function employeeDetails($employeeId)
    {
        $employee = Empleado::findOrFail($employeeId);
        //$assignments = $employee->equipmentAssignments()->with('equipment')->get();

        return view('empleados.employee_details', compact('employee'));
    }
}
