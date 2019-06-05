<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Fuel extends Model
{
    protected $fillable = ['fuel'];

    public function vehicles()
    {
        return $this->hasMany(Vehicle::class);
    }
}
