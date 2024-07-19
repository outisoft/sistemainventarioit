<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Pc extends Model
{
    use HasFactory;

    protected $fillable = ['tipo', 'marca', 'modelo', 'numero_serie', 'empleado_id'];

    public function empleado()
    {
        return $this->belongsTo(Empleado::class);
    }
}