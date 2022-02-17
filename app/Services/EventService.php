<?php

namespace App\Services;

use App\Helpers\DateHelper;
use App\Models\Event;
use Carbon\Carbon;

class EventService
{
    public function GetCalendarEvents($begin, $end)
    {
        $result = [];

        $begin = Carbon::createFromFormat("d/m/Y", $begin);
        $end = Carbon::createFromFormat("d/m/Y", $end);
        $events = Event::select('*')->whereDate('begin_date', '>=', $begin->startOfDay())->whereDate('end_date', '<=', $end->endOfDay())->get();

        foreach ($events as $event) {
            $item = new \stdClass();
            $item->id = $event->id;
            $item->title = $event->title;
            $item->color = $event->color;
            $item->start = $event->begin_date->format('Y-m-d H:i');
            $item->end = $event->end_date->addDay(1)->format('Y-m-d H:i');

            $result[] = $item;
        }
        return $result;
    }


    public function GetCalendarPublishedEvents($begin, $end)
    {
        $result = [];

        $begin = Carbon::createFromFormat("d/m/Y", $begin);
        $end = Carbon::createFromFormat("d/m/Y", $end);
        $events = Event::ofPublished()->whereDate('begin_date', '>=', $begin->startOfDay())->whereDate('end_date', '<=', $end->endOfDay())->get();

        foreach ($events as $event) {
            $item = new \stdClass();
            $item->id = $event->id;
            $item->title = $event->title;
            $item->color = $event->color;
            $item->start = $event->begin_date->format('Y-m-d H:i');
            $item->end = $event->end_date->addDay(1)->format('Y-m-d H:i');

            $result[] = $item;
        }
        return $result;
    }
}
