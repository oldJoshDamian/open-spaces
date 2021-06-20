<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Topic extends Model
{
    protected $guarded = [];
    use HasFactory;

    /**
    * Get the value of the model's route key.
    *
    * @return mixed
    */
    public function getRouteKey() {
        return $this->slug;
    }

    public function concept() {
        return $this->belongsTo(Concept::class, 'concept_id');
    }

    public function resources() {
        return $this->morphMany(Resource::class, 'resourceable');
    }
}