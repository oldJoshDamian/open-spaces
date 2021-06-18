<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Storage;
use Spatie\PdfToImage\Pdf;
use Illuminate\Support\Str;

class Document extends Model
{
    protected $guarded = [];
    use HasFactory;

    public function resource()
    {
        return $this->morphOne(Resource::class, 'resourceful');
    }
}
