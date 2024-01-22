<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Column extends Model
{
    use HasFactory;

    public static function scopeActiveColumns(Builder $query): Builder
    {
        return $query->where('status', 1);
    }

    public function cards(): HasMany
    {
        return $this->hasMany(Card::class);
    }
}
