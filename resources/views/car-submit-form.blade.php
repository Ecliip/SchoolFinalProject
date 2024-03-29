@extends('layouts.xy-centered')
@section('content')
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
    @php
        $year = date('Y');
    @endphp
    {{--        FORMULARIO AGREGAR COCHE        --}}
    <div class="form-container">
    <h2>Añadir un coche <a href="{{route('home.page')}}">supercars.web</a></h2>
    <div class="icon-box">
        <img src="{{asset('images/design/clock.png')}}">
    </div>
    <form class="form form__email" method="post" action="{{route('add.car')}}" enctype="multipart/form-data">
        @csrf
        <input type="number" name="price" placeholder="precio" min="200" max="1000000" required >
        @error('price')
            <span class="text-error">{{$message}}</span>
        @enderror
        <select name="engine">
            <option value="unknown">Tipo de combustible</option>
            <option value="Gasolina">Gasolina</option>
            <option value="Diesel">Diesel</option>
            <option value="Eléctrico">Eléctrico</option>
            <option value="Mix">Mix</option>
        </select>
        @error('engine')
            <span class="text-error">{{$message}}</span>
        @enderror

        <input type="number" name="power_hp" min="1" max="1300" placeholder="potencia en cv" required >
        @error('power_hp')
            <span class="text-error">{{$message}}</span>
        @enderror

        <input type="number" name="kilometers" placeholder="KM" min="0" max="300000" required >
        @error('kilometers')
            <span class="text-error">{{$message}}</span>
        @enderror

        <input type="number" name="doors" placeholder="puertas" min="1" max="10" required >
        @error('doors')
            <span class="text-error">{{$message}}</span>
        @enderror

        <select name="transmission">
            <option value="unknown">Tipo de transmisión</option>
            <option value="Automático">Automática</option>
            <option value="Manual">Manual</option>
        </select>
        @error('transmission')
            <span class="text-error">{{$message}}</span>
        @enderror

        <select name="traccion">
            <option value="unknown">Tipo de tracción</option>
            <option value="Fwd">Delantera</option>
            <option value="Rwd">Rwd</option>
            <option value="Awd">Awd</option>
            <option value="x_4wd">x_4wd</option>
            <option value="x_4x4">4x4</option>
        </select>
        @error('traccion')
            <span class="text-error">{{$message}}</span>
        @enderror
        <input type="number" name="year" placeholder="año" min="1900" max="{{$year}}" required >
        @error('year')
            <span class="text-error">{{$message}}</span>
        @enderror

        <input type="hidden" name="isSold" value=0>

        <div class="select-box">
            <h4>Tipo de carroceria</h4>
            <select name="category_id">
                <option value="-1">Elige carroceria</option>
                @foreach($categories as $category)
                    <option value={{$category->id}}>{{$category->cat_name}}</option>
                @endforeach
            </select>
            @error('category_id')
                <span class="text-error">{{$message}}</span>
            @enderror
        </div>
        <div class="select-box">
            <h4>Marca de coche</h4>
            <select onchange="showCurrent(this.value)" name="brand_id">
                <option value=-1>Elige marca</option>
                @foreach($brands as $brand)
                    <option  value={{$brand->id}}>{{$brand->brand_name}}</option>
                @endforeach
            </select>
            @error('brand_id')
                <span class="text-error">{{$message}}</span>
            @enderror
        </div>
        <div class="select-box">
            <h4>Modelo de coche</h4>
            <select id="selectModel" disabled="true" name="car_model_id">
                <option value="-1">Elige un modelo</option>
            </select>
            @error('car_model_id')
                <span class="text-error">{{$message}}</span>
            @enderror
        </div>
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
            @error('isNew')
                <span class="text-error">{{$message}}</span>
            @enderror
        </div>
        <div class="select-box">
            <label for="imageInput">Elegir una foto</label>
            <input type="file" name="image" id="imageInput">
            @error('image')
                <span class="text-error">{{$message}}</span>
            @enderror
        </div>
        <button class="btn" type="submit">Subir</button>
    </form>
</div>
    {{--        SCRITPS     --}}
    <script>
        function showCurrent(brandId) {
            if (brandId > 0) { // comprobar que el ID sea mayor de 1
                $.get(`getModelsByBrandId/${brandId}`, (data, status) => { // AJAX con JQuery
                    // comprobar si hemos recibido la respuesta alguna del servidor
                    if ($.isEmptyObject(data)) {
                        $('#selectModel').attr('disabled', true); // bloqueamos el boton
                        $('#selectModel').html('<option value="-1">Elige un modelo</option>'); // generar HTML
                    } else { // si la matriz no está vacia, generomos HTML con sus opciones
                        let htmlOptions = "";
                        htmlOptions += `<option value=-1>Elige un modelo</option>`
                        for (let i = 0; i < data.length; i++) {
                            htmlOptions += `<option value=${data[i].id}>${data[i].model_name}</option>`
                        }
                        $('#selectModel').attr('disabled', false); // desbloquear el botón
                        $('#selectModel').html(htmlOptions);
                    }
                })
            } else { // si el valor recibido es menor que cero o un cero. Bloqueamos el botón
                $('#selectModel').attr('disabled', true);
                $('#selectModel').html('<option value="-1">Elige un modelo</option>');
            }
        }
    </script>
@endsection
