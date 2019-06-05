<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class AitStatus extends Model
{
    protected $fillable = ['status'];

    public function aits()
    {
        return $this->hasMany(Ait::class);
    }
}
