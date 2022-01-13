<?php

namespace App\Http\Controllers\Frontend;

use App\Http\Controllers\Controller;
use App\Models\Survey;
use App\Models\SurveyData;
use App\Services\ContentService;
use Illuminate\Http\Request;

class SurveyController extends Controller
{

    public function __construct(ContentService $contentService)
    {
        $this->contentService = $contentService;
    }
    
    public function index(Survey $survey)
    {
        if (!$survey || !$survey->published)
            abort(404);

        $surveyData = SurveyData::where('survey_id', $survey->id)->get();
       
        // foreach ($surveyData as $answers) {
        //     foreach ($answers as $answer) {

        //     }
        // }

        $surveyResult = [
            'votes' => count($surveyData)
        ];

        $moreSurveys = $this->contentService->getPublishedSurveysExceptCurrent($survey);


        return view('frontend.surveys.index', compact('survey', 'surveyResult', 'moreSurveys'));
    }

    public function store (Request $request) {
        // Registered::create($request->all());

        $answers = [];

        foreach ($request->all() as $key => $value) {
            if (\Str::startsWith($key, 'question_'))
                $answers[] = intval($value);
        }

        SurveyData::create([
            'survey_id' => $request->survey_id,
            'answers' => $answers
        ]);
      
        return redirect(url("surveys/$request->survey_id"))->withSuccess('');
    }
}
