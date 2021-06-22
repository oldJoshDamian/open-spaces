<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Storage;
use Spatie\PdfToImage\Pdf;
use Illuminate\Support\Str;
use Laravel\Scout\Searchable;
use App\Traits\IsResource;

class Document extends Model
{
    use HasFactory,
    Searchable;

    protected $guarded = [];
    protected $with = ['resource'];

    protected $casts = [
        'specific_pages' => 'array',
    ];
    protected $attributes = [
        'specific_pages' => "[]"
    ];

    public function resource() {
        return $this->morphOne(Resource::class, 'resourceful');
    }

    public function toSearchableArray() {
        return [
            'title' => $this->title
        ];
    }
}