<?php

namespace App\Http\Controllers\Backend;

use App\Enums\PermissionEnum;
use App\Helpers\ResponseHelper;
use App\Http\Controllers\Controller;
use App\Models\WeblinkType;
use Illuminate\Http\Request;
use Yajra\DataTables\Facades\DataTables;

class WeblinkTypeController extends BaseController
{

    public function __construct()
    {
        parent::__construct(new WeblinkType());
        $this->middleware(["permission:".PermissionEnum::getDescription(PermissionEnum::MANAGE_WEBLINK)]);
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        if ($request->ajax()) {
            $query = WeblinkType::select('*')->where('parent_type_id', NULL)->with('types');

            if ($request->terms) {
                $terms = $request->terms;
                $searchFields = WeblinkType::searchFields();
                $query = $query->where(function ($query) use ($terms, $searchFields) {
                    foreach ($searchFields as $field) {
                        $query->orWhere($field, 'LIKE', "%{$terms}%");
                    }
                });
            }

            return DataTables::eloquent($query)
                ->addIndexColumn()
                ->make(true);
        }

        return view('backend.weblink_types.main');
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create($id)
    {
        $parentType = WeblinkType::find($id);
        $weblinkType = new WeblinkType();
        return view('backend.weblink_types.create', compact('parentType', 'weblinkType'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $weblinkType = WeblinkType::create($request->all());

        if ($request->icon) {
            $weblinkType->clearMediaCollection('icon');
            $weblinkType->addMedia($request->icon)->toMediaCollection('icon');
        }

        if ($request->icon_active) {
            $weblinkType->clearMediaCollection('icon_active');
            $weblinkType->addMedia($request->icon_active)->toMediaCollection('icon_active');
        }

        return ResponseHelper::saveSuccess($request, $weblinkType);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\WeblinkType  $weblinkType
     * @return \Illuminate\Http\Response
     */
    public function edit($id, WeblinkType $weblinkType)
    {
        $parentType = WeblinkType::find($id);
        return view('backend.weblink_types.create', compact('parentType', 'weblinkType'));
    }

    public function table(Request $request, WeblinkType $weblinkType)
    {
        if ($request->ajax()) {
            $query = WeblinkType::select('*')->where('parent_type_id', $weblinkType->id);

            if ($request->terms) {
                $terms = $request->terms;
                $searchFields = WeblinkType::searchFields();
                $query = $query->where(function ($query) use ($terms, $searchFields) {
                    foreach ($searchFields as $field) {
                        $query->orWhere($field, 'LIKE', "%{$terms}%");
                    }
                });
            }

            return DataTables::eloquent($query)
                ->addIndexColumn()
                ->order(function ($query) {
                    $query->orderBy('sequence', 'asc');
                    $query->orderBy('created_at', 'desc');
                })
                ->make(true);
        }

        return view('backend.weblink_types.index', compact('weblinkType'));
    }

    public function show(Request $request, WeblinkType $weblinkType)
    {
        if (empty($weblinkType->parent_type_id))
            return view('backend.weblink_types.show', compact('weblinkType'));

        abort(404);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\WeblinkType  $weblinkType
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, WeblinkType $weblinkType)
    {
        $weblinkType->update($request->all());

        if ($request->icon) {
            $weblinkType->clearMediaCollection('icon');
            $weblinkType->addMedia($request->icon)->toMediaCollection('icon');
        }

        if ($request->icon_active) {
            $weblinkType->clearMediaCollection('icon_active');
            $weblinkType->addMedia($request->icon_active)->toMediaCollection('icon_active');
        }

        return ResponseHelper::saveSuccess($request, $weblinkType);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\WeblinkType  $weblinkType
     * @return \Illuminate\Http\Response
     */
    public function destroy(Request $request, $id, WeblinkType $weblinkType)
    {
        if ($weblinkType->links->count() > 0)
            return ResponseHelper::cannotDeleteDependency($request, $weblinkType);

        $weblinkType->delete();
        return ResponseHelper::deleteSuccess($request, $weblinkType);
    }

    /**
     * Update sequence.
     *
     * @return \Illuminate\Http\Response
     */
    public function updateSequence(Request $request)
    {
        if (count($request->json()->all())) {
            $ids = $request->json()->all();
            foreach ($ids as $i => $key) {
                $id = $key['id'];
                $position = $key['position'];
                $object = $this->model::find($id);
                $object->sequence = $position;
                $object->save();
            }
            return ResponseHelper::updateSequenceSuccess($request);
        } else {
            return ResponseHelper::updateSequenceFailed($request);
        }
    }
}
