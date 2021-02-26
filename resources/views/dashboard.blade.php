@extends('layouts.admin')
@section('content')
    <p>Dashboard page</p>
@endsection





{{--PREV DESIGN--}}
{{--<!doctype html>--}}
{{--<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">--}}
{{--<head>--}}
{{--    <!-- Required meta tags -->--}}
{{--    <meta charset="utf-8">--}}
{{--    <meta name="viewport" content="width=device-width, initial-scale=1">--}}
{{--    <meta name="csrf-token" content="{{ csrf_token() }}">--}}
{{--    <title>{{ config('app.name', 'Laravel') }}</title>--}}
{{--        <link rel="stylesheet" href="{{ mix('css/app.css') }}">--}}
{{--</head>--}}
{{--<body>--}}

{{--<nav class="nav">--}}
{{--    <div class="left">--}}
{{--        <h1>Logo</h1>--}}
{{--    </div>--}}
{{--    <div class="right">--}}
{{--        <p class="name">{{Auth::user()->name}}</p>--}}
{{--        <a href="{{ url('user/profile') }}" class="nav-link">Profile</a>--}}
{{--        <a href="{{ route('user.logout') }}" class="nav-link">Logout</a>--}}
{{--    </div>--}}
{{--</nav>--}}

{{--<!-- Bootstrap JS -->--}}
{{--</body>--}}
{{--</html>--}}






{{--ORIGINAL LARAVEL CODE--}}
{{--<x-app-layout>--}}
{{--    <x-slot name="header">--}}
{{--        <h2 class="font-semibold text-xl text-gray-800 leading-tight">--}}
{{--            {{ __('Dashboard') }}--}}
{{--        </h2>--}}
{{--    </x-slot>--}}

{{--    <div class="py-12">--}}
{{--        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">--}}
{{--            <div class="bg-white overflow-hidden shadow-xl sm:rounded-lg">--}}
{{--                <x-jet-welcome />--}}
{{--            </div>--}}
{{--        </div>--}}
{{--    </div>--}}
{{--</x-app-layout>--}}
