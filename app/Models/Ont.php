<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Builder;
use Ramsey\Uuid\Uuid;

class Ont extends Model
{
    use HasFactory;

    public $incrementing = false; // Indicar que no es autoincremental
    protected $keyType = 'string';

    protected $fillable = [
        'name',
        'brand',
        'model',
        'serial',
        'mac',
        'ip',
        'hotel_id',
        'villa_id',
        'room_id',
        'region_id',
    ];

    public function region()
    {
        return $this->belongsTo(Region::class, 'region_id');
    }

    public function hotel() 
    {
        return $this->belongsTo(Hotel::class, 'hotel_id');
    }
    
    public function villa() 
    {
        return $this->belongsTo(Villa::class);
    }
    
    public function room() 
    {
        return $this->belongsTo(Room::class);
    }

    protected static function boot()
    {
        parent::boot();

        static::saving(function ($model) {
            foreach ($model->getAttributes() as $key => $value) {
                // Excluir campos UUID y claves foráneas
                if (is_string($value) && !in_array($key, ['id', 'hotel_id', 'villa_id', 'room_id'])) {
                    $model->{$key} = strtoupper($value);
                }
            }
        });

        static::creating(function ($model) {
            $model->id = Uuid::uuid4()->toString(); // Generar UUID en minúsculas
        });
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
