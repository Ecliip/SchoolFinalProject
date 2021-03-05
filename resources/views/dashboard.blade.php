@extends('layouts.admin')
@section('content')
    @if(session('success'))
        <div class="notification__success">
            {{session('success')}}
        </div>
    @endif
    <h2>Añadir una categoria</h2>
    <form class="row g-3" action="{{route('add.category')}}" method="POST" enctype="multipart/form-data">
        @csrf
        <div class="mb-3">
            <label for="categoryField" class="form-label">Email</label>
            <input type="text" name="category" class="form-control" id="categoryField">
        </div>
        <div class="mb-3">
            <label for="exampleFormControlTextarea1" class="form-label">Descripcion</label>
            <textarea name="description" class="form-control" id="exampleFormControlTextarea1" rows="3"></textarea>
        </div>
        <div class="mb-3">
            <label for="formFile" class="form-label">Default file input example</label>
            <input class="form-control" name="photo" type="file" id="formFile">
        </div>
        <div class="col-auto">
            <button type="submit" class="btn btn-primary mb-3">Subir</button>
        </div>
    </form>



    <form class="form form--dashboard" action="{{route('add.category')}}" method="POST" enctype="multipart/form-data">
        @csrf
        <input type="text" name="category" placeholder="category name">
        @error('category')
            <span class="text-danger">{{$message}}</span>
        @enderror
        <input type="file" name="photo" id="photo_input" style="width: 20rem," placeholder="category">
        @error('photo')
        <span class="text-danger">{{$message}}</span>
        @enderror
        <textarea name="description"></textarea>
        @error('description')
        <span class="text-danger">{{$message}}</span>
        @enderror

        <button type="submit">Submit</button>
    </form>

    <div class="category">
        <h2>Puede gestionar todas las categorias disponibles aqui</h2>
        @foreach($categories as $category)
        <div class="category__item">
            <h3 class="category__name">{{$category->category}}</h3>
            <div class="image-box-sm">
                <img src="{{asset($category->photo_sm)}}">
            </div>
            <div class="buttons-group">
                <a href="#">Edit</a>
                <a href="{{route('delete.category', $category->id)}}">Delete</a>
            </div>
        </div>
        @endforeach
    </div>
    {{$categories->links()}}
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
