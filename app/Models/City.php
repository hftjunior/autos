<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class City extends Model
{
    protected $fillable = ['state_id','initial','name'];

    public function state()
    {
        return $this->belongsTo(State::class);
    }

    public function vehicles()
    {
        return $this->hasMany(Vehicle::class);
    }
}
