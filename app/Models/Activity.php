<?php
namespace App\Models;

use Spatie\Activitylog\Models\Activity as BaseActivity;

class Activity extends BaseActivity
{
    // Tambahkan scope untuk filter
    public function scopeByUser($query, $userId)
    {
        return $query->where('causer_id', $userId);
    }

    public function scopeByDateRange($query, $start, $end)
    {
        return $query->whereBetween('created_at', [$start, $end]);
    }
}