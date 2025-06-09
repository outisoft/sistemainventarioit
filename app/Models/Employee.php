<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Str; // Importante para generar UUIDs
use Illuminate\Database\Eloquent\Builder;
use Ramsey\Uuid\Uuid; // Asegúrate de tener instalado ramsey/uuid

class Employee extends Model // O Position, etc.
{
    use HasFactory;

    /**
     * Indicates if the IDs are auto-incrementing.
     *
     * @var bool
     */
    public $incrementing = false; // Los UUIDs no son auto-incrementales

    /**
     * The "type" of the primary key ID.
     *
     * @var string
     */
    protected $keyType = 'string'; // El tipo de la clave es string (UUID)

    protected $fillable = [
        // No incluyas 'id' aquí, se manejará automáticamente o en el seeder
        'no_employee',
        'name',
        'position_id',
        'region_id',
    ];

    /**
     * Boot function from Laravel.
     */
    protected static function boot()
    {
        parent::boot();

        static::creating(function ($model) {
            if (empty($model->{$model->getKeyName()})) { // Si el ID no está ya seteado
                $model->{$model->getKeyName()} = Str::uuid()->toString(); // Genera y asigna un UUID
            }
        });

        // Convertir a mayúsculas los campos deseados antes de guardar (excepto UUIDs)
        static::saving(function ($model) {
            // Lista de campos a convertir a mayúsculas (ajusta según tus necesidades)
            $fieldsToUpper = ['no_employee', 'name'];
            foreach ($fieldsToUpper as $field) {
                if (!is_null($model->{$field})) {
                    $model->{$field} = mb_strtoupper($model->{$field}, 'UTF-8');
                }
            }
            // No tocar 'id' ni 'position_id'
        });

        static::addGlobalScope('region', function (Builder $builder) {
            if (auth()->check() && !auth()->user()->hasRole('Administrator')) {
                $userRegions = auth()->user()->regions->pluck('id')->toArray();
                $builder->whereIn('region_id', $userRegions);
            }
        });
    }

    // Relaciones
    public function position()
    {
        return $this->belongsTo(Position::class, 'position_id');
    }

    public function region()
    {
        return $this->belongsTo(Region::class, 'region_id'); // Asumiendo que tu modelo se llama Region
    }
}