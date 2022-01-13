<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class SurveyQuestion extends Model
{
    use HasFactory;

    public $timestamps = false;

    protected $fillable = [
        'question',
        'survey_id'
    ];

    /**
     * Get the Survey that owns the SurveyQuestion
     *
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function Survey(): BelongsTo
    {
        return $this->belongsTo(Survey::class);
    }
}
