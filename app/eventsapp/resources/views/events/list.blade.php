@extends('layouts.main')
@section('title', 'Dashboard')
@section('content')

    <div class="row">
        <div class="col-xs-12 col-md-8">
            @foreach ($event_dates as $event_date)
                <div class="col-xs-12 col-md-5 col-md-offset-1 panel panel-default">
                    <div class="row panel-heading">
                        <div class="event-date col-xs-6">{{ $event_date->getDateForEventCard() }}</div>
                        <div class="event-share dropdown text-right col-xs-6">
                            <button class="btn btn-default dropdown-toggle" type="button" id="dropdownMenu1" data-toggle="dropdown" aria-haspopup="true" aria-expanded="true">
                                <i class="fa fa-share-alt" aria-hidden="true"></i> Share
                                <span class="caret"></span>
                            </button>
                            <ul class="dropdown-menu sharer" aria-labelledby="dropdownMenu1">
                                <li>
                                    <div class="twitter">
                                        <a class="twitter-share-button"
                                           href="https://twitter.com/share"
                                           data-size="large"
                                           data-text="I will to go the {{ $event_date->event->title }} @ {{ $event_date->getDateForEventCard() }}"
                                           data-url="{{ Request::fullUrl()  }}">
                                            Tweet
                                        </a>
                                    </div>
                                </li>
                            </ul>
                        </div>
                    </div>
                    <div class="panel-body">
                        <img src="{{ $event_date->event->image_url }}" alt="{{ $event_date->event->title }}" class="img-thumbnail">
                        <div class="event-title">{{ $event_date->event->title }}</div>
                    </div>
                    <div class="row panel-footer">
                        <div class="event-footer">
                            <a href="/events/{{ $event_date->id }}">View</a>
                        </div>
                    </div>
                </div>
            @endforeach
            <div class="col-xs-12 text-center">
                {{ $event_dates->links() }}
            </div>
        </div>
        <div class="col-xs-12 col-md-4">
            <h3>Today's Highlight</h3>
            @foreach ($highlighted as $event_date)
                <div class="row panel panel-default">
                    <div class="col-xs-4 vcenter">
                        <img src="{{ $event_date->event->image_url }}" alt="{{ $event_date->event->title }}" class="img-thumbnail">
                    </div>
                    <div class="col-xs-8">
                        <h4>
                            <a href="/events/{{ $event_date->id }}" class="event-title">{{ $event_date->event->title }}</a>
                            <small class="event-date">{{ $event_date->getDateForEventCard() }}</small>
                        </h4>
                        <div class="event-description">{{ str_limit($event_date->event->description, $limit = 30, $end = '...') }}</div>
                        <div class="event-location text-right"><small>{{ $event_date->location }}</small></div>
                    </div>
                </div>
            @endforeach
            @if (Route::has('login'))
                <div class="top-right links">
                    <a href="{{ url('/login') }}">Login</a>
                    <a href="{{ url('/register') }}">Register</a>
                </div>
            @endif
        </div>
    </div>
    <div class="float-button">
        <a href="/events/create" class="btn btn-primary text-center">
            &nbsp;<span class="glyphicon glyphicon-plus"></span>
            <span class="hidden-xs">
                <br>
                Add Event
            </span>
        </a>
    </div>
@endsection