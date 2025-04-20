<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class DeviceLocation extends Model
{
    protected $fillable = [
        'locatable_id',
        'locatable_type',
        'villa_id',
        'room_id',
        'specific_location_id'
    ];
    
    public function locatable()
    {
        return $this->morphTo();
    }
    
    public function villa()
    {
        return $this->belongsTo(Villa::class);
    }
    
    public function room()
    {
        return $this->belongsTo(Room::class);
    }
    
    public function specificLocation()
    {
        return $this->belongsTo(SpecificLocation::class);
    }
}