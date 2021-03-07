@extends('layouts.admin')
@section('content')
    @if(session('success'))
        <div class="notification__success">
            {{session('success')}}
        </div>
    @endif
    <div class="the-wrapper">
        <div class="wrapped-col">
            <h2>Añadir una categoria</h2>
            <form class="row g-3" action="{{route('add.category')}}" method="POST" enctype="multipart/form-data">
                @csrf
                <div class="mb-3">
                    <label for="categoryField" class="form-label">Categoria</label>
                    <input type="text" name="category" class="form-control" id="categoryField">
                    @error('category')
                    <span class="text-danger">{{$message}}</span>
                    @enderror
                </div>
                <div class="mb-3">
                    <label for="exampleFormControlTextarea1" class="form-label">Descripcion</label>
                    <textarea name="description" class="form-control" id="exampleFormControlTextarea1" rows="3"></textarea>
                    @error('description')
                    <span class="text-danger">{{$message}}</span>
                    @enderror
                </div>
                <div class="mb-3">
                    <label for="formFile" class="form-label">Selecciona una foto</label>
                    <input class="form-control" name="photo" type="file" id="formFile">
                    @error('photo')
                    <span class="text-danger">{{$message}}</span>
                    @enderror
                </div>
                <div class="col-auto">
                    <button type="submit" class="btn btn-primary mb-3">Subir</button>
                </div>
            </form>
        </div>

        <div class="wrapped-col">
            <h2>Añadir una marca</h2>
            <form class="row g-3" action="{{route('add.brand')}}" method="POST" enctype="multipart/form-data">
                @csrf
                <div class="mb-3">
                    <label for="categoryField" class="form-label">Marca</label>
                    <input type="text" name="brand" class="form-control" id="categoryField">
                    @error('brand')
                    <span class="text-danger">{{$message}}</span>
                    @enderror
                </div>
                <div class="mb-3">
                    <label for="exampleFormControlTextarea1" class="form-label">Descripcion</label>
                    <textarea name="description" class="form-control" id="exampleFormControlTextarea1" rows="3"></textarea>
                    @error('description')
                    <span class="text-danger">{{$message}}</span>
                    @enderror
                </div>
                <div class="mb-3">
                    <label for="formFile" class="form-label">Selecciona una foto</label>
                    <input class="form-control" name="photo" type="file" id="formFile">
                    @error('photo')
                    <span class="text-danger">{{$message}}</span>
                    @enderror
                </div>
                <div class="col-auto">
                    <button type="submit" class="btn btn-primary mb-3">Subir</button>
                </div>
            </form>
        </div>

        <div class="wrapped-col">
            <h2>Añadir un Modelo</h2>
            <form class="row g-3" action="{{route('add.car-model')}}" method="POST" enctype="multipart/form-data">
                @csrf
                <div class="mb-3">
                    <label for="modelName" class="form-label">Model</label>
                    <input type="text" name="model" class="form-control" id="modelName">
                    @error('model')
                    <span class="text-danger">{{$message}}</span>
                    @enderror
                </div>
                <div class="mb-3">
                    <label for="modelDescription" class="form-label">Descripcion</label>
                    <textarea name="description" class="form-control" id="modelDescription" rows="3"></textarea>
                    @error('description')
                        <span class="text-danger">{{$message}}</span>
                    @enderror
                </div>
                <div class="mb-3">
                    <label for="selectCategory" class="form-label">Elige tipo de coche</label>
                    <select class="form-select" name="theCategory" id="selectCategory" aria-label="Elegir una categoria">
                        <option selected value=-1>Elige tipo de coche</option>
                        @foreach($categories as $category)
                        <option value={{$category->id}}>{{$category->category}}</option>
                        @endforeach
                        @error('theCategory')
                            <span class="text-danger">{{$message}}</span>
                        @enderror
                    </select>
                </div>
                <div class="mb-3">
                    <label for="selectModel" class="form-label">Elige marca</label>
                    <select class="form-select" name="theBrand" id="selectModel" aria-label="Elegir una marca">
                        <option selected value=-1>Elige marca deseada</option>
                        @foreach($brands as $brand)
                            <option value={{$brand->id}}>{{$brand->brand}}</option>
                        @endforeach
                        @error('theBrand')
                            <span class="text-danger">{{$message}}</span>
                        @enderror
                    </select>
                </div>
                <div class="mb-3">
                    <label for="formFile" class="form-label">Selecciona una foto</label>
                    <input class="form-control" name="photo" type="file" id="formFile">
                    @error('photo')
                        <span class="text-danger">{{$message}}</span>
                    @enderror
                </div>
                <div class="col-auto">
                    <button type="submit" class="btn btn-primary mb-3">Subir</button>
                </div>
            </form>
        </div>
    </div>



{{--// TODO considering to delete--}}
{{--    <form class="form form--dashboard" action="{{route('add.category')}}" method="POST" enctype="multipart/form-data">--}}
{{--        @csrf--}}
{{--        <input type="text" name="category" placeholder="category name">--}}
{{--        @error('category')--}}
{{--            <span class="text-danger">{{$message}}</span>--}}
{{--        @enderror--}}
{{--        <input type="file" name="photo" id="photo_input" style="width: 20rem," placeholder="category">--}}
{{--        @error('photo')--}}
{{--        <span class="text-danger">{{$message}}</span>--}}
{{--        @enderror--}}
{{--        <textarea name="description"></textarea>--}}
{{--        @error('description')--}}
{{--        <span class="text-danger">{{$message}}</span>--}}
{{--        @enderror--}}

{{--        <button type="submit">Submit</button>--}}
{{--    </form>--}}

    <div class="the-wrapper">
        <div class="wrapped-col">
            <h2>Categorias</h2>
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
            <div class="pagination-wrapper">
{{--                {{$categories->links()}}--}}
            </div>

        </div>


        @if($brands)
        <div class="wrapped-col">
            <h2>Marcas</h2>
            @foreach($brands as $brand)
                <div class="category__item">
                    <h3 class="category__name">{{$brand->brand}}</h3>
                    <div class="image-box-sm">
                        <img src="{{asset($brand->photo_sm)}}">
                    </div>
                    <div class="buttons-group">
                        <a href="#">Edit</a>
                        <a href="{{route('delete.brand', $brand->id)}}">Delete</a>
                    </div>
                </div>
            @endforeach
{{--            {{$brands->links()}}--}}
        </div>
        @endif
        @if($carModels)
            <div class="wrapped-col">
                <h2>Modelos</h2>
                @foreach($carModels as $carModel)
                    <div class="category__item">
                        <h3 class="category__name">{{$carModel->carModel}}</h3>
                        <div class="image-box-sm">
                            <img src="{{asset($carModel->photo_sm)}}">
                        </div>
                        <div>Categoria: {{$carModel->category->category}}</div>
                        <div>Marca: {{$carModel->brand->brand}}</div>
                        <div class="buttons-group">
                            <a href="#">Edit</a>
                            <a href="{{route('delete.car-model', $carModel->id)}}">Delete</a>
                        </div>
                    </div>
                @endforeach
{{--                {{$carModels->links()}}--}}
            </div>
        @endif
    </div>
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
