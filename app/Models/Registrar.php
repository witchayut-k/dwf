<?php

namespace App\Models;

use App\Traits\HasDateRange;
use App\Traits\HasFeaturedImage;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Spatie\MediaLibrary\HasMedia;
use Spatie\MediaLibrary\InteractsWithMedia;
use Sqits\UserStamps\Concerns\HasUserStamps;

class Registrar extends Model implements HasMedia
{
    use InteractsWithMedia, HasUserStamps, HasFeaturedImage, HasDateRange;

    protected $casts = [
        'published' => 'boolean',
        'begin_date' => 'date',
        'end_date' => 'date'
    ];

    protected $fillable = [
        'title',
        'description',
        'begin_date',
        'end_date',
        'option_label_1',
        'option_label_2',
        'option_label_3',
        'option_label_4',
        'option_label_5',
        'option_label_6',
        'option_label_7',
        'option_label_8',
        'option_label_9',
        'option_label_10',
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
     * Get all of the registered_list for the Registrar
     *
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function registered_list(): HasMany
    {
        return $this->hasMany(Registered::class);
    }
    
    
    /*
    |--------------------------------------------------------------------------
    | MUTATORS
    |--------------------------------------------------------------------------
    */

    public function getFieldsAttribute () {
        $fields = [];

        for ($i = 1; $i <= 10; $i++) {
            if ($this->{"option_label_$i"})
                $fields[] = ['name' => $this->{"option_label_$i"}];
        }

        return $fields;
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
