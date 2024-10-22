<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Policy extends Model
{
    use HasFactory;

    protected $fillable = ['name'];

    public function coming2()
    {
        return $this->hasMany(Coming2::class, 'policy_id');
    }
}
