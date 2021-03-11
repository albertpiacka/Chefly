<!doctype html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta http-equiv="Content-Security-Policy" content="upgrade-insecure-requests">

    <!-- CSRF Token -->
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <!-- User type -->
    @auth
        <meta name="api-token" content="{{Auth::user()->api_token}}">
        {{-- <meta name="user-name" content="{{Auth::user()->name}}"> --}}
        <meta name="user-info" content="{{Auth::user()}}">
    @endauth
    
    <title>{{ config('app.name', 'Laravel') }}</title>

    <!-- Scripts -->
    <script src="{{ asset('js/admin.js') }}" defer></script>

    <!-- Fonts -->
    <link rel="dns-prefetch" href="//fonts.gstatic.com">
    <link href="https://fonts.googleapis.com/css?family=Nunito" rel="stylesheet">

    <!-- Styles -->
    <link href="{{ asset('css/admin.css') }}" rel="stylesheet">
</head>
<body>
    
    @auth
        @if (Auth::user()->type == 2 || Auth::user()->type == 1)
            <div id="admin" :info="{{Auth::user()}}"></div>
        @else
            Seems like you are lost!
            <a href="/">Go back</a>
        @endif 
    @endauth

</body>
</html>
