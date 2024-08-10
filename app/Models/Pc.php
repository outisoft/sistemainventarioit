<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Pc extends Model
{
    use HasFactory;

    protected $fillable = ['type', 'marca', 'model', 'serial', 'name', 'ip', 'empleado_id'];

    public function empleado()
    {
        return $this->belongsTo(Empleado::class);
    }
}