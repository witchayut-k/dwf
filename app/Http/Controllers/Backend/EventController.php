<?php

namespace App\Http\Controllers\Backend;

use App\Enums\PermissionEnum;
use App\Helpers\ResponseHelper;
use App\Http\Controllers\Controller;
use App\Models\Event;
use App\Services\EventService;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Yajra\DataTables\Facades\DataTables;

class EventController extends BaseController
{
    private $eventService;

    public function __construct(EventService $eventService)
    {
        $this->eventService = $eventService;
        parent::__construct(new Event());

        $this->middleware(["permission:".PermissionEnum::getDescription(PermissionEnum::MANAGE_EVENT)]);
    }
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {

        if ($request->ajax()) {
            $begin = Carbon::createFromFormat("d/m/Y", $request->begin);
            $end = Carbon::createFromFormat("d/m/Y", $request->end);
            $query = Event::select('*')->whereDate('begin_date', '>=', $begin->startOfDay())->whereDate('end_date', '<=', $end->endOfDay());

            if ($request->terms) {
                $terms = $request->terms;
                $searchFields = Event::searchFields();
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

        return view('backend.events.index');
    }

    public function calendar (Request $request) {
        $res = $this->eventService->GetCalendarEvents($request->begin, $request->end);
        return response()->json($res);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $event = new Event();
        $event->begin_date = Carbon::now();
        $event->end_date = Carbon::now();
        return view('backend.events.create', compact('event'));

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
        $event = Event::create($request->all());
        return ResponseHelper::saveSuccess($request, $event);
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Event  $event
     * @return \Illuminate\Http\Response
     */
    public function show(Event $event)
    {
        return view('backend.events.show', compact('event'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Event  $event
     * @return \Illuminate\Http\Response
     */
    public function edit(Event $event)
    {
        return view('backend.events.create', compact('event'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Event  $event
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Event $event)
    {
        $this->transformRequest($request);
        $event->update($request->all());
        return ResponseHelper::saveSuccess($request, $event);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Event  $event
     * @return \Illuminate\Http\Response
     */
    public function destroy(Request $request, Event $event)
    {
        $event->delete();
        return ResponseHelper::deleteSuccess($request, $event);
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
