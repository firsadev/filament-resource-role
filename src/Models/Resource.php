<?php

namespace Firsadev\FilamentResourceRole\Models;

use Firsadev\FilamentResourceRole\Models\Role;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Concerns\HasUuids;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;

class Resource extends Model
{
    use HasUuids;

    public function roles() : BelongsToMany
    {
        return $this->belongsToMany(Role::class)->withPivot('viewAny','view','create','update','delete','restore','forceDelete');
    }
}
