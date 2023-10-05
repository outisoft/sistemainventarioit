<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Empleado extends Model
{
    use HasFactory;

    protected $fillable = ['no_empleado','name', 'email', 'puesto', 'departamento', 'hotel_id', 'ad', 'equipo_id'];

    public function hotel()
    {
        return $this->belongsTo(Hotel::class, 'hotel_id');
    }

    public function equipos()
    {
        return $this->belongsToMany(Equipo::class, 'empleado_equipo', 'empleado_id', 'equipo_id');
    }


    public function empleados_equipos()
    {
        return $this->belongsToMany(Equipo::class, 'empleado_equipo', 'empleado_id', 'equipo_id');
    }

}
// mantenimiento siankan - secretariamantenimientobpska