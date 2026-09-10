<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class Menu extends Model
{
    protected $guarded = [];

    protected function casts(): array
    {
        return [
            'is_available' => 'boolean',
            'price_amount' => 'integer',
        ];
    }

    // Relasi: Menu milik 1 Tenant
    public function tenant(): BelongsTo
    {
        return $this->belongsTo(Tenant::class);
    }
}
