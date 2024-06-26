<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Tpv extends Model
{
    use HasFactory;

    protected $fillable = ['area', 'departamento_id','hotel_id', 'equipment','brand', 'model', 'no_serial', 'name', 'ip', 'link'];

    public function hotel()
    {
        return $this->belongsTo(Hotel::class, 'hotel_id');
    }

    public function departamento()
    {
        return $this->belongsTo(Departamento::class, 'departamento_id');
    }
}
