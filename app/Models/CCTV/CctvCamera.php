<?php

namespace App\Models\CCTV;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\SpecificLocation;
use App\Models\Region;
use App\Models\CCTV\CctvSwitch;
use App\Models\CCTV\TypeCamera;

class CctvCamera extends Model
{
    use HasFactory;
    
    protected $fillable = [
        'name',
        'idf',
        'zona',
        'location_id',
        'brand',
        'model',
        'serial',
        'mac',
        'ip',
        'type_camera_id',
        'switch_id',
        'connected_port',
        'region_id'
    ];

    public function location()
    {
        return $this->belongsTo(SpecificLocation::class);
    }

    public function switch()
    {
        return $this->belongsTo(CctvSwitch::class);
    }

    public function type_camera()
    {
        return $this->belongsTo(TypeCamera::class);
    }

    public function region()
    {
        return $this->belongsTo(Region::class);
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
