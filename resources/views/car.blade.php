@extends('layouts.classic')
@section('content')
    <a class="add_car_btn" href="{{route('all.car')}}">Ver todos los coches</a>
        <div class="car single-car">
            <h3>{{$car->brand->brand_name.' '.$car->carModel->model_name}}</h3>
            <div class="car__cols">
                <div class="image-box-md">
                    <img src="{{asset($car->photo_md)}}" alt="{{$car->brand->brand_name.' '.$car->carModel->model_name}}">
                </div>
                <div class="car__body">

                    <ul>
                        <div>
                            <li>
                                <span class="car__mini-title">Carroceria: </span>
                                <span class="car__data">{{ucfirst($car->category->cat_name)}}</span>
                            </li>
                            <li>
                                <span class="car__mini-title">Coche: </span>
                                <span class="car__data">{{ucfirst($car->brand->brand_name).' '.ucfirst($car->carModel->model_name)}}</span>
                            </li>
                            {{--                TODO: find out how to format prices--}}
                            <li>
                                <span class="car__mini-title">Precio: </span>
                                <span class="car__data">{{$car->price}}</span>
                            </li>
                            <li>
                                <span class="car__mini-title">Potencia CV: </span>
                                <span class="car__data">{{$car->power_hp}}</span>
                            </li>
                        </div>
                        <div>
                            <li>
                                <span class="car__mini-title">Kilómetros: </span>
                                <span class="car__data">{{$car->kilometers}}</span>
                            </li>
                            <li>
                                <span class="car__mini-title">puertas: </span>
                                <span class="car__data">{{$car->doors}}</span>
                            </li>
                            {{--                    TODO fix automatico to Automatica--}}
                            <li>
                                <span class="car__mini-title">transmisión: </span>
                                <span class="car__data">{{$car->transmission}}</span>
                            </li>
                            <li>
                                <span class="car__mini-title">tracción: </span>
                                <span class="car__data">{{$car->traccion}}</span>
                            </li>
                        </div>
                    </ul>
                </div>
            </div>
            <p>{{$car->description}}</p>
        </div>
        <a class="add_car_btn" href="{{route('all.car')}}">Ver todos los coches</a>
@endsection
