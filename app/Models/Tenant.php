<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Tenant extends Model
{
    protected $guarded = [];

    // Relasi: Tenant milik 1 Kantin
    public function canteen(): BelongsTo
    {
        return $this->belongsTo(Canteen::class);
    }

    // Relasi: Tenant punya banyak Menu
    public function menus(): HasMany
    {
        return $this->hasMany(Menu::class);
    }
}
