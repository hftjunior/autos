<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class VehicleSpecies extends Model
{
    protected $fillable = ['specie'];

    public function vehicles()
    {
        return $this->hasMany(Vehicle::class);
    }
}
