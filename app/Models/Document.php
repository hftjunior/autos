<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Document extends Model
{
    protected $fillable = [
        'entity_id',
        'identify',
        'type_id',
        'document',
        'dtdocument',
        'expiration'        
    ];

    public function entity()
    {
        return $this->belongsTo(DocumentEntity::class);
    }
    
    public function type()
    {
        return $this->belongsTo(DocumentType::class);
    }    
}
