<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Laravel\Jetstream\HasProfilePhoto;

class Space extends Model
{
    protected $guarded = [];
    use HasFactory,
        HasProfilePhoto;

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

    public function members()
    {
        return $this->belongsToMany(User::class)->using(SpaceUser::class)
            ->withPivot([
                'role_hash',
            ])->as('membership')->withTimestamps();
    }

    public function owner()
    {
        return $this->belongsTo(User::class, 'creator_id');
    }

    public function concepts()
    {
        return $this->hasMany(Concept::class, 'space_id');
    }
}
