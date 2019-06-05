<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Agency extends Model
{
    protected $fillable = ['agency'];

    public function aits()
    {
        return $this->hasMany(Ait::class);
    }
}
