<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class DocumentType extends Model
{
    protected $fillable = [
            'type', 'initial','entity_id'
        ];

    public function types()
    {
        return $this->hasMany(DocumentType::class);
    }   

    public function documents()
    {
        return $this->hasMany(Document::class);
    }
}
