<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\SoftDeletes;
use Sqits\UserStamps\Concerns\HasUserStamps;

class ContentType extends Model 
{
    use HasUserStamps, SoftDeletes;

    protected $casts = [
        'published' => 'boolean',
    ];

    protected $fillable = [
        'name',
        'published',
    ];

    public static function options()
    {
        return (new static)::pluck('name', 'id');
    }

    /*
    |--------------------------------------------------------------------------
    | SEARCHING
    |--------------------------------------------------------------------------
    */

    public static function searchFields()
    {
        return [
            'name',
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

    public function scopeOfFeatured($query)
    {
        return $query->where('is_featured', TRUE);
    }

    public function scopeOfAnnounce($query)
    {
        return $query->where('is_announcement', TRUE);
    }

    /*
    |--------------------------------------------------------------------------
    | RELATIONS
    |--------------------------------------------------------------------------
    */

    /**
     * Get all of the contents for the VideoCategory
     *
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function contents(): HasMany
    {
        return $this->hasMany(Content::class);
    }

    public function published_contents()
    {
        return $this->contents()->ofPublished()->orderByDesc('created_at');
    }

}
