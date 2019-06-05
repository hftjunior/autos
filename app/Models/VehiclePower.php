<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class VehiclePower extends Model
{
    protected $fillable = ['power','unity'];

    public function vehicles()
    {
        return $this->hasMany(Vehicle::class);
    }
}
