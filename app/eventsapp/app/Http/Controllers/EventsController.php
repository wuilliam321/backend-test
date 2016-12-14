<?php

namespace App\Http\Controllers;

use App\Event;
use App\EventDate;
use Carbon\Carbon;
use Illuminate\Http\Request;

class EventsController extends Controller
{
    function index()
    {
        $events = EventDate::paginate(4);
        $highlighted = EventDate::join('events', 'events.id', '=', 'event_dates.event_id')
            ->select('events.*', 'event_dates.*')
            ->where('date', '>=', Carbon::today())
            ->where('is_highlighted', 1)
            ->get();
        return view('events.list', ['event_dates' => $events, 'highlighted' => $highlighted]);
    }

    function create()
    {
        return view('events.create');
    }

    function view($id)
    {
        $event_date = EventDate::find($id);
        return view('events.view', ['event_date' => $event_date]);
    }


    function save(Request $request)
    {
        $data = $request->all();

        $event = new Event();
        $event->title = $data['title'];
        $event->description = $data['description'];
        $event->image_url = $data['image_url'];
        $event->is_highlighted = $data['is_highlighted'];
        $event->save();

        $event_date = new EventDate();
        $event_date->date = Carbon::createFromFormat('M j @ H:i', $data['date'])->toDateTimeString();
        $event_date->price = $data['price'];
        $event_date->location = $data['location'];

        $event->event_dates()->saveMany([
            $event_date
        ]);

        return redirect()->route('main');
    }


    function update(Request $request, $id)
    {
        $data = $request->all();
        $event_date = EventDate::find($id);
        $event_date->date = Carbon::createFromFormat('M j @ H:i', $data['date'])->toDateTimeString();
        $event_date->price = $data['price'];
        $event_date->location = $data['location'];
        $event_date->save();

        $event = $event_date->event;
        $event->title = $data['title'];
        $event->description = $data['description'];
        $event->image_url = $data['image_url'];
        $event->is_highlighted = (isset($data['is_highlighted'])) ? $data['is_highlighted'] : false;
        $event_date->event->save();

        return redirect()->route('main');
    }
}
