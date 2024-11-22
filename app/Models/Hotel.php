<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Hotel extends Model
{
    use HasFactory;

    protected $fillable = ['name', 'type', 'region_id'];

    public function empleados()
    {
        return $this->hasMany(Empleado::class, 'hotel_id');
    }
    
    public function switches()
    {
        return $this->hasMany(Swittch::class);
    }

    public function departments()
    {
        return $this->belongsToMany(Departamento::class, 'departamento_hotel');
    }

    // Modelo Hotel
    public function equiposCpu()
    {
        return $this->belongsToMany(Equipo::class, 'empleado_equipo', 'equipo_id')
            ->whereHas('tipo', function ($query) {
                $query->where('name', 'CPU');
            });
    }

    public function region() {
        return $this->belongsTo(Region::class);
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
