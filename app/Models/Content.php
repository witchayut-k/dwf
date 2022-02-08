<?php

namespace App\Models;

use App\Enums\ContentTemplateEnum;
use App\Traits\HasDateRange;
use App\Traits\HasFeaturedImage;
use Carbon\Carbon;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\SoftDeletes;
use Spatie\MediaLibrary\HasMedia;
use Spatie\MediaLibrary\InteractsWithMedia;
use Sqits\UserStamps\Concerns\HasUserStamps;

class Content extends Model implements HasMedia
{
    use InteractsWithMedia, HasUserStamps, HasFeaturedImage, SoftDeletes, HasDateRange;

    protected $attributes = [
        'template_id' => ContentTemplateEnum::RIGHT_COLUMN,
    ];

    protected $casts = [
        'pinned' => 'boolean',
        'published' => 'boolean',
        'begin_date' => 'date',
        'end_date' => 'date'
    ];

    protected $fillable = [
        'title',
        'content',
        'content_type_id',
        'tags',
        'pinned',
        'published',
        'begin_date',
        'end_date',
        'template_id',
        'center_name',
    ];

    protected $appends = ['featured_image', 'files'];
    protected $hidden = ['media'];

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


    /*
    |--------------------------------------------------------------------------
    | RELATIONS
    |--------------------------------------------------------------------------
    */

    /**
     * Get the type that owns the Weblink
     *
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function type(): BelongsTo
    {
        return $this->belongsTo(ContentType::class, 'content_type_id');
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
            ->width(574)
            ->height(310)
            ->performOnCollections('featured_image')
            ->nonQueued();

        $this->addMediaCollection('files');
    }


    /*
    |--------------------------------------------------------------------------
    | MUTATORS
    |--------------------------------------------------------------------------
    */


    public function getDateThAttribute()
    {
        return $this->created_at ? $this->created_at->addYear(543)->translatedFormat('j M Y') : "";
    }

    public function getTagListAttribute()
    {
        return explode(',', $this->tags);
    }

    public function getHasFilesAttribute()
    {
        $media = $this->getFirstMedia('files');
        return !empty($media);
    }

    public function getFilesAttribute()
    {
        $medias = $this->getMedia('files');
        return $medias;
    }

    // public function getFileNameAttribute()
    // {
    //     $media = $this->getFirstMedia('file');
    //     if (!empty($media))
    //         return $media->name . "." . $media->extension;

    //     return '-';
    // }

    // public function getFileSizeAttribute()
    // {
    //     $media = $this->getFirstMedia('file');
    //     if (!empty($media))
    //         return $media->human_readable_size;

    //     return '-';
    // }

    // public function getHasFileAttribute()
    // {
    //     $media = $this->getFirstMedia('file');
    //     return !empty($media);
    // }

    // public function getFileAttribute()
    // {
    //     $media = $this->getFirstMedia('file');
    //     if (!empty($media))
    //         return $media->getFullUrl();
    //     else
    //         return null;
    // }
}
