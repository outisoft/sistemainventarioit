<?php

namespace App\View\Components;

use Illuminate\View\Component;
use Carbon\Carbon;
use Illuminate\Support\Facades\Log;

class ShiftDisplay extends Component
{
    public $shiftClass;
    public $shiftText;

    public function __construct($employee, $day)
    {
        // Convertir día a MAYÚSCULAS para coincidir con BD
        $dayUpper = strtoupper($day);
    
        $schedule = $employee->schedules->first(function ($schedule) use ($dayUpper) {
            // Asegurarse que days es un array
            $days = is_array($schedule->days) ? $schedule->days : json_decode($schedule->days, true);
            return in_array($dayUpper, array_map('strtoupper', (array)$days));
        });
        
        if (!$schedule) {
            $this->shiftClass = 'day-off';
            $this->shiftText = 'Off';
            return;
        }

        try {
            // Formatear horas
            $start = Carbon::parse($schedule->start_time)->format('g:i A');
            $end = Carbon::parse($schedule->end_time)->format('g:i A');
            $this->shiftText = "$start - $end";
            
            // Determinar clase CSS
            if (in_array($dayUpper, ['SATURDAY', 'SUNDAY'])) {
                $this->shiftClass = 'weekend-shift';
            } elseif ($schedule->end_time <= '12:00:00') {
                $this->shiftClass = 'morning-shift';
            } elseif ($schedule->start_time >= '12:00:00') {
                $this->shiftClass = 'afternoon-shift';
            } else {
                $this->shiftClass = 'full-day';
            }
        } catch (\Exception $e) {
            $this->shiftClass = 'day-off';
            $this->shiftText = 'Error';
        }
    }

    public function render()
    {
        return view('components.shift-display');
    }
}