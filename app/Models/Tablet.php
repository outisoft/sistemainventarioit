<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Tablet extends Model
{
    use HasFactory;

    protected $fillable = ['operarios', 'usuarios', 'password', 'app', 'numero_tablet', 'imei', 'serial', 'sim', 'numero_telefono', 'configurada', 'carta_firmada', 'observacion', 'giacode', 'personalsdscode', 'folio_baja'];
}
