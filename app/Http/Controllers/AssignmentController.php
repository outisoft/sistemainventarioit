<?php

namespace App\Http\Controllers;
use App\Models\Empleado;
use App\Models\Historial;
use App\Models\Equipo;
use App\Models\License;
use App\Models\Hotel;
use App\Models\User;
use App\Models\Complement;
use App\Models\Departamento;
use Carbon\Carbon;
use Barryvdh\DomPDF\Facade\Pdf as FacadePdf;
use Endroid\QrCode\QrCode;
use Endroid\QrCode\Writer\PngWriter;
use Illuminate\Support\Facades\Response;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class AssignmentController extends Controller
{
    public function index()
    {
        $empleados = Empleado::with('hotel', 'departments')->orderBy('name', 'asc')->get();
        $equipos = Equipo::with('tipo')->get();
        $empleadosConEquipos = Empleado::whereHas('empleados_equipos')->get();
        $equiposSinAsignar = Equipo::whereDoesntHave('empleados')->get();

        return view('assignment.index', compact('empleados', 'equipos', 'empleadosConEquipos', 'equiposSinAsignar'));
    }

    public function asignar(Request $request)
    {
        $request->validate([
            'empleado_id' => 'required|exists:empleados,id',
            'equipo_id' => [
                'required',
                'exists:equipos,id',
                function ($attribute, $value, $fail) {
                    $equipoAsignado = DB::table('empleado_equipo')
                        ->where('equipo_id', $value)
                        ->exists();
                        
                    if ($equipoAsignado) {
                        toastr()
                            ->timeOut(3000) // 3 second
                            ->addError("Este equipo ya está asignado a otro empleado.");
                        $fail('Este equipo ya está asignado a otro empleado.');
                    }
                },
            ],
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
            'region_id' => $equipo->region_id,
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
            'accion' => 'Desvinculacion',
            'descripcion' => "Se desvinculó al empleado {$empleado->name} el equipo tipo {$equipo->tipo->name} con S/N: {$equipo->serial}",
            'user_id' => $user,
            'region_id' => $equipo->region_id,
        ]);

        toastr()
            ->timeOut(3000) // 3 second
            ->addSuccess("Empleado {$empleado->name} desvinculado.");


        return redirect()->back();
    }

    public function show($id)
    {
        $empleado = Empleado::findOrFail($id);
        $equipo = $empleado->equipment()->with('complements')->first();
        
        return view('assignment.show', compact('empleado', 'equipo'));
    }
    
    public function save_pdf(Request $request, $uuid)
    {
        $users = auth()->id();

        $user = User::findOrFail($users);

        // Obtener la fecha actual
        $today = Carbon::now();
        $months = [
            'January' => 'Enero',
            'February' => 'Febrero',
            'March' => 'Marzo',
            'April' => 'Abril',
            'May' => 'Mayo',
            'June' => 'Junio',
            'July' => 'Julio',
            'August' => 'Agosto',
            'September' => 'Septiembre',
            'October' => 'Octubre',
            'November' => 'Noviembre',
            'December' => 'Diciembre',
        ];

        $date = $today->format('j') . ' de ' . $months[$today->format('F')] . ' del ' . $today->format('Y');

        $equipoIds = explode(',', $request->query('equipos'));
        $complementoIds = explode(',', $request->query('complementos'));
        $equipos = Equipo::whereIn('id', $equipoIds)->get();
        $complements = Complement::whereIn('id', $complementoIds)->get();

        $empleado = Empleado::findOrFail($uuid);// Reemplaza 'Empleado' con el nombre de tu modelo de empleado

        $pdf = FacadePdf::loadView('assignment.save-pdf', compact('empleado', 'date', 'complements', 'user', 'equipos'));
        
        // Asignar el nombre del empleado al archivo PDF
        $fileName = $empleado->name . '-.pdf';
        return $pdf->stream($fileName);
    }

    public function save_pdf_tcc(Request $request, $uuid)
    {
        $users = auth()->id();

        $user = User::findOrFail($users);

        // Obtener la fecha actual
        $today = Carbon::now();
        $months = [
            'January' => 'Enero',
            'February' => 'Febrero',
            'March' => 'Marzo',
            'April' => 'Abril',
            'May' => 'Mayo',
            'June' => 'Junio',
            'July' => 'Julio',
            'August' => 'Agosto',
            'September' => 'Septiembre',
            'October' => 'Octubre',
            'November' => 'Noviembre',
            'December' => 'Diciembre',
        ];

        $date = $today->format('j') . ' de ' . $months[$today->format('F')] . ' del ' . $today->format('Y');

        $equipoIds = explode(',', $request->query('equipos'));
        $complementoIds = explode(',', $request->query('complementos'));
        $equipos = Equipo::whereIn('id', $equipoIds)->get();
        $complementos = Complement::whereIn('id', $complementoIds)->get();

        $empleado = Empleado::findOrFail($uuid);

        $pdf = FacadePdf::loadView('assignment.save-pdf-tcc', compact('empleado', 'date', 'complementos', 'user', 'equipos'));
        
        // Asignar el nombre del empleado al archivo PDF
        $fileName = $empleado->name . '-.pdf';
        return $pdf->stream($fileName);
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
            'Content-Disposition' => 'attachment; filename="QRCODE_' . $employee->name . '.png"',
        ];

        return Response::make($result->getString(), 200, $headers);
    }

    public function employeeDetails($employeeId)
    {
        $employee = Empleado::findOrFail($employeeId);
        
        return view('assignment.details', compact('employee'));
    }
}
