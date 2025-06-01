<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Concerns\HasUuids;

class Phone extends Model
{
    use HasFactory, HasUuids;

    protected $fillable = ['extension', 'service', 'model', 'serial', 'region_id'];

    public function room(): BelongsTo
    {
        return $this->belongsTo(Room::class);
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
                if (is_string($value) && $key !== 'room_id') {
                    $model->{$key} = strtoupper($value);
                }
            }
        });
    }
}
