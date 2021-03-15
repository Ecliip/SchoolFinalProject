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
                    @foreach($car as $c_item)
                        <tr class="tr">
                            <td class="ti-photo"><div class="image-box-sm"><img src="{{asset($c_item->photo_sm)}}"></div></td>
                            <td class="ti-carName">{{$c_item->brand->brand_name}} {{$c_item->carModel->model_name}}</td>
                            <td>{{$c_item->price}}</td>
                            <td><a href="{{route('delete.cart', $c_item->id)}}">Eliminar</a></td>
                        </tr>
                    @endforeach
                @endforeach


        </tbody>
    </table>
@endsection
