<?php

namespace App\Http\Controllers\Backend;

use App\Helpers\FormHelper;
use App\Helpers\ResponseHelper;
use App\Helpers\UploadHelper;
use App\Http\Controllers\Controller;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Http\Request;

class BaseController extends Controller
{

    protected $model;

    public function __construct(Model $model)
    {
        $this->middleware('auth');
        $this->model = $model;
    }

    /**
     * Update status.
     *
     * @return \Illuminate\Http\Response
     */
    public function updateStatus(Request $request, $id)
    {
        $object = $this->model::find($id);
        if (isset($object->published))
            $object->published = $request->active;

        if (isset($object->enabled))
            $object->enabled = $request->active;

        $object->save();
        return ResponseHelper::updateStatusSuccess($request);
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

    /**
     * Media
     */
    public function uploadFeatured(Request $request)
    {
        $content = $this->model::find($request->id);
        if ($request->file != null)
            UploadHelper::addMedia($request->file, $content, 'featured_image');

        return response()->json(['result' => $content]);
    }
}
