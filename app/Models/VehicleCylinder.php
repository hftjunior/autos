<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class VehicleCylinder extends Model
{
    protected $fillable = ['cylinder','unity'];

    public function vehicles()
    {
        return $this->hasMany(Vehicle::class);
    }
}
