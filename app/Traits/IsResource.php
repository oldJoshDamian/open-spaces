<?php

namespace App\Traits;

trait IsResource
{
    public function shouldBeSearchable()
    {
        return $this->resource->resourceable->shouldBeSearchable();
    }

    public function resource()
    {
        return $this->morphOne(Resource::class, 'resourceful');
    }

    public function toSearchableArray()
    {
        return [
            'title' => $this->title
        ];
    }
}
