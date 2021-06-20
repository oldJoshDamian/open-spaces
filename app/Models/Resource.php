<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Resource extends Model
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

    public function resourceable() {
        return $this->morphTo();
    }

    public function resourceful() {
        return $this->morphTo();
    }

    public function creator() {
        return $this->belongsTo(User::class, 'creator_id');
    }
}