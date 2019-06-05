<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class AitProgressMeans extends Model
{
    protected $fillable = ['device'];

    public function progresses()
    {
        return $this->hasMany(AitResourceProgress::class);
    }
}
