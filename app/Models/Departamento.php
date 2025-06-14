<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Departamento extends Model
{
    use HasFactory;

    protected $fillable = ['name'];

    public function empleados()
    {
        return $this->hasMany(Empleado::class);
    }

    public function positions()
    {
        return $this->hasMany(Position::class);
    }

    //new
    public function hotels()
    {
        return $this->belongsToMany(Hotel::class, 'departamento_hotel');
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
