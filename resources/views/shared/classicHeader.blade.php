<!doctype html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>{{ config('app.name', 'Laravel') }}</title>
    <link rel="stylesheet" href="{{ mix('css/app.css') }}">
    <script src="{{ mix('js/app.js') }}" defer></script>
</head>
<body>
    <header>
        @if (Route::has('login'))
            <nav class="nav">
                <div class="center">
                    <a class="logo" href="{{route('home.page')}}"><span class="prefix">Supercars</span><span class="sufix">.web</span></a>
                    <a href="{{route('all.car')}}">Coches nuevos</a>
                    <a href="{{route('all.car')}}">Coches usados</a>
                    <a href="{{route('submit-form.car')}}">Vender mi coche</a>
                </div>
                    <div class="right">
                @auth
                    <p class="name">{{Auth::user()->name}}</p>
                    <a href="{{ url('/dashboard') }}" class="nav-link">Configuración</a>
                    <a href="{{ route('user.logout') }}" class="nav-link">Salir</a>
                    <a href="{{route('all.cart')}}" class="nav-link">Mi Carrito</a>
                @else
                    <a href="{{ route('login') }}" class="nav-link">Log in</a>
                    @if (Route::has('register'))
                    <a href="{{ route('register') }}" class="nav-link">Register</a>
                    @endif
                    </div>
                @endauth
            </nav>
        @endif
        <div class="banner">

        </div>
    </header>
    <div class="container">
