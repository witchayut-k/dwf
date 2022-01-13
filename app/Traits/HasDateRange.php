<?php

namespace App\Traits;

use Carbon\Carbon;

trait HasDateRange
{

    /*
    |--------------------------------------------------------------------------
    | SCOPE
    |--------------------------------------------------------------------------
    */

    public function scopeOfPublished($query)
    {
        return $query->where('published', TRUE)
            ->where(function ($query) {
                $query
                    ->whereDate('begin_date', '<=', Carbon::today()->startOfDay())
                    ->orWhere('begin_date', null);
            })
            ->where(function ($query) {
                $query
                    ->whereDate('end_date', '>=', Carbon::today()->startOfDay())
                    ->orWhere('end_date', null);
            });
    }

    /*
    |--------------------------------------------------------------------------
    | MUTATOR
    |--------------------------------------------------------------------------
    */

    public function getIsPublishedAttribute()
    {
        return $this->published
            && ($this->begin_date == null || $this->begin_date <= Carbon::today()->startOfDay())
            && ($this->end_date == null || $this->end_date >= Carbon::today()->endOfDay());
    }
}
