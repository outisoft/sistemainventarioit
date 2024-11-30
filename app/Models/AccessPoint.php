<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Builder;

class AccessPoint extends Model
{
    use HasFactory;

    protected $fillable = ['region_id', 'name', 'marca', 'model', 'serial', 'mac', 'ip', 'swittch_id', 'port_number'];

    public function swittch()
    {
        return $this->belongsTo(Swittch::class);
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
                $builder->where('region_id', auth()->user()->region_id);
            }
        });
    }
}
