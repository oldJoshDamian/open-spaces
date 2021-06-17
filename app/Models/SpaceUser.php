<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Relations\Pivot;

class SpaceUser extends Pivot
{
    protected $guarded = [];
    /**
     * Indicates if the IDs are auto-incrementing.
     *
     * @var bool
     */
    public $incrementing = true;
}
