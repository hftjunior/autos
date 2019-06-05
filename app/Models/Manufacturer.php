<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Manufacturer extends Model
{
    protected $fillable = ['manufacturer'];

    public function models()
    {
        return $this->hasMany(VehicleModel::class);
    }

    public function vehicles()
    {
        return $this->hasMany(Vehicle::class);
    }
}
