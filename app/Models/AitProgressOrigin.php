<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class AitProgressOrigin extends Model
{
    protected $fillable = ['origin'];

    public function progresses()
    {
        return $this->hasMany(AitResourceProgress::class);
    }
}
