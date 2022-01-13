<?php

namespace App\Http\Controllers\Backend;

use App\Enums\PermissionEnum;
use App\Helpers\ResponseHelper;
use App\Http\Controllers\Controller;
use App\Models\Contact;
use Illuminate\Http\Request;
use Yajra\DataTables\Facades\DataTables;
use Grimzy\LaravelMysqlSpatial\Types\Point;

class ContactController extends BaseController
{
    public function __construct()
    {
        parent::__construct(new Contact());
        $this->middleware(["permission:".PermissionEnum::getDescription(PermissionEnum::MANAGE_CONTACT)]);
    }
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        if ($request->ajax()) {
            $query = Contact::select('id', 'title', 'address', 'tel', 'sequence')->orderBy('sequence');

            if ($request->terms) {
                $terms = $request->terms;
                $searchFields = Contact::searchFields();
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
        return view('backend.contacts.index');
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $contact = new Contact();
        return view('backend.contacts.create', compact('contact'));
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
        $contact = Contact::create($request->all());
        return ResponseHelper::saveSuccess($request, $contact);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Contact  $contact
     * @return \Illuminate\Http\Response
     */
    public function edit(Contact $contact)
    {
        return view('backend.contacts.create', compact('contact'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Contact  $contact
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Contact $contact)
    {
        $this->transformRequest($request);
        $contact->update($request->all());
        return ResponseHelper::updateSuccess($request, $contact);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Contact  $contact
     * @return \Illuminate\Http\Response
     */
    public function destroy(Request $request, Contact $contact)
    {
        $contact->delete();
        return ResponseHelper::deleteSuccess($request, $contact);
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


    private function transformRequest (&$request) {
        // $request->merge(['location' => new Point($request->lat, $request->lng)]);
    }
}
