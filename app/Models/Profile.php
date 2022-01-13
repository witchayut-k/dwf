<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Spatie\MediaLibrary\HasMedia;
use Spatie\MediaLibrary\InteractsWithMedia;

class Profile extends Model implements HasMedia
{
    use InteractsWithMedia;

    protected $touches = ['user'];

    protected $fillable = [
        'user_id',
        'title',
        'content'
    ];

    /**
     * Get the user that owns the Profile
     *
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function user(): BelongsTo
    {
        return $this->belongsTo(User::class);
    }

    /*
    |--------------------------------------------------------------------------
    | MEDIA
    |--------------------------------------------------------------------------
    */

    public function registerMediaCollections(): void
    {
        $this->addMediaCollection('file')->singleFile();
    }


    /*
    |--------------------------------------------------------------------------
    | MUTATORS
    |--------------------------------------------------------------------------
    */

    public function getFileNameAttribute()
    {
        $media = $this->getFirstMedia('file');
        if (!empty($media))
            return $media->name . "." . $media->extension;

        return '-';
    }

    public function getFileSizeAttribute()
    {
        $media = $this->getFirstMedia('file');
        if (!empty($media))
            return $media->human_readable_size;

        return '-';
    }

    public function getHasFileAttribute()
    {
        $media = $this->getFirstMedia('file');
        return !empty($media);
    }

    public function getFileAttribute()
    {
        $media = $this->getFirstMedia('file');
        if (!empty($media))
            return $media->getFullUrl();
        else
            return null;
    }
}
