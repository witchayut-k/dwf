<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\SoftDeletes;
use Spatie\MediaLibrary\HasMedia;
use Spatie\MediaLibrary\InteractsWithMedia;
use Sqits\UserStamps\Concerns\HasUserStamps;

class Document extends Model implements HasMedia
{
    use HasFactory, HasUserStamps, InteractsWithMedia;

    protected $casts = [
        'published' => 'boolean',
    ];

    protected $fillable = [
        'title',
        'document_type_id',
        'description',
        'view_count',
        'download_count',
        'published'
    ];

    protected $appends = ['file'];
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
            'type_name'
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
     * Get the documentType that owns the Document
     *
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function documentType(): BelongsTo
    {
        return $this->belongsTo(DocumentType::class);
    }

    public function registerMediaCollections(): void
    {
        $this->addMediaCollection('file')->singleFile();
    }


    /*
    |--------------------------------------------------------------------------
    | MEDIA
    |--------------------------------------------------------------------------
    */

    public function getFileNameAttribute()
    {
        $media = $this->getFirstMedia('file');
        if (!empty($media))
            return $media->file_name;

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
        return $this->getFirstMedia('file');
    }
}
