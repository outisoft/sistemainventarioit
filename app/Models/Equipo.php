<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Equipo extends Model
{
    use HasFactory;

    protected $fillable = ['tipo_id', 'marca', 'model', 'serial', 'name', 'ip', 'so', 'policy_id', 'email', 'password', 'no_contrato','orden'];

    public function empleados()
    {
        return $this->belongsToMany(Empleado::class, 'empleado_equipo', 'equipo_id', 'empleado_id');
    }

    public function employees()
    {
        return $this->belongsToMany(Empleado::class, 'empleado_equipo');
    }

    public function tipo()
    {
        return $this->belongsTo(Tipo::class, 'tipo_id');
    }

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function maintenances()
    {
        return $this->hasMany(Maintenance::class);
    }

    public function policy()
    {
        return $this->belongsTo(Policy::class);
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
