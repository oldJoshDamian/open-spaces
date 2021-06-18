<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Topic extends Model
{
    protected $guarded = [];
    use HasFactory;

    public function concept() {
        return $this->belongsTo(Concept::class, 'concept_id');
    }

    public function resources() {
        return $this->morphMany(Resource::class, 'resourceable');
    }
}