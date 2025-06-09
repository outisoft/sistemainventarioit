<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\Pivot;
use Illuminate\Database\Eloquent\Concerns\HasUuids;

class EquipmentPosition extends Pivot
{
    use HasUuids;

    public $incrementing = false;
    protected $keyType = 'string';
    
    protected $table = 'equipment_position';
    
    protected $fillable = [
        'equipo_id',
        'position_id',
    ];
}