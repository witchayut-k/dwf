<?php

namespace App\Http\Controllers\Backend;

use App\Enums\PermissionEnum;
use App\Helpers\ResponseHelper;
use App\Http\Controllers\Controller;
use App\Models\Message;
use Illuminate\Http\Request;
use Yajra\DataTables\Facades\DataTables;

class MessageController extends BaseController
{
    public function __construct()
    {
        parent::__construct(new Message());
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
            $query = Message::select('*')->orderByDesc('created_at');

            if ($request->terms) {
                $terms = $request->terms;
                $searchFields = Message::searchFields();
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
        return view('backend.messeges.index');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Message  $message
     * @return \Illuminate\Http\Response
     */
    public function show(Message $message)
    {
        return view('backend.messeges.show', compact('message'));
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Message  $message
     * @return \Illuminate\Http\Response
     */
    public function destroy(Request $request, Message $message)
    {
        $message->delete();
        return ResponseHelper::deleteSuccess($request, $message, 'subject');
    }
}
