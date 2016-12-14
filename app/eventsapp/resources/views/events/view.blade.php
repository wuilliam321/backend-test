@extends('layouts.app')
@section('title', 'Dashboard')
@section('content')
    <div class="row">
        <div class="col-xs-12 col-md-8">
            <h2>
                {{ $event_date->event->title }}
                <small>{{ $event_date->location }}</small>

                @if($event_date->event->is_highlighted)
                    <span class="glyphicon glyphicon-star" title="Highlighted"></span>
                @endif
            </h2>
            <div class="form-group">
                <label for="description">Description</label>
                <p>{{ $event_date->event->description }}</p>
            </div>
        </div>
        <div class="col-xs-12 col-md-4">
            <div class="event-img">
                <img src="{{ $event_date->event->image_url }}" alt="{{ $event_date->event->title }}" class="img-thumbnail">
            </div>
            <div class="form-group">
                <label for="location">Location</label>
                <div class="input-group">
                    <div class="input-group-addon"><span class="glyphicon glyphicon-map-marker"></span></div>
                    <span class="form-control">{{ $event_date->location}}</span>
                </div>
            </div>
            <div class="form-group">
                <label for="date">Event Date</label>
                <div class="input-group">
                    <div class="input-group-addon"><span class="glyphicon glyphicon-calendar"></span></div>
                    <span class="form-control">{{ $event_date->getDate() }} @ {{ $event_date->getTime() }}</span>
                </div>
            </div>
            <div class="form-group">
                <label for="date">Price</label>
                <div class="input-group">
                    <div class="input-group-addon"><i class="fa fa-usd" aria-hidden="true"></i></div>
                    <span class="form-control">{{ $event_date->price }}</span>
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
@endsection