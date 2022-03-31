<?php

namespace App\Http\Controllers\Backend;

use App\Enums\PermissionEnum;
use App\Helpers\ResponseHelper;
use App\Helpers\UploadHelper;
use App\Http\Controllers\Controller;
use App\Models\Survey;
use App\Services\SurveyService;
use Illuminate\Http\Request;
use Yajra\DataTables\Facades\DataTables;

class SurveyController extends BaseController
{
    public function __construct(SurveyService $surveyService)
    {
        parent::__construct(new Survey());
        $this->surveyService = $surveyService;
        $this->middleware(["permission:".PermissionEnum::getDescription(PermissionEnum::MANAGE_SURVEY)]);
    }
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        if ($request->ajax()) {
            $query = Survey::select('*');

            if ($request->terms) {
                $terms = $request->terms;
                $searchFields = Survey::searchFields();
                $query = $query->where(function ($query) use ($terms, $searchFields) {
                    foreach ($searchFields as $field) {
                        $query->orWhere($field, 'LIKE', "%{$terms}%");
                    }
                });
            }

            return DataTables::eloquent($query)
                ->addIndexColumn()
                ->addColumn('featured_image', function ($content) {
                    return $content->featured_image_resized;
                })
                ->make(true);
        }
        return view('backend.surveys.index');
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $survey = new Survey();
        return view('backend.surveys.create', compact('survey'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $this->transformRequest($request);
        $survey = Survey::create($request->all());

        if ($request->file)
            UploadHelper::addMedia($request->file, $survey, "featured_image");

        $this->surveyService->SaveQuestions($request, $survey);

        return ResponseHelper::saveSuccess($request, $survey);
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Survey  $survey
     * @return \Illuminate\Http\Response
     */
    public function show(Survey $survey)
    {
        return view('backend.surveys.show', compact('survey'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Survey  $survey
     * @return \Illuminate\Http\Response
     */
    public function edit(Survey $survey)
    {
        return view('backend.surveys.create', compact('survey'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Survey  $survey
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Survey $survey)
    {
        $this->clearCustomFields($survey);
        $this->transformRequest($request);
        $survey->update($request->all());

        if ($request->file)
            UploadHelper::addMedia($request->file, $survey, "featured_image");

        $this->surveyService->SaveQuestions($request, $survey);

        return ResponseHelper::saveSuccess($request, $survey);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Survey  $survey
     * @return \Illuminate\Http\Response
     */
    public function destroy(Request $request, Survey $survey)
    {
        $survey->delete();
        return ResponseHelper::deleteSuccess($request, $survey);
    }

    public function transformRequest(Request &$request)
    {
        $fields = json_decode($request->choices);
        
        foreach ($fields as $key => $field) {
            $name = "option_label_". ($key + 1);
            $request->merge([$name => $field->name]);
        }
    }

    public function clearCustomFields ($survey) {
        for ($i = 1; $i <= 5; $i++) 
            $survey->{"option_label_$i"} = null;

        $survey->update();
    }

    public function getChoices (Request $request, Survey $survey) {
        return response()->json($survey->choices);
    }

    public function getQuestions (Request $request, Survey $survey) {
        return response()->json($survey->questions);
    }
}
