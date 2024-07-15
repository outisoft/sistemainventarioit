<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Hotel extends Model
{
    use HasFactory;

    protected $fillable = ['nombre', 'tipo'];

    public function empleados()
    {
        return $this->hasMany(Empleado::class, 'hotel_id');
    }

    //new
    public function departamentos()
    {
        return $this->belongsToMany(Departamento::class);
    }

    // Modelo Hotel
    public function equiposCpu()
    {
        return $this->belongsToMany(Equipo::class, 'empleado_equipo', 'equipo_id')
            ->whereHas('tipo', function ($query) {
                $query->where('name', 'CPU');
            });
    }
}
