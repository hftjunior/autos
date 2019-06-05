<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class DocumentEntity extends Model
{
    protected $fillable = [
            'entity', 'table', 'identifier', 'name'
        ];

        public function documents()
    {
        return $this->hasMany(Document::class);
    }
}
