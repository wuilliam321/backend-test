@extends('layouts.app')
@section('content')
    <h2>{{ $event_date->event->title }} <small>{{ $event_date->location }}</small></h2>
    @if (count($errors) > 0)
        <div class="alert alert-danger">
            Ups! an error has been ocurred, please check field alerts
        </div>
    @endif
    {!! Form::open(['url' => '/events/' . $event_date->id, 'method' => 'put']) !!}
        <div class="row">
            <div class="col-xs-12 col-md-8">
                <div class="form-group{{ $errors->has('title') ? ' has-error' : '' }}">
                    {{ Form::label('title') }}
                    {{ Form::text('title', $event_date->event->title, ['placeholder' => 'Write the amazing event title here...', 'class' => 'form-control']) }}
                    @if ($errors->has('title'))
                        <span class="help-block">
                            <strong>{{ $errors->first('title') }}</strong>
                        </span>
                    @endif
                </div>
                <div class="form-group{{ $errors->has('description') ? ' has-error' : '' }}">
                    {{ Form::label('description') }}
                    {{ Form::textarea('description', $event_date->event->description, ['placeholder' => 'Describe the event here...', 'class' => 'form-control', 'rows' => 12]) }}
                    @if ($errors->has('description'))
                        <span class="help-block">
                            <strong>{{ $errors->first('description') }}</strong>
                        </span>
                    @endif
                </div>
            </div>
            <div class="col-xs-12 col-md-4">
                <div class="event-img">
                    <img src="{{ $event_date->event->image_url }}" alt="{{ $event_date->event->title }}" class="img-thumbnail">
                </div>
                <div class="form-group{{ $errors->has('image_url') ? ' has-error' : '' }}">
                    {{ Form::label('image_url', 'New Event Image Url') }}
                    <div class="input-group">
                        <div class="input-group-addon"><span class="glyphicon glyphicon-picture"></span></div>
                        {{ Form::text('image_url', $event_date->event->image_url, ['placeholder' => 'Paste here the new event\'s image url', 'class' => 'form-control']) }}
                    </div>
                    @if ($errors->has('image_url'))
                        <span class="help-block">
                            <strong>{{ $errors->first('image_url') }}</strong>
                        </span>
                    @endif
                </div>
                <div class="form-group">
                    {{ Form::label('is_highlighted', 'Highlighted?') }}<br />
                    {{ Form::checkbox('is_highlighted', '1', $event_date->event->is_highlighted) }} Yes, it's a highlighted event
                </div>
                <div class="form-group{{ $errors->has('location') ? ' has-error' : '' }}">
                    {{ Form::label('location', 'Location') }}
                    <div class="input-group">
                        <div class="input-group-addon"><span class="glyphicon glyphicon-map-marker"></span></div>
                        {{ Form::text('location', $event_date->location, ['placeholder' => 'Location of the event', 'class' => 'form-control']) }}
                    </div>
                    @if ($errors->has('location'))
                        <span class="help-block">
                            <strong>{{ $errors->first('location') }}</strong>
                        </span>
                    @endif
                </div>
                <div class="form-group">
                    {{ Form::label('date', 'Event Date') }}
                    <div class="input-group">
                        <div class="input-group-addon"><span class="glyphicon glyphicon-calendar"></span></div>
                        {{ Form::text('date', $event_date->getDate() . ' @ ' . $event_date->getTime(), ['placeholder' => 'Click to change date', 'class' => 'form-control']) }}
                    </div>
                </div>
                <div class="form-group{{ $errors->has('date') ? ' has-error' : '' }}">
                    {{ Form::label('price', 'Price') }}
                    <div class="input-group">
                        <div class="input-group-addon"><i class="fa fa-usd" aria-hidden="true"></i></div>
                        {{ Form::text('price', $event_date->price, ['placeholder' => 'Set the event\'s price', 'class' => 'form-control']) }}
                    </div>
                    @if ($errors->has('date'))
                        <span class="help-block">
                            <strong>{{ $errors->first('date') }}</strong>
                        </span>
                    @endif
                </div>
                <h3>Event's Dates</h3>
                <ul>
                    @foreach($event_date->event->event_dates as $date)
                        @if($date->id == $event_date->id)
                            <li><strong><a href="/events/{{ $date->id }}/edit">{{ $date->getDate() }} {{ $date->getTime() }} - ${{ $date->price }}</a></strong></li>
                        @else
                            <li><a href="/events/{{ $date->id }}/edit">{{ $date->getDate() }} {{ $date->getTime() }} - ${{ $date->price }}</a></li>
                        @endif
                    @endforeach
                </ul>
            </div>
        </div>
        @if (!Auth::guest())
            <div class="float-button">
                <button type="submit" class="btn btn-primary text-center">
                    &nbsp;<span class="glyphicon glyphicon-floppy-disk"></span>
                    <span class="hidden-xs">
                        <br>
                        Update
                    </span>
                </button>
            </div>
        @endif
    {!! Form::close() !!}
@endsection