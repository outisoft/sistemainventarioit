<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Builder;

class SpecificLocation extends Model
{
    protected $fillable = ['name', 'hotel_id', 'region_id'];
    
    public function hotel()
    {
        return $this->belongsTo(Hotel::class);
    }

    public function region()
    {
        return $this->belongsTo(Region::class);
    }

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