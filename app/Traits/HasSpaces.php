<?php

namespace App\Traits;

use App\Models\Space;
use App\Models\SpaceUser;

trait HasSpaces
{
    public function spaces()
    {
        return $this->belongsToMany(Space::class)->using(SpaceUser::class)
            ->withPivot([
                'role_hash',
            ])->as('membership')->withTimestamps();
    }

    public function ownedSpaces()
    {
        return $this->hasMany(Space::class, 'creator_id');
    }

    public function spaceRole(Space $space): mixed
    {
        if (!$space) {
            return null;
        }
        $member = $space->members()->firstWhere('user_id', auth()->user()->id);
        if ($member) {
            if (password_verify('owner_' . auth()->user()->id, $member->membership->role_hash) && $this->ownsSpace($space)) {
                return "owner";
            }
            if (password_verify('admin_' . auth()->user()->id, $member->membership->role_hash)) {
                return "admin";
            }
            if (password_verify('member_' . auth()->user()->id, $member->membership->role_hash)) {
                return "member";
            }
        }
        return null;
    }

    public function ownsSpace(Space $space)
    {
        return $this->id === $space->creator_id;
    }

    public function allSpaces()
    {
        return $this->ownedSpaces->merge($this->spaces)->sortBy('updated_at');
    }
}
