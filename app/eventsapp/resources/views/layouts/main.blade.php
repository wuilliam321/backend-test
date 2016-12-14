<html>
<head>
    <title>EventsApp - @yield('title')</title>
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <link rel="stylesheet" href="/css/app.css">
    <link rel="stylesheet" href="/css/font-awesome.min.css">
    <script type="text/javascript" src="/js/app.js"></script>
</head>
<body>
    <div id="app">
        @section('navbar')
            <nav class="navbar navbar-default">
                <div class="container-fluid">
                    <!-- Brand and toggle get grouped for better mobile display -->
                    <div class="navbar-header">
                        <a class="navbar-brand" href="/">Events</a>
                    </div>
                </div>
            </nav>
        @show
        <div class="container-fluid">
            @if(Session::has('status'))
                <div class="alert alert-{{ Session::get('status') }}" role="alert">
                    {{ Session::get('message') }}
                </div>
            @endif
            @yield('content')
        </div>
    </div>
</body>
</html>