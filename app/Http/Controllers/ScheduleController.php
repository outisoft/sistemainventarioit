<?php

namespace App\Http\Controllers;

use App\Models\Schedule;
use App\Models\User;
use Illuminate\Http\Request;
use Carbon\Carbon;

class ScheduleController extends Controller
{
    // app/Http/Controllers/ScheduleController.php
    public function index(Request $request)
    {
        // Obtener semana seleccionada o actual
        $week = $request->input('week', date('Y-\WW'));
        
        // Convertir a fechas
        $year = substr($week, 0, 4);
        $weekNum = substr($week, 6, 2);
        $weekStart = Carbon::now()->setISODate($year, $weekNum)->startOfWeek();
        $weekEnd = $weekStart->copy()->endOfWeek();

        $schedules = Schedule::all();
        $days = ['monday', 'tuesday', 'wednesday', 'thursday', 'friday', 'saturday', 'sunday'];
        
        // Obtener empleados con sus horarios para esta semana
        $employees = User::with(['schedules' => function($query) use ($weekStart) {
                $query->where('week_start_date', $weekStart->format('Y-m-d'));
            }])
            ->when(!auth()->user()->hasRole('Administrator'), function ($query) {
                $regionIds = auth()->user()->regions->pluck('id');
                if ($regionIds->isNotEmpty()) {
                    $query->whereHas('regions', function ($q) use ($regionIds) {
                        $q->whereIn('regions.id', $regionIds);
                    });
                }
            })
            ->orderBy('name', 'asc')
            ->get();
        
        return view('schedules.index', compact('schedules'), [
            'days' => $days,
            'employees' => $employees,
            'weekStart' => $weekStart,
            'weekEnd' => $weekEnd,
            'currentWeek' => $week
        ]);
    }

    // Mostrar formulario de creación (GET /schedules/create)
    public function create() {
        $employees = Employee::all();
        $days = ['monday', 'tuesday', 'wednesday', 'thursday', 'friday', 'saturday', 'sunday'];
        return view('schedules.create', compact('employees', 'days'));
    }
    
    // Guardar horario
    public function store(Request $request) {
        try {
            $validated = $request->validate([
                'employee_id' => 'required|exists:users,id',
                'week' => 'required',
                'days' => 'required|array|min:1',
                'days.*' => 'in:monday,tuesday,wednesday,thursday,friday,saturday,sunday',
                'start_time' => 'required|date_format:H:i',
                'end_time' => 'required|date_format:H:i|after:start_time'
            ]);
            
            // Convertir semana ISO a fechas
            $weekStart = Carbon::now()->setISODate(
                substr($validated['week'], 0, 4), // año
                substr($validated['week'], 6, 2)  // semana
            );
            $weekEnd = $weekStart->copy()->endOfWeek();
            
            // Verificar si los días seleccionados ya tienen horarios establecidos
            $conflictingDays = Schedule::where('employee_id', $validated['employee_id'])
                ->where('week_start_date', $weekStart->format('Y-m-d'))
                ->where(function ($query) use ($validated) {
                    foreach ($validated['days'] as $day) {
                        $query->orWhereJsonContains('days', $day);
                    }
                })
                ->exists();
            
            if ($conflictingDays) {
                return back()->with('error', 'El empleado ya tiene horarios asignados para los días seleccionados.');
            }
            
            // Crear el nuevo horario
            Schedule::create([
                'employee_id' => $validated['employee_id'],
                'week_start_date' => $weekStart,
                'week_end_date' => $weekEnd,
                'start_time' => $validated['start_time'],
                'end_time' => $validated['end_time'],
                'days' => array_map('strtolower', $validated['days'])
            ]);

            toastr()
                    ->timeOut(3000)
                    ->addSuccess("Horario asignado!");
        
            return redirect()->route('schedules.index');
            
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
            toastr()
                ->timeOut(5000)
                ->addError("Ocurrió un error inesperado.");
            return back()->withInput();
        }
    }

    // Mostrar detalles de un horario (GET /schedules/{id})
    public function show($id)
    {
        $schedule = Schedule::findOrFail($id);
        return view('schedules.show', compact('schedule'));
    }

    // Mostrar formulario de edición (GET /schedules/{id}/edit)
    public function edit($id)
    {
        $schedule = Schedule::findOrFail($id);
        $employees = User::all();
        $days = ['monday', 'tuesday', 'wednesday', 'thursday', 'friday', 'saturday', 'sunday'];
        return view('schedules.edit', compact('schedule', 'employees', 'days'));
    }

    // Actualizar horario (PUT /schedules/{id})
    public function update(Request $request, $id)
    {
        try {
            $validated = $request->validate([
                'employee_id' => 'required|exists:users,id',
                'week' => 'required',
                'days' => 'required|array|min:1',
                'days.*' => 'in:monday,tuesday,wednesday,thursday,friday,saturday,sunday',
                'start_time' => 'required|date_format:H:i',
                'end_time' => 'required|date_format:H:i|after:start_time'
            ]);

            $schedule = Schedule::findOrFail($id);

            // Convertir semana ISO a fechas
            $weekStart = Carbon::now()->setISODate(
                substr($validated['week'], 0, 4), // año
                substr($validated['week'], 6, 2)  // semana
            );
            $weekEnd = $weekStart->copy()->endOfWeek();

            // Actualizar el horario
            $schedule->update([
                'employee_id' => $validated['employee_id'],
                'week_start_date' => $weekStart,
                'week_end_date' => $weekEnd,
                'start_time' => $validated['start_time'],
                'end_time' => $validated['end_time'],
                'days' => array_map('strtolower', $validated['days'])
            ]);

            toastr()
                ->timeOut(3000)
                ->addSuccess("Horario actualizado correctamente!");

            return redirect()->route('schedules.index');
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

    // Eliminar horario (DELETE /schedules/{id})
    public function destroy($id)
    {
        $schedule = Schedule::findOrFail($id);
        $schedule->delete();

        return redirect()->route('schedules.index')
            ->with('success', 'Horario eliminado correctamente.');
    }

    // Endpoint adicional para switches (ej.: activar/desactivar)
    public function toggle($id) {
        $schedule = Schedule::findOrFail($id);
        $schedule->update(['is_active' => !$schedule->is_active]);

        toastr()
                ->timeOut(3000)
                ->addSuccess("Estado actualizado!");

        return back();
    }

    public function getShiftClass(Employee $employee, string $day): string
    {
        $schedule = $employee->schedules->firstWhere('days', 'like', '%"'.$day.'"%');
        
        if (!$schedule) return 'day-off';
        
        $start = strtotime($schedule->start_time);
        $end = strtotime($schedule->end_time);
        
        if ($day === 'saturday' || $day === 'sunday') {
            return 'weekend-shift';
        } elseif ($end <= strtotime('12:00:00')) {
            return 'morning-shift';
        } elseif ($start >= strtotime('12:00:00')) {
            return 'afternoon-shift';
        } else {
            return 'full-day';
        }
    }

    public function formatShift(Employee $employee, string $day): string
    {
        $schedule = $employee->schedules->firstWhere('days', 'like', '%"'.$day.'"%');
        return $schedule 
            ? date('g:i A', strtotime($schedule->start_time)) . ' - ' . date('g:i A', strtotime($schedule->end_time))
            : 'Libre';
    }
}