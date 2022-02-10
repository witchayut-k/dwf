<?php

namespace App\Models;

use App\Traits\HasDateRange;
use App\Traits\HasFeaturedImage;
use Carbon\Carbon;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Spatie\MediaLibrary\HasMedia;
use Spatie\MediaLibrary\InteractsWithMedia;
use Sqits\UserStamps\Concerns\HasUserStamps;

class LandingPage extends Model implements HasMedia
{
    use HasFactory, HasUserStamps, InteractsWithMedia, HasFeaturedImage, HasDateRange;

    protected $casts = [
        'published' => 'boolean',
        'begin_date' => 'date',
        'end_date' => 'date',
        'buttons' => 'array'
    ];

    protected $fillable = [
        'title',
        'begin_date',
        'end_date',
        'published',
        'is_popup',
        'is_page',
        'buttons',
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
    public function scopeOfFullPage($query)
    {
        return $query->where('is_page', TRUE);
    }

    public function scopeOfPopup($query)
    {
        return $query->where('is_popup', TRUE);
    }
    /*
    |--------------------------------------------------------------------------
    | MUTATOR
    |--------------------------------------------------------------------------
    */

    /*
    |--------------------------------------------------------------------------
    | MEDIA
    |--------------------------------------------------------------------------
    */

    public function registerMediaCollections(): void
    {
        $this->addMediaCollection('featured_image')->singleFile();

        $this->addMediaConversion('featured_image_resized')
            // ->width(574)
            // ->height(310)
            ->performOnCollections('featured_image')
            ->nonQueued();
    }
}
