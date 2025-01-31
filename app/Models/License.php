<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Carbon\Carbon;
use Ramsey\Uuid\Uuid;

class License extends Model
{
    use HasFactory;

    public $incrementing = false; // Indicar que no es autoincremental
    protected $keyType = 'string';

    protected $fillable = [
        'type_id','type', 'key', 'end_date', 'max', 'region_id'
    ];

    public function region()
    {
        return $this->belongsTo(Region::class, 'region_id');
    }

    // Relación muchos a muchos con Equipo
    public function equipo()
    {
        return $this->belongsToMany(Equipo::class, 'license_equipment');
    }

    public function getStatus()
    {
        // Si no hay fecha de expiración, la licencia es permanente (Activa)
        if (!$this->end_date) {
            return 'Active';
        }

        // Convertir la fecha de expiración a un objeto Carbon
        $endDate = Carbon::parse($this->end_date);
        $today = Carbon::today();

        // Verificar si la licencia está vencida
        if ($today->greaterThan($endDate)) {
            return 'Expired';
        }

        // Verificar si la licencia está a punto de vencer (30 días o menos)
        $daysUntilExpiration = $today->diffInDays($endDate);
        if ($daysUntilExpiration <= 30) {
            return 'Near expiration';
        }

        // Si no, la licencia está activa
        return 'Active';
    }

    protected static function boot() //guardar en mayusculas
    {
        parent::boot();

        static::saving(function ($model) {
            foreach ($model->getAttributes() as $key => $value) {
                if (is_string($value)) {
                    $model->{$key} = strtoupper($value);
                }
            }
        });

        static::creating(function ($model) {
            $model->id = Uuid::uuid4()->toString();
        });
    }
}