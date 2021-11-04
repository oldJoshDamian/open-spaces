<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Collection extends Model
{
    use HasFactory;

    public function parent()
    {
        return $this->morphTo();
    }

    public function resources()
    {
        return $this->morphMany(Resource::class, 'resourceable');
    }
}
