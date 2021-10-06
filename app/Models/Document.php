<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Storage;

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
    protected $appends = [
        'cover_page_url',
        'full_url'
    ];

    public function getCoverPageUrlAttribute()
    {
        return Storage::disk($this->resourseStorageDisk())->url($this->cover_page);
    }

    public function getFullUrlAttribute()
    {
        return Storage::disk($this->resourseStorageDisk())->url($this->url);
    }

    private function resourseStorageDisk()
    {
        return config('app.storage_disk');
    }

    public function resource()
    {
        return $this->morphOne(Resource::class, 'resourceful');
    }
}
