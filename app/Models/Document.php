<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Document extends Model
{
    use HasFactory;

    protected $guarded = [];
    protected $with = ['resource'];

    protected $casts = [
        'specific_pages' => 'array',
    ];
    protected $attributes = [
        'specific_pages' => "[]"
    ];

    public function resource()
    {
        return $this->morphOne(Resource::class, 'resourceful');
    }
}
