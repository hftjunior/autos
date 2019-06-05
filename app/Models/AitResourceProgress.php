<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class AitResourceProgress extends Model
{
    protected $fillable = [
        'resource_id',
        'date',
        'time',
        'origin_id',
        'means_id',
        'progress'
    ];

    public function resource()
    {
        return $this->belongsTo(AitResource::class);
    }

    public function origin()
    {
        return $this->belongsTo(AitProgressOrigin::class);
    }

    public function device()
    {
        return $this->belongsTo(AitProgressMeans::class);
    }
}
