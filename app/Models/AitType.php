<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class AitType extends Model
{
    protected $fillable = [
        'code',
        'description',
        'legal',
        'points',
        'value',
        'gravity_id',
        'measure_id'
    ];

    public function aits()
    {
        return $this->hasMany(Ait::class);
    }

    public function gravity()
    {
        return $this->belongsTo(AitGravity::class);
    }

    public function measures()
    {
        return $this->belongsTo(AitMeasure::class);
    }
}
