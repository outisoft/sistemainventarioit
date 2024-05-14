<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Policy extends Model
{
    use HasFactory;

    protected $fillable = ['name'];

    public function tablets()
    {
        return $this->hasMany(Tablet::class, 'policy_id');
    }
}
