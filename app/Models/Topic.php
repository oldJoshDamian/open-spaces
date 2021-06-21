<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Laravel\Scout\Searchable;

class Topic extends Model
{
    protected $guarded = [];
    use HasFactory, Searchable;

    /**
     * Get the route key for the model.
     *
     * @return string
     */
    public function getRouteKeyName()
    {
        return 'slug';
    }

    /**
     * Get the indexable data array for the model.
     *
     * @return array
     */
    public function toSearchableArray()
    {
        return [
            'name' => $this->name
        ];
    }

    public function shouldBeSearchable()
    {
        return $this->concept->shouldBeSearchable();
    }

    /**
     * Get the value of the model's route key.
     *
     * @return mixed
     */
    public function getRouteKey()
    {
        return $this->slug;
    }

    public function concept()
    {
        return $this->belongsTo(Concept::class, 'concept_id');
    }

    public function resources()
    {
        return $this->morphMany(Resource::class, 'resourceable');
    }
}