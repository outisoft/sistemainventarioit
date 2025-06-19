<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Builder;
use Ramsey\Uuid\Uuid; // Asegúrate de tener instalado ramsey/uuid
use Illuminate\Support\Str;

class Position extends Model
{
    use HasFactory;
    protected $keyType = 'string';
    public $incrementing = false;

    protected $fillable = ['email', 'position', 'department_id', 'hotel_id', 'ad', 'region_id', 'company_id'];

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
    
    public function company()
    {
        return $this->belongsTo(Company::class, 'company_id');
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

        static::creating(function ($model) {
            if (empty($model->{$model->getKeyName()})) { // Si el ID no está ya seteado
                $model->{$model->getKeyName()} = Str::uuid()->toString(); // Genera y asigna un UUID
            }
        });

        // Convertir a mayúsculas los campos deseados antes de guardar (excepto UUIDs)
        static::saving(function ($model) {
            // Lista de campos a convertir a mayúsculas (ajusta según tus necesidades)
            $fieldsToUpper = ['email', 'position', 'ad'];
            foreach ($fieldsToUpper as $field) {
                if (!is_null($model->{$field})) {
                    $model->{$field} = mb_strtoupper($model->{$field}, 'UTF-8');
                }
            }
            // No tocar 'id' ni 'position_id'
        });

        static::addGlobalScope('region', function (Builder $builder) {
            if (auth()->check() && !auth()->user()->hasRole('Administrator')) {
                $userRegions = auth()->user()->regions->pluck('id')->toArray();
                $builder->whereIn('region_id', $userRegions);
            }
        });
    }
}
