<?php

namespace App\Models;

use App\Traits\HasFeaturedImage;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Spatie\MediaLibrary\HasMedia;
use Spatie\MediaLibrary\InteractsWithMedia;
use Sqits\UserStamps\Concerns\HasUserStamps;

class Video extends Model implements HasMedia
{
    use HasFactory, HasUserStamps, InteractsWithMedia, HasFeaturedImage;

    protected $casts = [
        'published' => 'boolean',
    ];

    protected $fillable = [
        'title',
        'video_category_id',
        'view_count',
        'video_url',
        'published'
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
            'videos.title',
            'video_categories.title'
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
     * Get the videoCategory that owns the Video
     *
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function videoCategory(): BelongsTo
    {
        return $this->belongsTo(VideoCategory::class);
    }

    public function registerMediaCollections(): void
    {
        $this->addMediaCollection('featured_image')->singleFile();
        $this->addMediaCollection('video')->singleFile();

        $this->addMediaConversion('featured_image_resized')
        ->width(600)
        ->height(300)
        ->performOnCollections('featured_image')
        ->nonQueued();
    }

    public function getDateThAttribute()
    {
        return $this->created_at ? $this->created_at->addYear(543)->translatedFormat('j M Y') : "";
    }


    /*
    |--------------------------------------------------------------------------
    | MEDIA
    |--------------------------------------------------------------------------
    */

    public function getVideoNameAttribute()
    {
        $media = $this->getFirstMedia('video');
        if (!empty($media))
            return $media->name . "." . $media->extension;

        return '-';
    }


    public function getVideoSizeAttribute()
    {
        $media = $this->getFirstMedia('video');
        if (!empty($media))
            return $media->human_readable_size;

        return '-';
    }

    public function getHasVideoAttribute()
    {
        $media = $this->getFirstMedia('video');
        return !empty($media);
    }

    public function getVideoAttribute()
    {
        $media = $this->getFirstMedia('video');
        if (!empty($media))
            return $media->getFullUrl();

        return null;
    }

    public function getYoutubeIdAttribute()
    {
        $videoID = "";
        if ($this->video_url) {
            if (\Str::contains($this->video_url, 'embed')) {
                $videoID = substr($this->video_url, -11);
            } else if (\Str::contains($this->video_url, 'youtube.com')) {
                $posID = strpos($this->video_url, "v=");
                $videoID = substr($this->video_url, ($posID + 2), 11);
            } else if (\Str::contains($this->video_url, 'youtu.be')) {
                $videoID = substr($this->video_url, -11);
            }  
            
        }

        return $videoID;
    }

    public function getVideoPreviewImageAttribute()
    {
        if ($this->video_url) {
            if (\Str::contains($this->video_url, 'embed')) {
                $videoID = substr($this->video_url, -11);
                return "https://img.youtube.com/vi/$videoID/0.jpg";
            } else if (\Str::contains($this->video_url, 'youtube.com')) {
                $posID = strpos($this->video_url, "v=");
                $videoID = substr($this->video_url, ($posID + 2), 11);
                return "https://img.youtube.com/vi/$videoID/0.jpg";
            } else if (\Str::contains($this->video_url, 'youtu.be')) {
                $videoID = substr($this->video_url, -11);
                return "https://img.youtube.com/vi/$videoID/0.jpg";
            }  
            
        }

        $media = $this->getFirstMedia('featured_image');
        if (!empty($media))
            return $media->getFullUrl();
        else
            return asset('img/img-placeholder.jpg');
    }

    public function getYoutubeEmbedAttribute () {
        if ($this->video_url) {
            if (\Str::contains($this->video_url, 'embed')) {
                return $this->video_url;
            } else if (\Str::contains($this->video_url, 'youtube.com')) {
                $posID = strpos($this->video_url, "v=");
                $videoID = substr($this->video_url, ($posID + 2), 11);
                return "https://www.youtube.com/embed/$videoID";
            } else if (\Str::contains($this->video_url, 'youtu.be')) {
                $videoID = substr($this->video_url, -11);
                return "https://www.youtube.com/embed/$videoID";
            } 
        }

        return "";
    }
}
