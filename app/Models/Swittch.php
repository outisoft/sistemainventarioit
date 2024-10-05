<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Swittch extends Model
{
    use HasFactory;

    protected $fillable = ['name', 'marca', 'model', 'serial', 'mac', 'ip', 'total_ports', 'hotel_id'];

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
