@extends('layouts.classic')
@section('content')
    @foreach($carsArr as $car)
        @foreach($car as $c_item)
            {{$c_item->id}}
        @endforeach
    @endforeach
@endsection
