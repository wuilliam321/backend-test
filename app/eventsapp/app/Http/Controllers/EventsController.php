<?php

namespace App\Http\Controllers;

use App\Event;
use App\EventDate;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\URL;
use Illuminate\Support\Facades\Validator;

class EventsController extends Controller
{
    function index()
    {
        $events = EventDate::paginate(4);
        $highlighted = EventDate::getHighlightedEvents();
        $data = [
            'event_dates' => $events,
            'highlighted' => $highlighted
        ];
        return view('events.list', $data);
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


    function store(Request $request, $id = null)
    {
        if (Auth::check()) {
            // Validation
            $validator = Validator::make($request->all(), [
                'title' => 'required|max:255',
                'description' => 'required',
                'image_url' => 'required',
                'date' => 'required',
                'price' => 'required',
                'location' => 'required',
            ]);

            if ($validator->fails()) {
                return redirect(URL::previous())
                    ->withErrors($validator)
                    ->withInput();
            }

            // Check if it is an update or create
            if ($request->isMethod('put')) {
                $event_date = EventDate::find($id);
                $event = $event_date->event;
            } else {
                $event = new Event();
                $event_date = new EventDate();
            }

            // Preparing data
            $data = $request->all();
            $event->title = $data['title'];
            $event->description = $data['description'];
            $event->image_url = $data['image_url'];
            $event->is_highlighted = (isset($data['is_highlighted'])) ? $data['is_highlighted'] : false;
            $event->save();

            $event_date->date = Carbon::createFromFormat('M j @ H:i', $data['date'])->toDateTimeString();
            $event_date->price = $data['price'];
            $event_date->location = $data['location'];

            $event->event_dates()->saveMany([
                $event_date
            ]);

            // Messages on success
            $request->session()->flash('status', 'success');
            $request->session()->flash('message', 'Event has been stored');

            return redirect()->route('main');
        } else {
            // Messages on error
            $request->session()->flash('status', 'danger');
            $request->session()->flash('message', 'You have not credentials');

            return redirect()->route('login');
        }
    }
}
