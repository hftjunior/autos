<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class AitResourceStatus extends Model
{
    protected $fillable = ['status'];

    public function resources()
    {
        return $this->hasMany(AitResource::class);
    }
}
