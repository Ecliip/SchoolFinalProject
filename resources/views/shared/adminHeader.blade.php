<!doctype html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>{{ config('app.name', 'Laravel') }}</title>
{{--    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0-beta2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-BmbxuPwQa2lc/FVzBcNJ7UAyJxM6wuqIj61tLrc4wSX0szH/Ev+nYRRuWlolflfl" crossorigin="anonymous">--}}
    <link rel="stylesheet" href="{{ mix('css/app.css') }}">
    <script src="{{ mix('js/app.js') }}" defer></script>
</head>
<body>
    <header>
            <nav class="nav">
                <div class="center">
                    <a href="{{route('home.page')}}">Supercars.web</a>
                </div>
                    <div class="right">
                        <p class="name">{{Auth::user()->name}}</p>
                        <a href="{{ url('user/profile') }}" class="nav-link">Profile</a>
                        <a href="{{ route('user.logout') }}" class="nav-link">Logout</a>
                    </div>
            </nav>
    </header>
    <div class="admin-container">
