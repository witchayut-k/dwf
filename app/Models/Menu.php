<?php

namespace App\Models;

use App\Helpers\LocaleHelper;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Menu extends Model
{
    use HasFactory;

    public $timestamps = false;

    protected $attributes = [
        'menu_position' => 'top_menu'
    ];

    protected $fillable = [
        'title_th',
        'title_en',
        'parent_id',
        'menu_type_id',
        'content_id',
        'url',
        'sequence',
        'target',
        'published',
        'menu_position'
    ];

    /*
    |--------------------------------------------------------------------------
    | SEARCHING
    |--------------------------------------------------------------------------
    */

    public static function searchFields()
    {
        return [
            'menus.title_th',
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
     * Get the content that owns the Menu
     *
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function content(): BelongsTo
    {
        return $this->belongsTo(Content::class);
    }

    /**
     * Get the content_category that owns the Menu
     *
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function content_category(): BelongsTo
    {
        return $this->belongsTo(ContentType::class, 'content_id');
    }

    /**
     * Get all of the children for the Menu
     *
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function children(): HasMany
    {
        return $this->hasMany(Menu::class, 'parent_id');
    }

    public function published_children()
    {
        return $this->children()->ofPublished()->orderBy('sequence');
    }

    /**
     * Get the parent_menu that owns the Menu
     *
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function parent_menu(): BelongsTo
    {
        return $this->belongsTo(Menu::class, 'parent_id');
    }

    /*
    |--------------------------------------------------------------------------
    | ACCESORS
    |--------------------------------------------------------------------------
    */

    public function getTitleAttribute()
    {
        return LocaleHelper::getTranslated([
            'title_th' => $this->title_th,
            'title_en' => $this->title_en
        ]);
    }
}
