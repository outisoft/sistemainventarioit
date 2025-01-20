<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Builder;

class Historial extends Model
{
    use HasFactory;

    protected $table = 'historials';

    protected $fillable = ['clave', 'accion', 'descripcion', 'user_id', 'region_id'];

    public function user()
    {
        return $this->belongsTo(User::class, 'user_id');
    }

    public static function boot()
    {
        parent::boot();

        static::creating(function ($model) {
            $model->clave = 'GPINV-' . str_pad($model->getNextId(), 5, '0', STR_PAD_LEFT);
        });
    }

    /**
     * Obtiene el siguiente ID autoincremental personalizado
     *
     * @return int
     */
    private function getNextId()
    {
        $lastRecord = self::orderBy('clave', 'desc')->first();
        if ($lastRecord) {
            $parts = explode('-', $lastRecord->clave);
            return intval($parts[1]) + 1;
        }
        return 1;
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
