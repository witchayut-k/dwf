<?php

namespace App\Http\Controllers\Backend;

use App\Enums\PermissionEnum;
use App\Helpers\ResponseHelper;
use App\Http\Controllers\Controller;
use App\Models\Registrar;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Yajra\DataTables\Facades\DataTables;

class RegistrarController extends BaseController
{
    public function __construct()
    {
        parent::__construct(new Registrar());
        $this->middleware(["permission:".PermissionEnum::getDescription(PermissionEnum::MANAGE_REGISTRAR)]);
    }
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        if ($request->ajax()) {
            $query = Registrar::select('*');

            if ($request->terms) {
                $terms = $request->terms;
                $searchFields = Registrar::searchFields();
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
                ->addColumn('registered_count', function ($content) {
                    return 0;
                })
                ->make(true);
        }
        return view('backend.registrars.index');
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $registrar = new Registrar();
        $registrar->begin_date = Carbon::now();
        $registrar->end_date = Carbon::now();
        return view('backend.registrars.create', compact('registrar'));
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
        $registrar = Registrar::create($request->all());

        if ($request->file) {
            $registrar->clearMediaCollection('featured_image');
            $registrar->addMedia($request->file)->toMediaCollection('featured_image');
        }

        return ResponseHelper::saveSuccess($request, $registrar);
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Registrar  $registrar
     * @return \Illuminate\Http\Response
     */
    public function show(Registrar $registrar)
    {
        return view('backend.registrars.show', compact('registrar'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Registrar  $registrar
     * @return \Illuminate\Http\Response
     */
    public function edit(Registrar $registrar)
    {
        return view('backend.registrars.create', compact('registrar'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Registrar  $registrar
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Registrar $registrar)
    {
        $this->clearCustomFields($registrar);
        $this->transformRequest($request);
        $registrar->update($request->all());

        if ($request->file) {
            $registrar->clearMediaCollection('featured_image');
            $registrar->addMedia($request->file)->toMediaCollection('featured_image');
        }

        return ResponseHelper::saveSuccess($request, $registrar);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Registrar  $registrar
     * @return \Illuminate\Http\Response
     */
    public function destroy(Request $request, Registrar $registrar)
    {
        $registrar->delete();
        return ResponseHelper::deleteSuccess($request, $registrar);
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

        $fields = json_decode($request->fields);
        
        foreach ($fields as $key => $field) {
            $name = "option_label_". ($key + 1);
            $request->merge([$name => $field->name]);
        }

    }

    public function clearCustomFields ($registrar) {
        for ($i = 1; $i <= 10; $i++) 
            $registrar->{"option_label_$i"} = null;

        $registrar->update();
    }

    public function getFields (Request $request, Registrar $registrar) {
        return response()->json($registrar->fields);
    }
}
