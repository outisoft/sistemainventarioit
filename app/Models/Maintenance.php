<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Maintenance extends Model
{
    use HasFactory;

    protected $fillable = [
        'equipment_id',
        'user_id',
        'maintenance_type',
        'date',
        'description',
        'parts_used',
        'status'
    ];

    protected $casts = [
        'parts_used' => 'array'
    ];

    public function equipment()
    {
        return $this->belongsTo(Equipo::class);
    }

    public function user()
    {
        return $this->belongsTo(User::class);
    }
}
