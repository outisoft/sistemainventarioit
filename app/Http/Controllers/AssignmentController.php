<?php

namespace App\Http\Controllers;
use App\Models\Empleado;
use App\Models\Historial;
use App\Models\Equipo;
use App\Models\Hotel;
use App\Models\Departamento;
use Carbon\Carbon;
use Barryvdh\DomPDF\Facade\Pdf as FacadePdf;
use Endroid\QrCode\QrCode;
use Endroid\QrCode\Writer\PngWriter;
use Illuminate\Support\Facades\Response;
use Illuminate\Http\Request;

class AssignmentController extends Controller
{
    public function index()
    {
        $empleados = Empleado::with('hotel', 'departamento')->orderBy('name', 'asc')->get();
        $equipos = Equipo::with('tipo')->get();
        //$equipos = DB::table('equipos')->get();
        $empleadosConEquipos = Empleado::whereHas('empleados_equipos')->get();
        $equiposSinAsignar = Equipo::whereDoesntHave('empleados')->get();

        return view('assignment.index', compact('empleados', 'equipos', 'empleadosConEquipos', 'equiposSinAsignar'));
    }

    public function asignar(Request $request)
    {
        $request->validate([
            'empleado_id' => 'required|exists:empleados,id',
            'equipo_id' => 'required|exists:equipos,id',
        ]);

        $empleado = Empleado::find($request->input('empleado_id'));
        $empleado->equipos()->attach($request->input('equipo_id'));

        $equipo = Equipo::where('id', $request->equipo_id)->with('tipo')->first();
        //dd($equipo->tipo->name);

        $user = auth()->id();

        Historial::create([
            'accion' => 'Asignacion',
            'descripcion' => "Se asigno al empleado {$empleado->name} el equipo tipo {$equipo->tipo->name} N/S: {$equipo->serial}",
            'user_id' => $user,
        ]);

        toastr()
            ->timeOut(3000) // 3 second
            ->addSuccess("Empleado {$empleado->name} asignado.");


        return redirect()->route('assignment.index');
    }

    public function desvincular($empleado_id, $equipo_id)
    {
        $empleado = Empleado::find($empleado_id);
        $empleado->equipos()->detach($equipo_id);

        $equipo = Equipo::where('id', $equipo_id)->with('tipo')->first();
        //dd($equipo->tipo->name);
        $user = auth()->id();
        Historial::create([
            'accion' => 'Desvinculó',
            'descripcion' => "Se desvinculó al empleado {$empleado->name} el equipo tipo {$equipo->tipo->name}",
            'user_id' => $user,
        ]);

        toastr()
            ->timeOut(3000) // 3 second
            ->addSuccess("Empleado {$empleado->name} desvinculado.");


        return redirect()->route('assignment.index');
    }

    public function show($id)
    {
        $empleado = Empleado::find($id); // Reemplaza 'Empleado' con el nombre de tu modelo de empleado
        $hotel = Hotel::find($empleado->hotel_id); // Obtiene el hotel asociado al empleado
        $departamento = Departamento::find($empleado->departamento_id);
        return view('assignment.show', compact('empleado', 'hotel', 'departamento'));
    }

    public function save_pdf($id){

        // Obtener la fecha actual
        $today = Carbon::now();

        // Formatear la fecha como "día, mes y año"
        $date = $today->format('d \d\e M \d\e\l Y');

        $empleado = Empleado::findOrFail($id);

        $pdf = FacadePdf::loadView('assignment.save-pdf', compact('empleado', 'date'));
        return $pdf->stream();
    }

    public function generateQRCode($employeeId)
    {
        $employee = Empleado::findOrFail($employeeId);
        $url = route('employeeDetails', $employeeId);

        // Genera el código QR
        $qr = QrCode::create($url)
            ->setSize(280);
        $writer = new PngWriter();
        $result = $writer->write($qr);

        $qrcode = $result->getString();

        return view('assignment.qrcode', compact('qrcode', 'employee'));
    }

    public function downloadQRCode($employeeId)
    {
        $employee = Empleado::findOrFail($employeeId);
        $url = route('employeeDetails', $employeeId);

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

        return view('assignment.details', compact('employee'));
    }
}
