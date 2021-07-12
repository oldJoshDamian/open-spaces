<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Laravel\Scout\Searchable;

class Concept extends Model
{
    use HasFactory,
        Searchable;

    protected $guarded = [];
    protected $withCount = ['topics'];

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
     * Get the value of the model's route key.
     *
     * @return mixed
     */
    public function getRouteKey()
    {
        return $this->slug;
    }


    /**
     * Get the indexable data array for the model.
     *
     * @return array
     */
    public function toSearchableArray()
    {
        return [
            'title' => $this->title
        ];
    }

    public function topics()
    {
        return $this->hasMany(Topic::class);
    }

    public function space()
    {
        return $this->belongsTo(Space::class);
    }

    public function allResources()
    {
        return Resource::with(['resourceful'])->where(function ($query) {
            return $query->whereIn('resourceable_id', $this->topics->pluck('id'))->where('resourceable_type', 'App\Models\Topic')->orWhere(function ($query) {
                return $query->where('resourceable_id', $this->id)->where('resourceable_type', 'App\Models\Concept');
            });
        });
    }

    public function resources()
    {
        return $this->morphMany(Resource::class, 'resourceable');
    }
}
