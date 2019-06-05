<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Ait extends Model
{
    protected $fillable = [
        'agency_id',
        'client_id',
        'vehicle_id',
        'status_id',
        'type_id',
        'date',
        'time',
        'local',
        'state_id',
        'city_id',
        'date_included',
        'deadline',
        'number',
        'processing',
        'value',
        'points'
    ];

    public function agency()
    {
        return $this->belongsTo(Agency::class);
    }

    public function client()
    {
        return $this->belongsTo(Client::class);
    }

    public function vehicle()
    {
        return $this->belongsTo(Vehicle::class);
    }

    public function status()
    {
        return $this->belongsTo(AitStatus::class);
    }

    public function type()
    {
        return $this->belongsTo(AitType::class);
    }

    public function state()
    {
        return $this->belongsTo(State::class);
    }

    public function city()
    {
        return $this->belongsTo(City::class);
    }

    public function resources()
    {
        return $this->hasMany(AitResource::class);
    }
}
