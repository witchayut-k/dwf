<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class SurveyData extends Model
{
    use HasFactory;

    protected $casts = [
        'answers' => 'array',
    ];

    protected $fillable = [
        'survey_id',
        'answers'
    ];
}
