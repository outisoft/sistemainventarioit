<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Database\Eloquent\Builder;

class Equipo extends Model
{
    use HasFactory, SoftDeletes;

    protected $fillable = ['tipo_id', 'marca', 'model', 'serial', 'name', 'ip', 'so', 'policy_id', 'email', 'key', 'nombre','orden', 'lease', 'lease_id', 'af_code', 'region_id'];

    public function empleados()
    {
        return $this->belongsToMany(Empleado::class, 'empleado_equipo', 'equipo_id', 'empleado_id');
    }

    public function employees()
    {
        return $this->belongsToMany(Employee::class, 'empleado_equipo');
    }

    /*public function positions()
    {
        return $this->belongsToMany(Position::class, 'equipment_position', 'position_id', 'equipo_id');
    }*/

    // app/Models/Equipment.php
    public function positions()
    {
        return $this->belongsToMany(Position::class, 'equipment_position')
                    ->using(EquipmentPosition::class)
                    ->withPivot(['id', 'created_at', 'updated_at']);
    }

    public function tipo()
    {
        return $this->belongsTo(Tipo::class, 'tipo_id');
    }

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function complements(): BelongsToMany
    {
        return $this->belongsToMany(Complement::class, 'complement_equipo');
        //return $this->belongsToMany(Complement::class)->withTimestamps();
    }

    public function policy()
    {
        return $this->belongsTo(Policy::class);
    }

    public function license()
    {
        return $this->belongsToMany(License::class, 'license_equipment');
    }

    public function leases()
    {
        return $this->belongsTo(Lease::class, 'lease_id');
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

    public function region()
    {
        return $this->belongsTo(Region::class, 'region_id');
    }

    // Scope global para filtrar por región automáticamente
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
