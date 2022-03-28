<?php

namespace App\Models;

use App\Enums\WeblinkTypeEnum;
use App\Traits\HasFeaturedImage;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Spatie\MediaLibrary\HasMedia;
use Spatie\MediaLibrary\InteractsWithMedia;
use Sqits\UserStamps\Concerns\HasUserStamps;
use Znck\Eloquent\Traits\BelongsToThrough;

class Weblink extends Model implements HasMedia
{
    use InteractsWithMedia, HasUserStamps, HasFeaturedImage, BelongsToThrough;

    protected $casts = [
        'published' => 'boolean',
    ];

    protected $fillable = [
        'title',
        'subtitle',
        'weblink_type_id',
        'url',
        'sequence',
        'published',
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
            'weblinks.title',
            't2.title',
            't1.title',
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

    public function scopeOfServices($query)
    {
        return $query->select(
                'weblinks.*',
                't1.title as weblink_type',
                't2.title as parent_type'
            )
            ->leftJoin('weblink_types as t1', 't1.id', '=', 'weblinks.weblink_type_id')
            ->leftJoin('weblink_types as t2', 't2.id', '=', 't1.parent_type_id')
            ->where('t2.id', WeblinkTypeEnum::SERVICE)
            ->where('weblinks.published', TRUE)
            ->where('t1.published', TRUE);
    }


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
        return $this->belongsTo(WeblinkType::class, 'weblink_type_id');
    }

    // public function parentType()
    // {
    //     return $this->belongsToThrough(
    //         'App\Models\WeblinkType', 
    //         'App\Models\WeblinkType as w1',
    //         '',
    //         '',
    //         ['App\Models\WeblinkType' => 'parent_type_id']
    //     );
    // }

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
    }
}
