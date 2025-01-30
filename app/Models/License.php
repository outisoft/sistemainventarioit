<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class License extends Model
{
    use HasFactory;

    protected $fillable = [
        'type_id','type', 'key', 'end_date', 'max', 'region_id'
    ];

    public function region()
    {
        return $this->belongsTo(Region::class, 'region_id');
    }

    // Relación muchos a muchos con Equipo
    public function equipo()
    {
        return $this->belongsToMany(Equipo::class, 'equipo_license');
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