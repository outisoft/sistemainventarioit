<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Network extends Model
{
    use HasFactory;

    /**
     * Los atributos que se pueden asignar en masa.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'name',
        'vlan_id',
        'region_id',
    ];

    /**
     * Define la relación: Una red tiene muchos dispositivos.
     */
    /*public function devices(): HasMany
    {
        return $this->hasMany(Device::class);
    }*/
}
