@extends('layouts.xy-centered')
@section('content')
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
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
        <input type="number" name="price" placeholder="precio" min="200" max="1000000" required >
        <select name="engine">
            <option value="unknown">Tipo de combustible</option>
            <option value="Gasolina">Gasolina</option>
            <option value="Diesel">Diesel</option>
            <option value="Eléctrico">Eléctrico</option>
            <option value="Mix">Eléctrico</option>
        </select>
        <input type="number" name="power" min="1" max="1300" placeholder="potencia en cv" required >
        <input type="number" name="kilometers" placeholder="KM" min="0" max="300000" required >
        <input type="number" name="doors" placeholder="puertas" min="1" max="10" required >
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
        <div class="select-box">
            <h4>Tipo de carroceria</h4>
            <select name="category_id">
                <option value="-1">Elige carroceria</option>
                @foreach($categories as $category)
                    <option value={{$category->id}}>{{$category->category}}</option>
                @endforeach
            </select>
        </div>
        <div class="select-box">
            <h4>Marca de coche</h4>
            <select onchange="showCurrent(this.value)" name="brand_id">
                <option value=-1>Elige marca</option>
                @foreach($brands as $brand)
                    <option  value={{$brand->id}}>{{$brand->brand}}</option>
                @endforeach
            </select>
        </div>

        <div class="select-box">
            <h4>Modelo de coche</h4>
            <select id="selectModel" disabled="true" name="brand_id">
                <option value="-1">Elige un modelo</option>
{{--                @foreach($models as $model)--}}
{{--                    <option value={{$model->id}}>{{$model->model}}</option>--}}
{{--                @endforeach--}}
            </select>
        </div>

        <button class="btn" type="submit">Subir</button>
    </form>
</div>

{{--    SCRITPS --}}

    <script>
        function showCurrent(brandId) {

            if (brandId > 0) {

                console.log(brandId);
                $.get(`getModelsByBrandId/${brandId}`, (data, status) => {
                    console.log(data);
                    console.log(status);

                    if ($.isEmptyObject(data)) {
                        $('#selectModel').attr('disabled', true); // works fine
                        $('#selectModel').html('<option value="-1">Elige un modelo</option>'); // works fine

                    } else {
                        let htmlOptions = "";
                        for (let i = 0; i < data.length; i++) {
                            htmlOptions += `<option value=${data[i].id}>${data[i].model}</option>`
                            console.log(data[i]);
                            console.log(htmlOptions);
                        }
                        $('#selectModel').attr('disabled', false); // works fine
                        $('#selectModel').html(htmlOptions);
                    }
                })
            } else {
                $('#selectModel').attr('disabled', true); // works fine
                $('#selectModel').html('<option value="-1">Elige un modelo</option>'); // works fine
            }
        }
    </script>

@endsection
