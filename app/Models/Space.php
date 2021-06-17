<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Laravel\Jetstream\HasProfilePhoto;

class Space extends Model
{
    protected $guarded = [];
    use HasFactory, HasProfilePhoto;

    public function members()
    {
        return $this->belongsToMany(User::class, 'space_user', 'user_id', 'space_id')->using(SpaceUser::class)
            ->withPivot([
                'role_hash',
            ])->withTimestamps();
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
