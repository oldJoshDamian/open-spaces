<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Resource extends Model
{
    protected $guarded = [];
    use HasFactory;

    public function resourceable()
    {
        return $this->morphTo();
    }

    public function resourceful()
    {
        return $this->morphTo();
    }
}
