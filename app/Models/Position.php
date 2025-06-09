<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Builder;
use Ramsey\Uuid\Uuid; // Asegúrate de tener instalado ramsey/uuid

class Position extends Model
{
    use HasFactory;
    protected $keyType = 'string';
    public $incrementing = false;

    protected $fillable = ['email', 'position', 'department_id', 'hotel_id', 'ad', 'region_id'];

    public function employees()
    {
        return $this->hasMany(Employee::class);
    }

    public function employee()
    {
        return $this->hasOne(Employee::class);
    }

    public function departments()
    {
        return $this->belongsTo(Departamento::class, 'department_id');
    }

    public function hotel()
    {
        return $this->belongsTo(Hotel::class);
    }

    public function region()
    {
        return $this->belongsTo(Region::class, 'region_id');
    }

    /*public function equipments()
    {
        return $this->belongsToMany(Equipo::class, 'equipment_position', 'position_id', 'equipo_id')->withTimestamps();
    }*/

    // app/Models/Position.php
    public function equipments()
    {
        return $this->belongsToMany(Equipo::class, 'equipment_position')
                    ->using(EquipmentPosition::class) // Especifica el modelo pivote
                    ->withPivot(['id', 'created_at', 'updated_at']); // Incluye el UUID
    }

    protected static function boot()
    {
        parent::boot();

        static::saving(function ($model) {
            foreach ($model->getAttributes() as $key => $value) {
                // Excluir el campo 'id' y otros campos que no deben ser mayúsculas
                if (is_string($value) && $key !== 'id') {
                    $model->{$key} = strtoupper($value);
                }
            }
        });

        static::creating(function ($model) {
            $model->id = strtolower(Uuid::uuid4()->toString()); // Guardar UUID en minúsculas
        });
    }

    protected static function booted()
    {
        static::addGlobalScope('region', function (Builder $builder) {
            if (auth()->check() && !auth()->user()->hasRole('Administrator')) {
                $userRegions = auth()->user()->regions->pluck('id')->toArray();
                $builder->whereIn('region_id', $userRegions);
            }
        });
    }
}
