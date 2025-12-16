<?php

namespace App\Models;

use App\Observers\TeamObserver;
use Illuminate\Database\Eloquent\Attributes\ObservedBy;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;
use Illuminate\Database\Eloquent\Relations\HasMany;

#[ObservedBy(TeamObserver::class)]
class Team extends Model
{
    public function members(): BelongsToMany
    {
        return $this->belongsToMany(User::class);
    }

    public function owners(): HasMany
    {
        return $this->hasMany(Owner::class);
    }

    public function patients(): HasMany
    {
        return $this->hasMany(Patient::class);
    }

    public function tools(): HasMany
    {
        return $this->hasMany(Tool::class);
    }
}
