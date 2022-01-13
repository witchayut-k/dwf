<?php

namespace App\Http\Controllers\Backend;

use App\Enums\PermissionEnum;
use App\Helpers\ResponseHelper;
use App\Http\Controllers\Controller;
use App\Models\LandingPage;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Yajra\DataTables\Facades\DataTables;

class LandingPageController extends BaseController
{
    public function __construct()
    {
        parent::__construct(new LandingPage());
        $this->middleware(["permission:".PermissionEnum::getDescription(PermissionEnum::MANAGE_LANDING_PAGE)]);
    }
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        if ($request->ajax()) {
            $query = LandingPage::select('*')->orderByDesc('id');

            if ($request->terms) {
                $terms = $request->terms;
                $searchFields = LandingPage::searchFields();
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


        return view('backend.landing-pages.index');
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $landingPage = new LandingPage();
        $landingPage->begin_date = Carbon::now();
        $landingPage->end_date = Carbon::now()->addDays(6);

        return view('backend.landing-pages.create', compact('landingPage'));
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
        $landingPage = LandingPage::create($request->all());

        if ($request->file) {
            $landingPage->clearMediaCollection('featured_image');
            $landingPage->addMedia($request->file)->toMediaCollection('featured_image');
        }

        return ResponseHelper::saveSuccess($request, $landingPage);
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\LandingPage  $landingPage
     * @return \Illuminate\Http\Response
     */
    public function show(LandingPage $landingPage)
    {
        return view('backend.landing-pages.show', compact('landingPage'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\LandingPage  $landingPage
     * @return \Illuminate\Http\Response
     */
    public function edit(LandingPage $landingPage)
    {
        return view('backend.landing-pages.create', compact('landingPage'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\LandingPage  $landingPage
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, LandingPage $landingPage)
    {
        $this->transformRequest($request);
        $landingPage->update($request->all());

        if ($request->file) {
            $landingPage->clearMediaCollection('featured_image');
            $landingPage->addMedia($request->file)->toMediaCollection('featured_image');
        }

        return ResponseHelper::updateSuccess($request, $landingPage);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\LandingPage  $landingPage
     * @return \Illuminate\Http\Response
     */
    public function destroy(Request $request, LandingPage $landingPage)
    {
        $landingPage->delete();
        return ResponseHelper::deleteSuccess($request, $landingPage);
    }


    public function transformRequest(Request &$request)
    {
        if ($request->begin_date) {
            $beginDate = Carbon::createFromFormat("d/m/Y", trim($request->begin_date));
            $request->merge(['begin_date' => $beginDate]);
        }

        if ($request->end_date) {
            $endDate = Carbon::createFromFormat("d/m/Y", trim($request->end_date));
            $request->merge(['end_date' => $endDate]);
        }
    }
}
