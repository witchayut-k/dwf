<?php

namespace App\Models;

use App\Traits\HasFeaturedImage;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Spatie\MediaLibrary\HasMedia;
use Spatie\MediaLibrary\InteractsWithMedia;
use Sqits\UserStamps\Concerns\HasUserStamps;

class Album extends Model implements HasMedia
{
    use InteractsWithMedia, HasUserStamps, HasFeaturedImage;

    protected $casts = [
        'published' => 'boolean',
    ];

    protected $fillable = [
        'title',
        'description',
        'view_count',
        'published'
    ];

    protected $appends = ['featured_image', 'gallery_images'];
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

    public function scopeOfPublished($query)
    {
        return $query->where('published', TRUE);
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
            ->width(600)
            ->height(300)
            ->performOnCollections('featured_image')
            ->nonQueued();
        
        $this->addMediaCollection('gallery_images');

        $this->addMediaConversion('gallery_images_resized')
            ->width(600)
            ->height(300)
            ->performOnCollections('gallery_images')
            ->nonQueued();
    }


    public function getHasGalleryImagesAttribute()
    {
        $media = $this->getFirstMedia('gallery_images');
        return !empty($media);
    }

    public function getGalleryImagesAttribute()
    {
        $medias = $this->getMedia('gallery_images');
        return $medias;
    }
}
