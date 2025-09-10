<?php

namespace App\Models\CCTV;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\SpecificLocation;
use App\Models\Region;
use Illuminate\Database\Eloquent\Builder;

class CctvSwitch extends Model
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
        'password',
        'tipo',
        'connected_to_id',
        'connected_port',
        'from_provider',
        'region_id'
    ];

    public function location()
    {
        return $this->belongsTo(SpecificLocation::class);
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
