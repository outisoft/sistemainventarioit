<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Coming2 extends Model
{
    use HasFactory, SoftDeletes;

    protected $fillable = ['operario', 'puesto', 'email', 'usuario', 'password', 'numero_tableta', 'model', 'serial', 'numero_telefono', 'imei', 'sim', 'policy_id', 'configurada', 'carta_firmada', 'observacion', 'folio_baja', 'deleted_at', 'region_id'];

    public function policies()
    {
        return $this->belongsTo(Policy::class, 'policy_id');
    }

    public function region()
    {
        return $this->belongsTo(Region::class, 'region_id');
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
