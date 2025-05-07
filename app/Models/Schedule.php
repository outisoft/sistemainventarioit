<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Concerns\HasUuids;
use Ramsey\Uuid\Uuid;

class Schedule extends Model
{
    use HasFactory, HasUuids;

    protected $keyType = 'string';
    public $incrementing = false;

    protected $fillable = [
        'employee_id',
        'week_start_date',
        'week_end_date',
        'start_time',
        'end_time',
        'days',
        'is_active'
    ];
    
    protected $casts = [
        'days' => 'array',
        'week_start_date' => 'date:Y-m-d',
        'week_end_date' => 'date:Y-m-d'
    ];    

    // Relación con empleado
    public function employee(): BelongsTo
    {
        return $this->belongsTo(User::class, 'employee_id');
    }

    public function timeLogs()
    {
        return $this->hasMany(TimeLog::class);
    }

    // Accesor para días legibles (opcional)
    public function getDaysAttribute($value)
    {
        // Primero decodificar el JSON
        $days = json_decode($value, true);
        
        // Si ya son días en español, retornarlos directamente
        $spanishDays = ['LUNES', 'MARTES', 'MIERCOLES', 'JUEVES', 'VIERNES', 'SABADO', 'DOMINGO'];
        if (count(array_intersect($days, $spanishDays))) {
            return $days;
        }
        
        // Si no, convertir de inglés a español
        $dayMap = [
            'monday' => 'LUNES',
            'tuesday' => 'MARTES',
            'wednesday' => 'MIERCOLES',
            'thursday' => 'JUEVES',
            'friday' => 'VIERNES',
            'saturday' => 'SABADO',
            'sunday' => 'DOMINGO'
        ];
        
        return array_map(function($day) use ($dayMap) {
            return $dayMap[strtoupper($day)] ?? $day;
        }, $days);
    }
}
