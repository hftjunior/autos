<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class AitResource extends Model
{
    protected $fillable = [
        'ait_id',
        'agency_id',
        'instance',
        'process',
        'protocol',
        'date_resource',
        'date_judgment',
        'status_id',
        'result'
    ];

    public function ait()
    {
        return $this->belongsTo(Ait::class);
    }

    public function agency()
    {
        return $this->belongsTo(Agency::class);
    }

    public function status()
    {
        return $this->belongsTo(AitResourceStatus::class);
    }

    public function progresses()
    {
        return $this->hasMany(AitResourceProgress::class, 'resource_id');
    }
}
