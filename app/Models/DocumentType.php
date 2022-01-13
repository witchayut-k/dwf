<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;

class DocumentType extends Model
{
    use HasFactory;

    public $timestamps = false;

    protected $casts = [
        'published' => 'boolean',
    ];

    protected $fillable = [
        'type_name',
        'published',
    ];

    // protected $appends = ['files'];

    public static function options()
    {
        return (new static)::pluck('type_name', 'id');
    }

    /*
    |--------------------------------------------------------------------------
    | SEARCHING
    |--------------------------------------------------------------------------
    */

    public static function searchFields()
    {
        return [
            'type_name',
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
     * Get all of the documents for the DocumentType
     *
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function documents(): HasMany
    {
        return $this->hasMany(Document::class);
    }

    public function published_documents(): HasMany
    {
        return $this->documents()->ofPublished()->orderByDesc('created_at');
    }
}
