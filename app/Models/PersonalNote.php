<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class PersonalNote extends Model
{
    protected $guarded = [];

    use HasFactory;

    public function resource()
    {
        return $this->morphOne(Resource::class, 'resourceful');
    }
}
