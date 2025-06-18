<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class SpecificLocation extends Model
{
    protected $fillable = ['name', 'hotel_id'];
    
    public function hotel()
    {
        return $this->belongsTo(Hotel::class);
    }

    public function region()
    {
        return $this->belongsTo(Region::class);
    }
}