<?php

namespace App\Http\Controllers;

use App\Event;
use App\EventDate;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

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

    function create(Request $request)
    {
        if (Auth::check()) {
            return view('events.create');
        } else {
            $request->session()->flash('status', 'danger');
            $request->session()->flash('message', 'You have not credentials');
            return redirect()->route('login');
        }
    }

    function view($id)
    {
        $event_date = EventDate::find($id);
        return view('events.view', ['event_date' => $event_date]);
    }

    function edit($id)
    {
        $event_date = EventDate::find($id);
        return view('events.edit', ['event_date' => $event_date]);
    }


    function save(Request $request)
    {
        if (Auth::check()) {
            $data = $request->all();

            $event = new Event();
            $event->title = $data['title'];
            $event->description = $data['description'];
            $event->image_url = $data['image_url'];
            $event->is_highlighted = (isset($data['is_highlighted'])) ? $data['is_highlighted'] : false;
            $event->save();

            $event_date = new EventDate();
            $event_date->date = Carbon::createFromFormat('M j @ H:i', $data['date'])->toDateTimeString();
            $event_date->price = $data['price'];
            $event_date->location = $data['location'];

            $event->event_dates()->saveMany([
                $event_date
            ]);

            $request->session()->flash('status', 'success');
            $request->session()->flash('message', 'Event has been created');
            return redirect()->route('main');
        } else {
            $request->session()->flash('status', 'danger');
            $request->session()->flash('message', 'You have not credentials');
            return redirect()->route('login');
        }
    }


    function update(Request $request, $id)
    {
        if (Auth::check()) {
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

            $request->session()->flash('status', 'success');
            $request->session()->flash('message', 'Event has been updated');
            return redirect()->route('main');
        } else {
            $request->session()->flash('status', 'danger');
            $request->session()->flash('message', 'You have not credentials');
            return redirect()->route('login');
        }
    }
}
