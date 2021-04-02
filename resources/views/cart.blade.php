@extends('layouts.classic')
@section('content')
    <table>
        <thead>
            <tr>
                <td>Foto</td>
                <td>Coche</td>
                <td>Precio</td>
                <td>Eliminar de la lista</td>
            </tr>
        </thead>
        <tbody>
                @foreach($carsArr as $car)
                        <tr class="tr">
                            <td class="ti-photo">
                                <a href="{{route('info.car', $car->id)}}">
                                    <div class="image-box-sm"><img src="{{asset($car->photo_sm)}}" alt="{{$car->brand->brand_name}} {{$car->carModel->model_name}}"></div>
                                </a>
                            </td>
                            <td class="ti-carName">{{$car->brand->brand_name}} {{$car->carModel->model_name}}</td>
                            <td>${{$car->price}}</td>
                            <td><a class="a_delete" href="{{route('delete.cart', $car->id)}}">Eliminar</a></td>
                        </tr>
                @endforeach
        </tbody>
    </table>
        <div class="totalPrice">El precio total: ${{$totalPrice}}</div>
@endsection
