<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Historial extends Model
{
    use HasFactory;

    protected $fillable = ['accion', 'descripcion', 'registro_id'];

    public function registro()
    {
        return $this->belongsTo(Inventario::class, 'registro_id');
    }

}
