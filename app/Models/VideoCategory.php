<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Sqits\UserStamps\Concerns\HasUserStamps;

class VideoCategory extends Model
{
    use HasFactory, HasUserStamps;

    protected $casts = [
        'published' => 'boolean',
    ];

    protected $fillable = [
        'title',
        'published',
    ];

    public static function options()
    {
        return (new static)::pluck('title', 'id');
    }

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

    /*
    |--------------------------------------------------------------------------
    | RELATIONS
    |--------------------------------------------------------------------------
    */

    /**
     * Get all of the videos for the VideoCategory
     *
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function videos(): HasMany
    {
        return $this->hasMany(Video::class);
    }

    public function published_videos(): HasMany
    {
        return $this->videos()->ofPublished()->orderByDesc('created_at');
    }
    
}
