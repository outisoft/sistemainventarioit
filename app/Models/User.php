<?php

namespace App\Models;

// use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Notifications\Notifiable;
use Laravel\Sanctum\HasApiTokens;
use Spatie\Permission\Traits\HasRoles;
use Laravolt\Avatar\Facade as Avatar;

class User extends Authenticatable
{
    use HasApiTokens, HasFactory, Notifiable, HasRoles;

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'image',
        'name',
        'email',
        'is_active',
        'password',
        'first_login',
        'force_password_change',
    ];

    /**
     * The attributes that should be hidden for serialization.
     *
     * @var array<int, string>
     */
    protected $hidden = [
        'password',
        'remember_token',
    ];

    /**
     * The attributes that should be cast.
     *
     * @var array<string, string>
     */
    protected $casts = [
        'email_verified_at' => 'datetime',
        'password' => 'hashed',
    ];

    public function schedules(): HasMany
    {
        return $this->hasMany(Schedule::class, 'employee_id');
    }

    public function equipments()
    {
        return $this->hasMany(Equipo::class);
    }

    public function maintenances()
    {
        return $this->hasMany(Maintenance::class);
    }

    public function regions()
    {
        return $this->belongsToMany(Region::class, 'region_user', 'user_id', 'region_id');
    }

    public function getAvatarAttribute()
    {
        if ($this->attributes['image']) {
            return asset('storage/avatars/' . $this->attributes['image']);
        } else {
            $name = $this->name ?: 'NN'; // 'NN' para usuarios sin nombre
            return Avatar::create($name)->toBase64();
        }
    }
}
