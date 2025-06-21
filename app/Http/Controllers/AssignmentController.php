<?php

namespace App\Http\Controllers;
use App\Models\Empleado;
use App\Models\Historial;
use App\Models\Equipo;
use App\Models\License;
use App\Models\Hotel;
use App\Models\User;
use App\Models\Complement;
use App\Models\Position;
use App\Models\Departamento;
use App\Models\Positions;
use Carbon\Carbon;
use Barryvdh\DomPDF\Facade\Pdf as FacadePdf;
use Endroid\QrCode\QrCode;
use Endroid\QrCode\Writer\PngWriter;
use Illuminate\Support\Facades\Response;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Str;

use PhpOffice\PhpWord\PhpWord;
use PhpOffice\PhpWord\Shared\Html;
use PhpOffice\PhpWord\IOFactory;

class AssignmentController extends Controller
{
    public function index()
    {
        $positions = Position::with(['equipments', 'hotel', 'departments'])->get(); // Carga la relación equipment

        $equipos = Equipo::with('tipo')->get();
        $empleadosConEquipos = Position::whereHas('equipments')->get();
        $equiposSinAsignar = Equipo::whereDoesntHave('positions')->get();

        return view('assignment.index', compact('positions', 'equipos', 'empleadosConEquipos', 'equiposSinAsignar'));
    }

    public function asignar(Request $request)
    {
        $request->validate([
            'position_id' => 'required|exists:positions,id',
            'equipo_id' => [
                'required',
                'exists:equipos,id',
                function ($attribute, $value, $fail) {
                    $equipoAsignado = DB::table('equipment_position')
                        ->where('equipo_id', $value)
                        ->exists();
                    if ($equipoAsignado) {
                        $fail('Este equipo ya está asignado a otro puesto.');
                    }
                },
            ],
        ]);

        $position = Position::find($request->input('position_id'));
        // Verifica que la relación esté bien definida en el modelo Position
        //$position->equipments()->attach($request->input('equipo_id'));

        $position->equipments()->attach($request->equipo_id);

        $equipo = Equipo::where('id', $request->equipo_id)->with('tipo')->first();
        $user = auth()->id();

        Historial::create([
            'accion' => 'Asignacion',
            'descripcion' => "Se asigno al puesto {$position->position} el equipo tipo {$equipo->tipo->name} N/S: {$equipo->serial}",
            'user_id' => $user,
            'region_id' => $equipo->region_id,
        ]);

        toastr()
            ->timeOut(3000)
            ->addSuccess("Puesto {$position->position} asignado.");

        return redirect()->route('assignment.index');
    }

    public function desvincular($position_id, $equipo_id)
    {
        $position = Position::find($position_id);
        $position->equipments()->detach($equipo_id);

        $equipo = Equipo::where('id', $equipo_id)->with('tipo')->first();
        //dd($equipo->tipo->name);
        $user = auth()->id();
        Historial::create([
            'accion' => 'Desvinculacion',
            'descripcion' => "Se desvinculó al puesto {$position->position} el equipo tipo {$equipo->tipo->name} con S/N: {$equipo->serial}",
            'user_id' => $user,
            'region_id' => $equipo->region_id,
        ]);

        toastr()
            ->timeOut(3000) // 3 second
            ->addSuccess("Puesto {$position->position} desvinculado.");


        return redirect()->back();
    }

    public function show($id)
    {
        $position = Position::with('employee')->findOrFail($id);
        $equipments = $position->equipments()->with('complements')->first();
        
        return view('assignment.show', compact('position', 'equipments'));
    }
    
    public function save_word(Request $request, $uuid) // Renombramos la función
    {
        // 1. OBTENCIÓN DE DATOS (Esta lógica se mantiene igual)
        $users = auth()->id();
        $user = User::findOrFail($users);

        $today = Carbon::now();
        $months = [
            'January' => 'Enero', 'February' => 'Febrero', 'March' => 'Marzo',
            'April' => 'Abril', 'May' => 'Mayo', 'June' => 'Junio',
            'July' => 'Julio', 'August' => 'Agosto', 'September' => 'Septiembre',
            'October' => 'Octubre', 'November' => 'Noviembre', 'December' => 'Diciembre',
        ];
        $date = $today->format('j') . ' de ' . $months[$today->format('F')] . ' del ' . $today->format('Y');

        $equipoIds = explode(',', $request->query('equipos'));
        $complementoIds = explode(',', $request->query('complementos'));
        $equipos = Equipo::whereIn('id', $equipoIds)->get();
        $complements = Complement::whereIn('id', $complementoIds)->get();   
        
        // Asumo que la relación es position->employee, si no, ajústalo.
        $position = Position::with('employee')->findOrFail($uuid);
        
        // 2. CREACIÓN DEL DOCUMENTO WORD
        $phpWord = new PhpWord();
        
        // Añadir una sección al documento
        $section = $phpWord->addSection();

        // Renderizar la vista de Blade a una variable de HTML
        // Pasamos los mismos datos que antes
        $html = view('assignment.save-word', compact('position', 'date', 'complements', 'user', 'equipos'))->render();

        //dd($html);

        // Añadir el contenido HTML a la sección de Word
        // OJO: La conversión de HTML a Word tiene limitaciones. HTML simple funciona mejor.
        // Línea CORREGIDA Y DEFINITIVA:
        //Html::addHtml($section, htmlspecialchars($html, ENT_QUOTES, 'UTF-8'), false, false);
        Html::addHtml($section, $html, false, false);
        
        // 3. GENERAR Y ENVIAR LA RESPUESTA
        $fileName = $position->employee->name . '-responsiva.docx'; // Cambiamos la extensión a .docx

        // Necesitamos crear los headers correctos para forzar la descarga
        // Usaremos un closure para escribir directamente en el stream de salida
        return response()->stream(function() use ($phpWord) {
            $writer = IOFactory::createWriter($phpWord, 'Word2007');
            $writer->save('php://output');
        }, 200, [
            "Content-Type" => "application/vnd.openxmlformats-officedocument.wordprocessingml.document",
            "Content-Disposition" => "attachment; filename=\"{$fileName}\""
        ]);
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

        $position = Position::findOrFail($uuid);// Reemplaza 'Empleado' con el nombre de tu modelo de empleado

        $pdf = FacadePdf::loadView('assignment.save-pdf', compact('position', 'date', 'complements', 'user', 'equipos'));
        
        // Asignar el nombre del empleado al archivo PDF
        $fileName = $position->employee->name . '-.pdf';
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

        $position = Position::findOrFail($uuid);

        $pdf = FacadePdf::loadView('assignment.save-pdf-tcc', compact('position', 'date', 'complementos', 'user', 'equipos'));
        
        // Asignar el nombre del empleado al archivo PDF
        $fileName = $position->employee->name . '-.pdf';
        return $pdf->stream($fileName);
    }

    public function generateQRCode($positionId)
    {
        $position = Position::findOrFail($positionId);
        $url = route('employeeDetails', $positionId);

        // Genera el código QR
        $qr = QrCode::create($url)
            ->setSize(280);
        $writer = new PngWriter();
        $result = $writer->write($qr);

        $qrcode = $result->getString();

        return view('assignment.qrcode', compact('qrcode', 'position'));
    }

    public function downloadQRCode($positionId)
    {
        $position = Position::findOrFail($positionId);
        $url = route('employeeDetails', $positionId);

        // Genera el código QR
        $qr = QrCode::create($url)
            ->setSize(300);
        $writer = new PngWriter();
        $result = $writer->write($qr);

        $headers = [
            'Content-Type' => $result->getMimeType(),
            'Content-Disposition' => 'attachment; filename="QRCODE_' . $position->employee->name . '.png"',
        ];

        return Response::make($result->getString(), 200, $headers);
    }

    public function employeeDetails($positionId)
    {
        $position = Position::findOrFail($positionId);
        
        return view('assignment.details', compact('position'));
    }
}
