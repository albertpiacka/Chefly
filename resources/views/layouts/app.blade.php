<!doctype html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- CSRF Token -->
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>{{ config('app.name', 'Laravel') }}</title>

    <!-- Scripts -->
    <script src="{{ asset('js/app.js') }}" defer></script>

    <!-- User type -->
    @auth
        <meta name="api-token" content="{{Auth::user()->api_token}}">
        <meta name="user-name" content="{{Auth::user()->name}}">
    @endauth

    <!-- Fonts -->
    <link rel="dns-prefetch" href="//fonts.gstatic.com">
    <link href="https://fonts.googleapis.com/css?family=Nunito" rel="stylesheet">

    <!-- Styles -->
    <link href="{{ asset('css/app.css') }}" rel="stylesheet">
    <link rel="stylesheet" href="https://unpkg.com/aos@next/dist/aos.css" />
</head>
<body class="{{$class ?? ''}}">
    <div id="app">
        <div class="toggle-container">
            <input type="checkbox" id="switch" name="theme" /><label for="switch">Toggle</label>
        </div>

        <nav class="navbar navbar-expand-md navbar-light fixed-top" data-aos="fade-down" data-aos-delay="200">
            
            <div class="container">
                <a class="navbar-brand" href="{{ url('/') }}">
                    {{-- {{ config('app.name', 'Laravel') }} --}}
                    <svg xmlns="http://www.w3.org/2000/svg" width="1.5em" height="1.5em" fill="currentColor" class="bi bi-house home-title" viewBox="0 0 16 16">
                        <path fill-rule="evenodd" d="M2 13.5V7h1v6.5a.5.5 0 0 0 .5.5h9a.5.5 0 0 0 .5-.5V7h1v6.5a1.5 1.5 0 0 1-1.5 1.5h-9A1.5 1.5 0 0 1 2 13.5zm11-11V6l-2-2V2.5a.5.5 0 0 1 .5-.5h1a.5.5 0 0 1 .5.5z"/>
                        <path fill-rule="evenodd" d="M7.293 1.5a1 1 0 0 1 1.414 0l6.647 6.646a.5.5 0 0 1-.708.708L8 2.207 1.354 8.854a.5.5 0 1 1-.708-.708L7.293 1.5z"/>
                    </svg>
                </a>
                <button class="navbar-toggler bg-light" type="button" data-toggle="collapse" data-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="{{ __('Toggle navigation') }}">
                    <span class="navbar-toggler-icon"></span>
                </button>

                <div class="collapse navbar-collapse" id="navbarSupportedContent">
                    <!-- Left Side Of Navbar -->
                    <ul class="navbar-nav mr-auto">
                        <li>
                            <a class="menu-link" href="/posts">Explore</a>
                        </li>

                        <li>
                            <a class="menu-link" href="/users">People</a>
                        </li>
                    </ul>

                    <!-- Right Side Of Navbar -->
                    <ul class="navbar-nav ml-auto">
                        <!-- Authentication Links -->
                        @guest
                            <li class="nav-item">
                                <a class="menu-link login-link" href="{{ route('login') }}">{{ __('Login') }}</a>
                            </li>
                            @if (Route::has('register'))
                                <li class="nav-item">
                                    <a class="menu-link register-link" href="{{ route('register') }}">{{ __('Register') }}</a>
                                </li>
                            @endif
                        @else
                            <li class="nav-item search-item">
                                <searching/>
                            </li>

                            <li class="nav-item dropdown">
                                <a href="#" ref="profile-link"
                                id="navbarDropdown" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false"
                                >
                                    @if (Auth::user()->image)
                                        <b-avatar class="user-avatar" src="<?php echo url('/')?>/{{Auth::user()->image}}"></b-avatar>
                                    @else
                                        <b-avatar class="user-avatar" variant="primary" 
                                            text="<?php echo substr(Auth::user()->name, 0, 1)?>">
                                        </b-avatar>
                                    @endif
                                </a>

                                <div class="dropdown-menu dropdown-menu-right header-menu" aria-labelledby="navbarDropdown">
                                    <a href="{{route('login')}}" class="header-menu-item">
                                        Profile
                                    </a>

                                    @if (Auth::user()->type == 1)
                                        <a href="/admin" class="header-menu-item">
                                            Dashboard
                                        </a>
                                    @endif

                                    <b-button variant="outline-primary" pill
                                        href="{{ route('logout') }}"
                                        onclick="event.preventDefault();
                                                document.getElementById('logout-form').submit();">
                                        {{ __('Logout') }}
                                    </b-button>

                                    <form id="logout-form" action="{{ route('logout') }}" method="POST" class="d-none">
                                        @csrf
                                    </form>
                                </div>
                            </li>
                        @endguest
                    </ul>
                </div>
            </div>

            <div>
                <searched-data base-url="<?php echo url('/')?>"></searched-data>
            </div>
        </nav>

        <div class="container p-2">
            <div class="title-primary" data-aos="fade-up">
                @if ($title ?? '')
                    <h1 class="headings-primary-dark display-3 font-weight-bold">{{$title}}</h1>
                @endif
            </div>
        </div>

        <flash-message></flash-message>
        
        @auth
            <the-chat :user="{{Auth::user()}}" :conversations="{{Auth::user()->conversations}}"></the-chat>
        @endauth

        @auth
            <user-panel 
            :user-data="{{Auth::user()->load('bookmarks')}}" 
            base-url="<?php echo url('/')?>"
            ></user-panel>
        @endauth
        
        <main class="py-4">
            @yield('content')
        </main>
    </div>

    <script src="https://js.pusher.com/7.0/pusher.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/velocity/1.2.3/velocity.min.js"></script>
    <script src="https://unpkg.com/aos@next/dist/aos.js"></script>
    <script>
        AOS.init();
    </script>
</body>
</html>
