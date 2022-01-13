<?php

namespace App\Services;

use App\Helpers\DateHelper;
use App\Models\Event;
use Carbon\Carbon;

class SurveyService
{
  
    public function SaveQuestions($request, $survey)
    {
        $survey->questions()->delete();

        $questions =  (array)json_decode($request->questions, true);
        $survey->questions()->createMany($questions);
    }
}
