<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class State extends Model
{
    protected $fillable = ['initial','name'];

    public function cities()
    {
        return $this->hasMany(City::class);
    }

    public function vehicles()
    {
        return $this->hasMany(Vehicle::class);
    }
}
