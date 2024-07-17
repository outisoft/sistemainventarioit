<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class License extends Model
{
    use HasFactory;

    protected $fillable = ['email', 'password', 'total_licenses', 'applied_licenses'];

    public function getRemainingLicensesAttribute()
    {
        return $this->total_licenses - $this->applied_licenses;
    }

    public function getStatusAttribute()
    {
        if ($this->applied_licenses == 0) {
            return 'Sin aplicar';
        } elseif ($this->applied_licenses == $this->total_licenses) {
            return 'Todas utilizadas';
        } else {
            return 'Parcialmente aplicadas';
        }
    }
}