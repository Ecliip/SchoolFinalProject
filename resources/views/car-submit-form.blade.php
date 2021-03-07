@extends('layouts.xy-centered')
@section('content')
    @php
        $year = date('Y');
    @endphp
    <div class="form-container">
    <h2>Añadir un coche <a href="{{route('home.page')}}">supercars.web</a></h2>
    <div class="icon-box">
        <img src="{{asset('images/design/clock.png')}}">
    </div>
    <form class="form form__email" method="post" action="{{route('add.car')}}" enctype="multipart/form-data">
        @csrf
        <input type="number" name="price" placeholder="precio" required >
        <select name="engine">
            <option value="unknown">Tipo de combustible</option>
            <option value="Gasolina">Gasolina</option>
            <option value="Diesel">Diesel</option>
            <option value="Eléctrico">Eléctrico</option>
            <option value="Mix">Eléctrico</option>
        </select>
        <input type="number" name="power" placeholder="potencia" required >
        <input type="number" name="kilometers" placeholder="KM" required >
        <input type="number" name="doors" placeholder="puertas" max="10" required >
        <select name="transmission">
            <option value="unknown">Tipo de transmisión</option>
            <option value="Automático">Automático</option>
            <option value="Manual">Manual</option>
        </select>
        <input type="number" name="year" placeholder="año" min="1900" max="{{$year}}" required >
        <div class="radio-box">
            <h4>Es nuevo o usado</h4>
            <div>
                <label for="isNewTrue">nuevo</label>
                <input type="radio" name="isNew" value=1 id="isNewTrue">
            </div>
            <div>
                <label for="isNewFalse">usado</label>
                <input type="radio" name="isNew" value=0 id="isNewFalse">
            </div>
        </div>
{{--        TODO have to add list for available categories, brands and models--}}
        <input type="hidden" name="isSold" value=0>
        <button class="btn" type="submit">Subir</button>
    </form>
</div>
@endsection
