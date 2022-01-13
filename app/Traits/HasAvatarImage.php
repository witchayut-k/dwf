<?php

namespace App\Traits;

trait HasAvatarImage
{

    /*
    |--------------------------------------------------------------------------
    | MUTATORS
    |--------------------------------------------------------------------------
    */

    public function getAvatarImageNameAttribute()
    {
        $media = $this->getFirstMedia('avatar_image');
        if (!empty($media))
            return $media->name.".".$media->extension;

        return '-';
    }

    public function getAvatarImageSizeAttribute()
    {
        $media = $this->getFirstMedia('avatar_image');
        if (!empty($media))
            return $media->human_readable_size;

        return '-';
    }

    public function getHasAvatarImageAttribute()
    {
        $media = $this->getFirstMedia('avatar_image');
        return !empty($media);
    }

    public function getAvatarImageAttribute()
    {
        $media = $this->getFirstMedia('avatar_image');
        if (!empty($media))
            return $media->getFullUrl();
        else
            return asset('backend/img/user/no-image.png');
    }

    public function getAvatarImageResizedAttribute()
    {
        $media = $this->getFirstMedia('avatar_image');
        if (!empty($media))
            return $media->getFullUrl('avatar_image_resized');
        else
            return asset('backend/img/user/no-image.png');
    }
}
