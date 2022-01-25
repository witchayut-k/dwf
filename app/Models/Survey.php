<?php

namespace App\Models;

use App\Traits\HasFeaturedImage;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Spatie\MediaLibrary\HasMedia;
use Spatie\MediaLibrary\InteractsWithMedia;
use Sqits\UserStamps\Concerns\HasUserStamps;

class Survey extends Model implements HasMedia
{

    use HasUserStamps, InteractsWithMedia, HasFeaturedImage;
    
    protected $casts = [
        'published' => 'boolean',
    ];

    protected $fillable = [
        'title',
        'description',
        'option_label_1',
        'option_label_2',
        'option_label_3',
        'option_label_4',
        'option_label_5',
        'view_count',
        'published'
    ];

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

    /**
     * Get all of the questions for the Survey
     *
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function questions(): HasMany
    {
        return $this->hasMany(SurveyQuestion::class);
    }
    
    
    /*
    |--------------------------------------------------------------------------
    | MUTATORS
    |--------------------------------------------------------------------------
    */

    public function getChoicesAttribute () {
        $choices = [];

        for ($i = 1; $i <= 5; $i++) {
            if ($this->{"option_label_$i"})
                $choices[] = ['name' => $this->{"option_label_$i"}];
        }

        return $choices;
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
