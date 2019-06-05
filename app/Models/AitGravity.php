<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class AitGravity extends Model
{
    protected $fillable = ['gravity'];

    public function types()
    {
        return $this->hasMany(AitType::class);
    }
}
