<!doctype html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- NASA required metadata -->
    <meta name="orgcode" content="{{ env('SITE_ORG') }}">
    <meta name="rno" content="{{ env('SITE_RNO') }}">
    <meta name="content-owner" content="{{ env('SITE_WEBMASTER') }}">
    <meta name="webmaster" content="{{ env('SITE_WEBMASTER') }}">
    <meta name="description" content="{{ env('SITE_DESCRIPTION') }}">

    <!-- CSRF Token -->
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <link rel="shortcut icon" href="{{ asset('favicon.ico') }}">

    <title>{{ config('app.name') }}</title>

    <!-- Styles -->
    <link href="https://cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/4.1.3/css/bootstrap.css" type="text/css"
          rel="stylesheet">

    <link rel="alternate" type="application/atom+xml" title="{{ config('app.name') }}" href="{{ route('rss') }}">
    @vite(['resources/css/app.css', 'resources/js/app.js'])
    <!-- Fonts -->
    <link href="https://fonts.bunny.net/css2?family=Inter:wght@400;600;700&display=swap" rel="stylesheet">
</head>
<body>

        <div class="d-flex" id="wrapper">
            <div class="bg-light border-right" id="sidebar-wrapper">
                @include('layouts.partials.sidebar')
            </div>

            <div id="page-content-wrapper">
                @include('layouts.partials.header')
                <div class="container-fluid my-5 col-11">
                    @yield('content')
                </div>
                @include('layouts.partials.footer')
            </div>
        </div>

<!-- Scripts -->
<script src="{{ mix('js/app.js') }}"></script>

@yield('scripts')
@if(app()->environment('production'))
    @include('layouts.partials.google-analytics')
@endif
@toastr_js
@toastr_render
</body>
</html>
