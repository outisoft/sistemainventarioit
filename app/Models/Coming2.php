<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Coming2 extends Model
{
    use HasFactory;

    protected $fillable = ['operario', 'puesto', 'email', 'usuario', 'password', 'numero_tableta', 'serial', 'numero_telefono', 'imei', 'sim', 'policy_id', 'configurada', 'carta_firmada', 'observacion', 'folio_baja'];

    public function policies()
    {
        return $this->belongsTo(Policy::class, 'policy_id');
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
