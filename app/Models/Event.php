<?php

namespace App\Models;

use Carbon\Carbon;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Sqits\UserStamps\Concerns\HasUserStamps;

class Event extends Model
{
    use HasFactory, HasUserStamps;

    protected $casts = [
        'published' => 'boolean',
        'begin_date' => 'date',
        'end_date' => 'date'
    ];

    protected $attributes = [
        'color' => '#c40157',
    ];

    protected $fillable = [
        'title',
        'content',
        'begin_date',
        'end_date',
        'view_count',
        'color',
        'published'
    ];

    /*
    |--------------------------------------------------------------------------
    | SEARCHING
    |--------------------------------------------------------------------------
    */

    public static function searchFields()
    {
        return [
            'title',
        ];
    }

    /*
    |--------------------------------------------------------------------------
    | SCOPES
    |--------------------------------------------------------------------------
    */

    public function scopeOfPublished($query)
    {
        return $query->where('published', TRUE);
    }

    public function scopeOfAvailable($query)
    {
        return $query->where('published', TRUE)->whereDate('end_date', '>=', Carbon::today());
    }

    /*
    |--------------------------------------------------------------------------
    | ACCESSTORS
    |--------------------------------------------------------------------------
    */

    public function getBeginDateThAttribute () {
        return $this->date ? $this->date->addYear(543)->translatedFormat('j M Y') : "";
    }

}
