<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Card extends Model
{
    use HasFactory;

    public static function scopeOrderById(Builder $query): Builder
    {
        return $query->orderBy('id', 'DESC');
    }

    public function scopeFilter(Builder $query, array $filters): Builder
    {
        $query->when($filters['date'], function ($query, $date) {
            $query->where(function ($query) use ($date) {
                $query->whereDate('created_at', '=', date('Y-m-d', strtotime($date)));
            });
        });

        return $query->where('status', (int) $filters['status']);
    }
}
