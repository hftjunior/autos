<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use App\Models\State;
use App\Models\City;

class Client extends Model
{
    protected $fillable = [
        'name',
        'dtbirth',
        'cpf',
        'identity',
        'cnh',
        'dtcnh',
        'dtcnhdue',
        'type_street',
        'street',
        'number',
        'complement',
        'neighborhood',
        'city_id',
        'state_id',
        'cep',
        'tel_home',
        'tel_work',
        'cell',
        'email',
        'note'
    ];

    public function state()
    {
        return $this->belongsTo(State::class);
    }
    
    public function city()
    {
        return $this->belongsTo(City::class);
    }

    public function vehicles()
    {
        return $this->hasMany(Vehicle::class);
    }
}
