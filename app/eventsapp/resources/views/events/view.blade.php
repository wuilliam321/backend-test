@extends('layouts.main')
@section('title', 'Dashboard')
@section('navbar')
    <nav class="navbar navbar-default">
        <div class="container-fluid">
            <!-- Brand and toggle get grouped for better mobile display -->
            <div class="navbar-header">
                <a class="navbar-brand" href="/">
                    <i class="fa fa-chevron-left" aria-hidden="true"></i>
                    Events
                </a>
            </div>
        </div>
    </nav>
@endsection
@section('content')
    <h2>{{ $event_date->event->title }} <small>{{ $event_date->location }}</small></h2>
    <form action="/events/{{$event_date->id}}" method="post">
        {{ csrf_field() }}
        <div class="row">
            <div class="col-xs-12 col-md-8">
                <div class="form-group">
                    <label for="title">Title</label>
                    <input type="text" class="form-control" id="title" name="title" placeholder="Write the amazing event title here..." value="{{ $event_date->event->title }}">
                </div>
                <div class="form-group">
                    <label for="description">Description</label>
                    <textarea type="text" class="form-control" id="description" name="description" rows="12" placeholder="Describe the event here...">{{ $event_date->event->description }}</textarea>
                </div>
            </div>
            <div class="col-xs-12 col-md-4">
                <div class="event-img">
                    <img src="{{ $event_date->event->image_url }}" alt="{{ $event_date->event->title }}" class="img-thumbnail">
                </div>
                <div class="form-group">
                    <label for="location">New Image Url</label>
                    <div class="input-group">
                        <div class="input-group-addon"><span class="glyphicon glyphicon-picture"></span></div>
                        <input type="text" class="form-control" id="image_url" name="image_url" placeholder="New image url" value="{{ $event_date->event->image_url}}">
                    </div>
                </div>
                <div class="form-group">
                    <label for="is_highlighted">Highlighted?
                        <br />
                        @if($event_date->event->is_highlighted)
                            <input type="checkbox" id="is_highlighted" name="is_highlighted" value="1" checked="checked">
                        @else
                            <input type="checkbox" id="is_highlighted" name="is_highlighted" value="1">
                        @endif
                        Yes, it's a highlighted event
                    </label>
                </div>
                <div class="form-group">
                    <label for="location">Location</label>
                    <div class="input-group">
                        <div class="input-group-addon"><span class="glyphicon glyphicon-map-marker"></span></div>
                        <input type="text" class="form-control" id="location" name="location" placeholder="Location of the event" value="{{ $event_date->location}}">
                    </div>
                </div>
                <div class="form-group">
                    <label for="date">Event Date</label>
                    <div class="input-group">
                        <div class="input-group-addon"><span class="glyphicon glyphicon-calendar"></span></div>
                        <input type="text" class="form-control" id="date" name="date" placeholder="Click to change date" value="{{ $event_date->getDate() }} @ {{ $event_date->getTime() }}">
                    </div>
                </div>
                <div class="form-group">
                    <label for="date">Price</label>
                    <div class="input-group">
                        <div class="input-group-addon"><i class="fa fa-usd" aria-hidden="true"></i></div>
                        <input type="text" class="form-control" id="price" name="price" placeholder="Set the event's price" value="{{ $event_date->price }}">
                    </div>
                </div>
                <h3>Event's Dates</h3>
                <ul>
                    @foreach($event_date->event->event_dates as $date)
                        @if($date->id == $event_date->id)
                            <li><strong><a href="/events/{{ $date->id }}">{{ $date->getDate() }} {{ $date->getTime() }} - ${{ $date->price }}</a></strong></li>
                        @else
                            <li><a href="/events/{{ $date->id }}">{{ $date->getDate() }} {{ $date->getTime() }} - ${{ $date->price }}</a></li>
                        @endif
                    @endforeach
                </ul>
            </div>
        </div>
        <div class="float-button">
            <button type="submit" class="btn btn-primary text-center">
                &nbsp;<span class="glyphicon glyphicon-floppy-disk"></span>
                <span class="hidden-xs">
                    <br>
                    Update
                </span>
            </button>
        </div>
    </form>
@endsection