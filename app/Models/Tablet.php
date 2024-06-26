<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Tablet extends Model
{
    use HasFactory;

    protected $fillable = ['operario', 'puesto', 'email', 'usuario', 'password', 'numero_tableta', 'serial', 'numero_telefono', 'imei', 'sim', 'policy_id', 'configurada', 'carta_firmada', 'observacion', 'giacode', 'personalsdscode', 'folio_baja'];

    public function policies()
    {
        return $this->belongsTo(Policy::class, 'policy_id');
    }
}
