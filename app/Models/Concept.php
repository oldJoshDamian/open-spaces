<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Concept extends Model
{
    use HasFactory;

    protected $guarded = [];

    public function topics() {
        return $this->hasMany(Topic::class);
    }

    public function resources() {
        return $this->morphMany(Resource::class, 'resourceable');
    }
}