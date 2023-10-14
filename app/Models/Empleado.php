<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Empleado extends Model
{
    use HasFactory;

    protected $fillable = ['no_empleado','name', 'email', 'puesto', 'departamento_id', 'hotel_id', 'ad', 'equipo_id'];

    public function hotel()
    {
        return $this->belongsTo(Hotel::class, 'hotel_id');
    }
    public function departamento()
    {
        return $this->belongsTo(Departamento::class, 'departamento_id');
    }

    public function equipos()
    {
        return $this->belongsToMany(Equipo::class, 'empleado_equipo', 'empleado_id', 'equipo_id');
    }

    public function empleados_equipos()
    {
        return $this->belongsToMany(Equipo::class, 'empleado_equipo', 'empleado_id', 'equipo_id');
    }

    protected static function boot() //guardar en mayusculas
    {
        parent::boot();

        static::saving(function ($model) {
            foreach ($model->getAttributes() as $key => $value) {
                if (is_string($value)) {
                    $model->{$key} = strtoupper($value);
                }
            }
        });
    }
}
// mantenimiento siankan - secretariamantenimientobpska