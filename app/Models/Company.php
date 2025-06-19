<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Support\Str;

class Company extends Model
{
    use HasFactory;
    protected $keyType = 'string';
    public $incrementing = false;

    protected $fillable = [
        'name',
        'description',
        'region_id',
    ];

    public function region()
    {
        return $this->belongsTo(Region::class);
    }

    
    public function positions()
    {
        return $this->hasMany(Position::class, 'company_id', 'id');
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
            $fieldsToUpper = ['name'];
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
