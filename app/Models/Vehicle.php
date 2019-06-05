<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Vehicle extends Model
{
    protected $fillable = [
        'renavam',
        'client_id',
        'placa',
        'state_id',
        'city_id',
        'chassi',
        'specie_id',
        'type_id',
        'manufacturer_id',
        'model_id',
        'yearmanufacture',
        'yearmodel',
        'capacity',
        'power',
        'cylinder',
        'category_id',
        'fuel_id',
        'note'
    ];

    public function client()
    {
        return $this->belongsTo(Client::class);
    }

    public function state()
    {
        return $this->belongsTo(State::class);
    }

    public function city()
    {
        return $this->belongsTo(City::class);
    }

    public function species()
    {
        return $this->belongsTo(VehicleSpecies::class);
    }

    public function type()
    {
        return $this->belongsTo(VehicleType::class);
    }

    public function manufacturer()
    {
        return $this->belongsTo(Manufacturer::class);
    }

    public function model()
    {
        return $this->belongsTo(VehicleModel::class);
    }

    public function category()
    {
        return $this->belongsTo(VehicleCategory::class);
    }

    public function fuel()
    {
        return $this->belongsTo(VehicleFuel::class);
    }
}
