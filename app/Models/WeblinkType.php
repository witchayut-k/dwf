<?php

namespace App\Models;

use App\Enums\WeblinkTypeEnum;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Spatie\MediaLibrary\HasMedia;
use Spatie\MediaLibrary\InteractsWithMedia;
use Sqits\UserStamps\Concerns\HasUserStamps;
use Znck\Eloquent\Traits\HasTableAlias;

class WeblinkType extends Model implements HasMedia
{
    use HasUserStamps, InteractsWithMedia, HasTableAlias;

    protected $casts = [
        'published' => 'boolean',
    ];

    protected $fillable = [
        'title',
        'parent_type_id',
        'published',
        'sequence',
    ];

    public static function options()
    {
        return (new static)::pluck('title', 'id');
    }

    protected $appends = ['icon', 'icon_active'];
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

    public function scopeOfService($query)
    {
        return $query->where('parent_type_id', WeblinkTypeEnum::SERVICE);
    }

    public function scopeOfSocial($query)
    {
        return $query->where('parent_type_id', WeblinkTypeEnum::SOCIAL_NETWORK_TOP);
    }

    public function scopeOfDepartment($query)
    {
        return $query->where('parent_type_id', WeblinkTypeEnum::DEPARTMENT);
    }

    public function scopeOfRelatedLink($query)
    {
        return $query->where('parent_type_id', WeblinkTypeEnum::RELATED_LINK);
    }

    public function scopeOfGovLink($query)
    {
        return $query->where('parent_type_id', WeblinkTypeEnum::GOV_LINK);
    }

    /*
    |--------------------------------------------------------------------------
    | RELATIONS
    |--------------------------------------------------------------------------
    */

    /**
     * Get all of the weblinks for the VideoCategory
     *
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function weblinks(): HasMany
    {
        return $this->hasMany(Weblink::class);
    }

    /**
     * Get all of the types for the WeblinkType
     *
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function types(): HasMany
    {
        return $this->hasMany(WeblinkType::class, 'parent_type_id', 'id');
    }

    /**
     * Get the parentType that owns the WeblinkType
     *
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function parentType(): BelongsTo
    {
        return $this->belongsTo(WeblinkType::class, 'parent_type_id');
    }



    /*
    |--------------------------------------------------------------------------
    | MEDIA
    |--------------------------------------------------------------------------
    */

    public function registerMediaCollections(): void
    {
        $this->addMediaCollection('icon')->singleFile();
        $this->addMediaCollection('icon_active')->singleFile();

        $this->addMediaConversion('icon_resized')
            ->width(600)
            ->height(600)
            ->performOnCollections('icon')
            ->nonQueued();

        $this->addMediaConversion('icon_active_resized')
            ->width(600)
            ->height(600)
            ->performOnCollections('icon_active')
            ->nonQueued();
    }

    /*
    |--------------------------------------------------------------------------
    | MUTATORS
    |--------------------------------------------------------------------------
    */


    // -- Icon
    public function getIconNameAttribute()
    {
        $media = $this->getFirstMedia('icon');
        if (!empty($media))
            return $media->name . "." . $media->extension;

        return '-';
    }

    public function getIconSizeAttribute()
    {
        $media = $this->getFirstMedia('icon');
        if (!empty($media))
            return $media->human_readable_size;

        return '-';
    }

    public function getHasIconAttribute()
    {
        $media = $this->getFirstMedia('icon');
        return !empty($media);
    }

    public function getIconAttribute()
    {
        $media = $this->getFirstMedia('icon');
        if (!empty($media))
            return $media->getFullUrl();
        else
            return asset('img/img-placeholder.jpg');
    }

    public function getIconResizedAttribute()
    {
        $media = $this->getFirstMedia('icon');

        if (!empty($media))
            return $media->getFullUrl('icon_resized');
        else
            return asset('img/img-placeholder.jpg');
    }

    // -- Icon active

    public function getIconActiveNameAttribute()
    {
        $media = $this->getFirstMedia('icon_active');
        if (!empty($media))
            return $media->name . "." . $media->extension;

        return '-';
    }

    public function getIconActiveSizeAttribute()
    {
        $media = $this->getFirstMedia('icon_active');
        if (!empty($media))
            return $media->human_readable_size;

        return '-';
    }

    public function getHasIconActiveAttribute()
    {
        $media = $this->getFirstMedia('icon_active');
        return !empty($media);
    }

    public function getIconActiveAttribute()
    {
        $media = $this->getFirstMedia('icon_active');
        if (!empty($media))
            return $media->getFullUrl();
        else
            return asset('img/img-placeholder.jpg');
    }

    public function getIconActiveResizedAttribute()
    {
        $media = $this->getFirstMedia('icon_active');

        if (!empty($media))
            return $media->getFullUrl('icon_active_resized');
        else
            return asset('img/img-placeholder.jpg');
    }
}
