<?php

namespace App\Traits;

trait HasFeaturedImage
{

    /*
    |--------------------------------------------------------------------------
    | MUTATORS
    |--------------------------------------------------------------------------
    */

    public function getFeaturedImageNameAttribute()
    {
        $media = $this->getFirstMedia('featured_image');
        if (!empty($media))
            return $media->name . "." . $media->extension;

        return '-';
    }

    public function getFeaturedImageSizeAttribute()
    {
        $media = $this->getFirstMedia('featured_image');
        if (!empty($media))
            return $media->human_readable_size;

        return '-';
    }

    public function getHasFeaturedImageAttribute()
    {
        $media = $this->getFirstMedia('featured_image');
        return !empty($media);
    }

    public function getFeaturedImageAttribute()
    {
        $media = $this->getFirstMedia('featured_image');
        if (!empty($media))
            return $media->getFullUrl();
        else
            return asset('img/img-placeholder.jpg');
    }

    public function getFeaturedImageResizedAttribute()
    {
        $media = $this->getFirstMedia('featured_image');
        if (!empty($media))
            return $media->getFullUrl('featured_image_resized');
        else
            return asset('img/img-placeholder.jpg');
    }

    public function getImageIdAttribute()
    {
        $media = $this->getFirstMedia('featured_image');
        if ($media)
            return $media->id;
        else
            return null;
    }
}
