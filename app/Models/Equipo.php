<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Equipo extends Model
{
    use HasFactory;

    protected $fillable = ['tipo_id', 'marca', 'modelo', 'serie', 'nombre_equipo', 'ip', 'no_contrato', 'nombre_app', 'so', 'office', 'clave'];

    public function empleados()
    {
        return $this->belongsToMany(Empleado::class, 'empleado_equipo', 'equipo_id', 'empleado_id');
    }

    public function tipo()
    {
        return $this->belongsTo(Tipo::class, 'tipo_id');
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
