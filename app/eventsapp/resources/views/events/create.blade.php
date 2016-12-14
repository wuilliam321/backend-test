@extends('layouts.app')
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
    <h2>Create Event</h2>
    <form action="/events/create" method="post">
        {{ csrf_field() }}
        <div class="row">
            <div class="col-xs-12 col-md-8">
                <div class="form-group">
                    <label for="title">Title</label>
                    <input type="text" class="form-control" id="title" name="title" placeholder="Write the amazing event title here..." value="">
                </div>
                <div class="form-group">
                    <label for="description">Description</label>
                    <textarea type="text" class="form-control" id="description" name="description" rows="12" placeholder="Describe the event here..."></textarea>
                </div>
            </div>
            <div class="col-xs-12 col-md-4">
                <div class="form-group">
                    <label for="location">Event Image Url</label>
                    <div class="input-group">
                        <div class="input-group-addon"><span class="glyphicon glyphicon-picture"></span></div>
                        <input type="text" class="form-control" id="image_url" name="image_url" placeholder="Paste here the event's image url" value="">
                    </div>
                </div>
                <div class="form-group">
                    <label for="is_highlighted">Highlighted?
                        <br />
                        <input type="checkbox" id="is_highlighted" name="is_highlighted" value="1"> Yes, it's a highlighted event
                    </label>
                </div>
                <div class="form-group">
                    <label for="location">Location</label>
                    <div class="input-group">
                        <div class="input-group-addon"><span class="glyphicon glyphicon-map-marker"></span></div>
                        <input type="text" class="form-control" id="location" name="location" placeholder="Location of the event" value="">
                    </div>
                </div>
                <div class="form-group">
                    <label for="date">Event Date</label>
                    <div class="input-group">
                        <div class="input-group-addon"><span class="glyphicon glyphicon-calendar"></span></div>
                        <input type="text" class="form-control" id="date" name="date" placeholder="Click to change date" value="">
                    </div>
                </div>
                <div class="form-group">
                    <label for="date">Price</label>
                    <div class="input-group">
                        <div class="input-group-addon"><i class="fa fa-usd" aria-hidden="true"></i></div>
                        <input type="text" class="form-control" id="price" name="price" placeholder="Set the event's price" value="">
                    </div>
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
    </form>
@endsection