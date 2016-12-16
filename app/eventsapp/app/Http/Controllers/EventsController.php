<?php

namespace App\Http\Controllers;

use App\Event;
use App\EventDate;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Arr;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\URL;
use Illuminate\Support\Facades\Validator;

class EventsController extends Controller
{
    /**
     * Show the list of events
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
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

    /**
     * Allows to create a new event
     * @param Request $request
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\Http\RedirectResponse|\Illuminate\View\View
     */
    function create(Request $request)
    {
        if (Auth::check()) {
            return view('events.create');
        } else {
            // Messages on success
            $request->session()->flash('status', 'danger');
            $request->session()->flash('message', 'You have not credentials');
            return redirect()->route('login');
        }
    }

    /**
     * Display a known event by using its id
     * @param $id
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    function view($id)
    {
        $event_date = EventDate::find($id);
        return view('events.view', ['event_date' => $event_date]);
    }

    /**
     * Show the form to update the given event's id
     * @param $id
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    function edit($id)
    {
        $event_date = EventDate::find($id);
        return view('events.edit', ['event_date' => $event_date]);
    }

    /**
     * Save the event into the database or update an old one
     * @param Request $request
     * @param null $id Event id (null when it is a creation action)
     * @return \Illuminate\Http\RedirectResponse
     */
    function store(Request $request, $id = null)
    {
        if (Auth::check()) {
            // Validation
            $validator = Validator::make($request->all(), [
                'title' => 'required|max:255',
                'description' => 'required',
                'image_url' => 'required|url',
                'date' => 'required|date_format:"M j @ H:i"',
                'price' => 'required|numeric',
                'location' => 'required',
            ]);

            if ($validator->fails()) {
                return redirect(URL::previous())
                    ->withErrors($validator)
                    ->withInput();
            }

            // Getting the request data
            $data = $request->all();

            // Check if it is an update or create
            if ($request->isMethod('put') && isset($id) && !empty($id)) {
                $response = $this->updateEvent($id, $data);
            } else {
                $response = $this->createEvent($data);
            }

            // Messages on success
            if ($response) {
                $request->session()->flash('status', 'success');
                $request->session()->flash('message', 'Event has been stored');
                return redirect()->route('main');
            } else {
                $request->session()->flash('status', 'danger');
                $request->session()->flash('message', 'Ups! an error has been occurred');
                return redirect(URL::previous());
            }

        } else {
            // Messages on error
            $request->session()->flash('status', 'danger');
            $request->session()->flash('message', 'You have not credentials');

            return redirect()->route('login');
        }
    }

    /**
     * Update the given event
     * @param $id Event identifier
     * @param $data Array of the new data
     * @return \App\Event
     */
    public function updateEvent($id, $data)
    {
        $event_date = EventDate::find($id);
        $event = $event_date->event;
        $this->prepareEventFields($event, $data);
        $this->prepareEventDateFields($event_date, $data);
        return $this->storeEvent($event, $event_date, $data);
    }


    /**
     * Create an event with the given data
     * @param $data Array of the new data
     * @return \App\Event
     */
    public function createEvent($data)
    {
        $event = new Event();
        $event_date = new EventDate();
        $this->prepareEventFields($event, $data);
        $this->prepareEventDateFields($event_date, $data);
        return $this->storeEvent($event, $event_date);
    }

    /**
     * Store the event in database and its related event dates
     * @param $event \App\Event model
     * @param $event_date \App\EventDate model
     * @return \App\Event model of stored event
     */
    public function storeEvent($event, $event_date)
    {
        // Saving the event and related dates
        $event->save();
        $event->event_dates()->saveMany([
            $event_date
        ]);

        return $event;
    }

    /**
     * Prepare event model with the given data fields
     * @param $event \App\Event model
     * @param $data Array of event fields
     */
    public function prepareEventFields(&$event, $data)
    {
        // Preparing the event info
        $event->title = $data['title'];
        $event->description = $data['description'];
        $event->image_url = $data['image_url'];
        $event->is_highlighted = (isset($data['is_highlighted'])) ? $data['is_highlighted'] : false;
    }

    /**
     * Prepare event date model with the given data fields
     * @param $event \App\EventDate model
     * @param $data Array of event fields
     */
    public function prepareEventDateFields(&$event_date, $data)
    {
        // Preparing the event data info
        $event_date->date = Carbon::createFromFormat('M j @ H:i', $data['date'])->toDateTimeString();
        $event_date->price = $data['price'];
        $event_date->location = $data['location'];
    }
}
