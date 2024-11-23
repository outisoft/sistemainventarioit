<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Concerns\HasUuids;

class Phone extends Model
{
    use HasFactory, HasUuids;

    protected $fillable = ['extension', 'service', 'model', 'serial', 'remarks'];

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
