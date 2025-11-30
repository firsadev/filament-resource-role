<?php

namespace Firsadev\FilamentResourceRole\Models;

use App\Models\User;
use Firsadev\FilamentResourceRole\Models\Resource;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Concerns\HasUuids;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;

class Role extends Model
{
    use HasUuids;


    public function canAccesResources() : BelongsToMany {
        return $this->belongsToMany(Resource::class)->withPivot('viewAny','view','create','update','delete','restore','forceDelete');
    }

    public function users () : HasMany {
        return $this->hasMany(User::class);
    }
}

 

