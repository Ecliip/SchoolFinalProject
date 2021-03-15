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
{{--                    @foreach($car as $c_item)--}}
                        <tr class="tr">
                            <td class="ti-photo"><div class="image-box-sm"><img src="{{asset($car->photo_sm)}}"></div></td>
                            <td class="ti-carName">{{$car->brand->brand_name}} {{$car->carModel->model_name}}</td>
                            <td>{{$car->price}}</td>
                            <td><a class="a_delete" href="{{route('delete.cart', $car->id)}}">Eliminar</a></td>
                        </tr>
{{--                    @endforeach--}}
                @endforeach
        </tbody>
    </table>
        <span class="totalPrice">The total price is: {{$totalPrice}}</span>
@endsection
