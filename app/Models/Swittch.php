<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Builder;

class Swittch extends Model
{
    use HasFactory;

    protected $fillable = ['region_id', 'name', 'marca', 'model', 'serial', 'mac', 'ip', 'total_ports', 'hotel_id', 'observacion', 'usage_type'];

    public function hotel()
    {
        return $this->belongsTo(Hotel::class);
    }

    public function accessPoints()
    {
        return $this->hasMany(AccessPoint::class);
    }

    public function getMacAddressAttribute($value)
    {
        return strtoupper($value);
    }

    public function breack()
    {
        return $this->belongsToMany(Complement::class, 'breack_switch', 'switch_id', 'complement_id');
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
