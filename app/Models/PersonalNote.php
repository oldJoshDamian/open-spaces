<?php

namespace App\Models;

use App\Traits\IsResource;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Laravel\Scout\Searchable;

class PersonalNote extends Model
{
    protected $guarded = [];

    use HasFactory,
    Searchable;

    public function resource() {
        return $this->morphOne(Resource::class, 'resourceful');
    }

    public function toSearchableArray() {
        return [
            'title' => $this->title
        ];
    }
}