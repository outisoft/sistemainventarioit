<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;
use Illuminate\Database\Eloquent\Builder;

class Complement extends Model
{
    use HasFactory;

    protected $fillable = ['type_id', 'brand', 'model', 'serial', 'region_id'];

    public function type()
    {
        return $this->belongsTo(Tipo::class, 'type_id');
    }

    public function equipments(): BelongsToMany
    {
        return $this->belongsToMany(Equipo::class, 'complement_equipo');
        //return $this->belongsToMany(Equipo::class)->withTimestamps();
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
