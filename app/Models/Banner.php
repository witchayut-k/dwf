<?php

namespace App\Models;

use App\Traits\HasDateRange;
use App\Traits\HasFeaturedImage;
use Carbon\Carbon;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Sqits\UserStamps\Concerns\HasUserStamps;
use Spatie\MediaLibrary\InteractsWithMedia;
use Spatie\MediaLibrary\HasMedia;

class Banner extends Model implements HasMedia
{
    use InteractsWithMedia, HasUserStamps, HasFeaturedImage, HasDateRange;

    protected $casts = [
        'published' => 'boolean',
        'begin_date' => 'date',
        'end_date' => 'date'
    ];

    protected $fillable = [
        'title',
        'url',
        'sequence',
        'published',
        'view_count',
        'click_count',
        'begin_date',
        'end_date'
    ];

    protected $appends = ['featured_image'];
    protected $hidden = ['media'];

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

    /**
     * Get the content that owns the Banner
     *
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function content(): BelongsTo
    {
        return $this->belongsTo(Content::class);
    }

    /*
    |--------------------------------------------------------------------------
    | MUTATOR
    |--------------------------------------------------------------------------
    */

    public function getPublishedContentAttribute()
    {
        if ($this->content) {
            if ($this->content->is_published)
                return $this->content;
        }

        return null;
    }

    /*
    |--------------------------------------------------------------------------
    | MEDIA
    |--------------------------------------------------------------------------
    */

    public function registerMediaCollections(): void
    {
        $this->addMediaCollection('featured_image')->singleFile();

        $this->addMediaConversion('featured_image_resized')
            ->width(574)
            ->height(310)
            ->performOnCollections('featured_image')
            ->nonQueued();
    }
}
