@extends('layouts.app')
@section('content')
    <h2>Create Event</h2>
    @if (count($errors) > 0)
        <div class="alert alert-danger">
            Ups! an error has been ocurred, please check field alerts
        </div>
    @endif
    {!! Form::open(['url' => '/events/create']) !!}
        <div class="row">
            <div class="col-xs-12 col-md-8">
                <div class="form-group{{ $errors->has('title') ? ' has-error' : '' }}">
                    {{ Form::label('title') }}
                    {{ Form::text('title', '', ['placeholder' => 'Write the amazing event title here...', 'class' => 'form-control']) }}
                    @if ($errors->has('title'))
                        <span class="help-block">
                            <strong>{{ $errors->first('title') }}</strong>
                        </span>
                    @endif
                </div>
                <div class="form-group{{ $errors->has('description') ? ' has-error' : '' }}">
                    {{ Form::label('description') }}
                    {{ Form::textarea('description', '', ['placeholder' => 'Describe the event here...', 'class' => 'form-control', 'rows' => 12]) }}
                    @if ($errors->has('description'))
                        <span class="help-block">
                            <strong>{{ $errors->first('description') }}</strong>
                        </span>
                    @endif
                </div>
            </div>
            <div class="col-xs-12 col-md-4">
                <div class="form-group{{ $errors->has('image_url') ? ' has-error' : '' }}">
                    {{ Form::label('image_url', 'Event Image Url') }}
                    <div class="input-group">
                        <div class="input-group-addon"><span class="glyphicon glyphicon-picture"></span></div>
                        {{ Form::text('image_url', '', ['placeholder' => 'Paste here the event\'s image url', 'class' => 'form-control']) }}
                    </div>
                    @if ($errors->has('image_url'))
                        <span class="help-block">
                            <strong>{{ $errors->first('image_url') }}</strong>
                        </span>
                    @endif
                </div>
                <div class="form-group">
                    {{ Form::label('is_highlighted', 'Highlighted?') }}<br />
                    {{ Form::checkbox('is_highlighted', '1') }} Yes, it's a highlighted event
                </div>
                <div class="form-group{{ $errors->has('location') ? ' has-error' : '' }}">
                    {{ Form::label('location', 'Location') }}
                    <div class="input-group">
                        <div class="input-group-addon"><span class="glyphicon glyphicon-map-marker"></span></div>
                        {{ Form::text('location', '', ['placeholder' => 'Location of the event', 'class' => 'form-control']) }}
                    </div>
                    @if ($errors->has('location'))
                        <span class="help-block">
                            <strong>{{ $errors->first('location') }}</strong>
                        </span>
                    @endif
                </div>
                <div class="form-group{{ $errors->has('date') ? ' has-error' : '' }}">
                    {{ Form::label('date', 'Event Date') }}
                    <div class="input-group">
                        <div class="input-group-addon"><span class="glyphicon glyphicon-calendar"></span></div>
                        {{ Form::text('date', '', ['placeholder' => 'Click to change date', 'class' => 'form-control']) }}
                    </div>
                    @if ($errors->has('date'))
                        <span class="help-block">
                            <strong>{{ $errors->first('date') }}</strong>
                        </span>
                    @endif
                </div>
                <div class="form-group{{ $errors->has('price') ? ' has-error' : '' }}">
                    {{ Form::label('price', 'Price') }}
                    <div class="input-group">
                        <div class="input-group-addon"><i class="fa fa-usd" aria-hidden="true"></i></div>
                        {{ Form::text('price', '', ['placeholder' => 'Set the event\'s price', 'class' => 'form-control']) }}
                    </div>
                    @if ($errors->has('price'))
                        <span class="help-block">
                            <strong>{{ $errors->first('price') }}</strong>
                        </span>
                    @endif
                </div>
            </div>
        </div>
        <div class="float-button">
            <button type="submit" class="btn btn-primary text-center">
                &nbsp;<span class="glyphicon glyphicon-floppy-disk"></span>
                <span class="hidden-xs">
                    <br>
                    Create
                </span>
            </button>
        </div>
    {!! Form::close() !!}
@endsection