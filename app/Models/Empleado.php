<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\Builder;
use Ramsey\Uuid\Uuid;

class Empleado extends Model
{
    use HasFactory;

    public $incrementing = false; // Indicar que no es autoincremental
    protected $keyType = 'string';

    protected $fillable = ['no_empleado', 'name', 'email', 'puesto', 'departamento_id', 'hotel_id', 'ad', 'region_id'];

    public function hotel()
    {
        return $this->belongsTo(Hotel::class, 'hotel_id');
    }
    public function departments()
    {
        return $this->belongsTo(Departamento::class, 'departamento_id');
    }

    public function phone()
    {
        return $this->belongsToMany(Phone::class);
    }

    public function equipos()
    {
        return $this->belongsToMany(Equipo::class, 'empleado_equipo', 'empleado_id', 'equipo_id');
    }

    public function equipment()
    {
        return $this->belongsToMany(Equipo::class, 'empleado_equipo');
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

        static::creating(function ($model) {
            $model->id = Uuid::uuid4()->toString();
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
// mantenimiento siankan - secretariamantenimientobpska