<?php

namespace App\Http\Controllers\Frontend;

use App\Http\Controllers\Controller;
use App\Models\Event;
use App\Services\EventService;
use Illuminate\Http\Request;

class EventController extends Controller
{
    public function __construct(EventService $eventService)
    {
        $this->eventService = $eventService;
    }

    public function index (Request $request) {
        if ($request->ajax())
            return $this->calendar($request);

        return view('frontend.events.index');
    }

    public function calendar (Request $request) {
        $res = $this->eventService->GetCalendarPublishedEvents($request->begin, $request->end);
        return response()->json($res);
    }

    public function show (Event $event) {
        return view('frontend.events.show', compact('event'));
        
    }
}
