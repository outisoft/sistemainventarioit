<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Historial extends Model
{
    use HasFactory;

    protected $table = 'historials';

    protected $fillable = ['clave', 'accion', 'descripcion', 'user_id'];

    public function user()
    {
        return $this->belongsTo(User::class, 'user_id');
    }

    public static function boot()
    {
        parent::boot();

        static::creating(function ($model) {
            $model->clave = 'GPINV-' . str_pad($model->getNextId(), 5, '0', STR_PAD_LEFT);
        });
    }

    /**
     * Obtiene el siguiente ID autoincremental personalizado
     *
     * @return int
     */
    private function getNextId()
    {
        $lastRecord = self::orderBy('clave', 'desc')->first();
        if ($lastRecord) {
            $parts = explode('-', $lastRecord->clave);
            return intval($parts[1]) + 1;
        }
        return 1;
    }
}
