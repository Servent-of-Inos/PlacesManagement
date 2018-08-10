<html>

    <head>
        <title>App Name - @yield('title')</title>

        <meta name="viewport" content="initial-scale=1.0">
        <meta charset="utf-8">
        <meta name="csrf-token" content="{{ csrf_token() }}">

        <link rel="stylesheet" href="{{ asset('css/app.css') }}">
        
    </head>

    <body>

        <div class="container">

            @yield('content')

        </div>

        <script src="https://maps.googleapis.com/maps/api/js?key=AIzaSyDCfR5DtrQFP5fjvL79QjBw7WuGVtiFPs8"></script>

        <script src="{{ asset('js/app.js') }}"></script>

    </body>
    
</html>
