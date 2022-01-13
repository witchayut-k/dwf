<?php

namespace App\Helpers;

use App\Models\SurveyData;

class SurveyHelper
{
    public static function GetPercentAnswer($surveyId, $question, $choice)
    {
        $surveyList = SurveyData::where('survey_id', $surveyId)->get();
        $sum = 0;

        foreach ($surveyList as $data) {
            $answers = $data->answers;
            if (isset($answers[$question]) && $answers[$question] == $choice)
                $sum++;
        }

        return number_format(count($surveyList) > 0 ? $sum / count($surveyList) * 100 : 0, 2);

    }

    public static function GetQtyAnswer($surveyId, $question, $choice)
    {
        $surveyList = SurveyData::where('survey_id', $surveyId)->get();
        $sum = 0;

        foreach ($surveyList as $data) {
            $answers = $data->answers;
            if (isset($answers[$question]) && $answers[$question] == $choice)
                $sum++;
        }

        return number_format($sum, 0);

    }
}
