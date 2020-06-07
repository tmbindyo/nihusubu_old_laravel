<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="UTF-8">
        <meta http-equiv="X-UA-Compatible" content="ie=edge">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">

        {{--  google analytics  --}}
        @include('layouts.google_analytics')
        <meta name="csrf-token" content="{{ csrf_token() }}">

        <title>{{ config('app.name', 'nihusubu') }}</title>
        <!-- Favicon -->
        <link rel="shortcut icon" href="{{ asset('nihusubu.ico') }}" >
        <!-- Fonts -->
        <link href="https://fonts.googleapis.com/css?family=Open+Sans:300,400,600,700" rel="stylesheet">
        <!-- Icons -->
        <link href="{{ asset('argon') }}/vendor/nucleo/css/nucleo.css" rel="stylesheet">
        <link href="{{ asset('argon') }}/vendor/@fortawesome/fontawesome-free/css/all.min.css" rel="stylesheet">
        <!-- Argon CSS -->
        <link type="text/css" href="{{ asset('argon') }}/css/argon.css?v=1.0.0" rel="stylesheet">
        {{-- Datatables CSS--}}
        <link rel="stylesheet" href="{{ asset('argon') }}/vendor/datatables.net/css/dataTables.bootstrap4.min.css">
        <link rel="stylesheet" href="{{ asset('argon') }}/vendor/datatables.net/css/buttons.bootstrap4.min.css">
        <link rel="stylesheet" href="{{ asset('argon') }}/vendor/datatables.net/css/select.bootstrap4.min.css">
    </head>
    <body class="{{ $class ?? '' }}">
        @auth()
            <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
                @csrf
            </form>

            @include('layouts.navbars.sidebar')

        @endauth

        <div class="main-content">
            @include('layouts.navbars.navbar')
            @yield('content')
        </div>

        @guest()
            @include('layouts.footers.guest')
        @endguest

        <script src="{{ asset('argon') }}/vendor/jquery/dist/jquery.min.js"></script>
        <script src="{{ asset('argon') }}/vendor/bootstrap/dist/js/bootstrap.bundle.min.js"></script>

        <script src="{{ asset('argon') }}/vendor/bootstrap-datepicker/dist/js/bootstrap-datepicker.min.js"></script>

        {{-- Data tables --}}


        <script src="{{ asset('argon') }}/vendor/datatables.net/js/jquery.dataTables.min.js"></script>
        <script src="{{ asset('argon') }}/vendor/datatables.net/js/dataTables.bootstrap4.min.js"></script>
        <script src="{{ asset('argon') }}/vendor/datatables.net/js/dataTables.buttons.min.js"></script>
        <script src="{{ asset('argon') }}/vendor/datatables.net/js/buttons.bootstrap4.min.js"></script>
        <script src="{{ asset('argon') }}/vendor/datatables.net/js/buttons.html5.min.js"></script>
        <script src="{{ asset('argon') }}/vendor/datatables.net/js/buttons.flash.min.js"></script>
        <script src="{{ asset('argon') }}/vendor/datatables.net/js/buttons.print.min.js"></script>
        <script src="{{ asset('argon') }}/vendor/datatables.net/js/dataTables.select.min.js"></script>

        @stack('js')

        <!-- Argon JS -->
        <script src="{{ asset('argon') }}/js/argon.js?v=1.0.0"></script>
    </body>
</html>
