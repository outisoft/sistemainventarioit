<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Equipo extends Model
{
    use HasFactory;

    protected $fillable = ['tipo', 'no_equipo', 'estado', 'equipo', 'marca', 'modelo', 'serie', 'nombre_equipo', 'ip', 'no_contrato', 'nombre_app', 'so', 'office', 'clave'];

    public function empleados()
    {
        return $this->belongsToMany(Empleado::class, 'empleado_equipo', 'equipo_id', 'empleado_id');
    }
}
