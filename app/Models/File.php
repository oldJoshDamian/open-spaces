<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Storage;

class File extends Model
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
        'poster_url',
        'full_url'
    ];

    public function getPosterUrlAttribute()
    {
        $resourceDisk = $this->stored_on;

        if ($resourceDisk === 'IPFS') {
            return config('ipfs.access_endpoint') . '/ipfs/' . $this->poster;
        }
        return Storage::disk($resourceDisk)->url($this->poster);
    }

    public function getFullUrlAttribute()
    {
        $resourceDisk = $this->stored_on;
        if ($resourceDisk === 'IPFS') {
            return config('ipfs.access_endpoint') . '/ipfs/' . $this->hash;
        }
        return Storage::disk($resourceDisk)->url($this->hash);
    }

    public function resource()
    {
        return $this->morphOne(Resource::class, 'resourceful');
    }
}
