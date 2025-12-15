<?php

namespace App\Models;

use Filament\Facades\Filament;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class Owner extends Model
{
    public function patients(): HasMany
    {
        return $this->hasMany(Patient::class);
    }

    public function team(): BelongsTo
    {
        return $this->belongsTo(Team::class);
    }

    protected static function booted(): void
    {
        $tenant = Filament::getTenant();
        static::addGlobalScope('team', function (Builder $query) use ($tenant) {
            $query->where('team_id', $tenant->id);

        });
    }
}
