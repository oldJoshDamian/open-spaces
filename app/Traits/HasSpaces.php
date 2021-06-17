<?php

namespace App\Traits;

use App\Models\Space;

trait HasSpaces
{
    public function spaces()
    {
        return $this->belongsToMany(Space::class, 'space_user', 'space_id', 'user_id')
            ->withTimestamps();
    }

    public function ownedSpaces()
    {
        return $this->hasMany(Space::class, 'creator_id');
    }

    public function spaceRole(Space $space): string|null
    {
        if (!$space) {
            return null;
        }
        $member = $space->members()->firstWhere('user_id', auth()->user()->id);
        if (password_verify('owner_' . auth()->user()->id, $member->role_hash) && $this->ownsSpace($space)) {
            return "admin";
        }
        if (password_verify('admin_' . auth()->user()->id, $member->role_hash)) {
            return "admin";
        }
        if (password_verify('member_' . auth()->user()->id, $member->role_hash)) {
            return "member";
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
