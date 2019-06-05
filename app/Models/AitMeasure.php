<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class AitMeasure extends Model
{
    protected $fillable = ['measure'];

    public function types()
    {
        return $this->hasMany(AitType::class);
    }
}
