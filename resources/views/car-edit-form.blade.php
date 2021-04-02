@extends('layouts.xy-centered')
@section('content')
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
    @php
        $year = date('Y');
    @endphp
    <div class="form-container">
    <h2>Añadir un coche <a href="{{route('home.page')}}">supercars.web</a></h2>
    <div class="icon-box">
        <img src="{{asset('images/design/clock.png')}}" alt="logo">
    </div>
    <form class="form form__email" method="post" action="{{route('update.car', $car->id)}}" enctype="multipart/form-data">
        @csrf
        <input type="number" name="price" placeholder="precio" min="200" max="1000000" required  value="{{$car->price}}">
        @error('price')
            <span class="text-error">{{$message}}</span>
        @enderror
        <select name="engine">

            <option selected value="{{$car->engine}}">{{$car->engine}}</option>
            <option value="Gasolina">Gasolina</option>
            <option value="Diesel">Diesel</option>
            <option value="Eléctrico">Eléctrico</option>
            <option value="Mix">Mix</option>
        </select>
        @error('engine')
            <span class="text-error">{{$message}}</span>
        @enderror

        <input type="number" name="power_hp" min="1" max="1300" placeholder="potencia en cv" value="{{$car->power_hp}}" required >
        @error('power_hp')
            <span class="text-error">{{$message}}</span>
        @enderror

        <input type="number" name="kilometers" placeholder="KM" min="0" max="300000" value="{{$car->kilometers}}" required >
        @error('kilometers')
            <span class="text-error">{{$message}}</span>
        @enderror

        <input type="number" name="doors" placeholder="puertas" min="1" max="10" value="{{$car->doors}}" required >
        @error('doors')
            <span class="text-error">{{$message}}</span>
        @enderror

        <select name="transmission">
            <option selected value="{{$car->transmission}}">{{$car->transmission}}</option>
            <option value="Automático">Automática</option>
            <option value="Manual">Manual</option>
        </select>
        @error('transmission')
            <span class="text-error">{{$message}}</span>
        @enderror

        <select name="traccion">
            <option selected value="{{$car->traccion}}">{{$car->traccion}}</option>
            <option value="Fwd">Delantera</option>
            <option value="Rwd">Rwd</option>
            <option value="Awd">Awd</option>
            <option value="x_4wd">x_4wd</option>
            <option value="x_4x4">4x4</option>
        </select>
        @error('traccion')
            <span class="text-error">{{$message}}</span>
        @enderror
        <input type="number" name="year" placeholder="año" min="1900" max="{{$year}}" value="{{$car->year}}" required >
        @error('year')
            <span class="text-error">{{$message}}</span>
        @enderror

        <div class="select-box">
            <h4>Tipo de carroceria</h4>
            <select name="category_id">
                <option selected value="{{$car->category->id}}">{{$car->category->cat_name}}</option>
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
                <option id="selectedBrand" selected value="{{$car->brand->id}}">{{$car->brand->brand_name}}</option>
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
                <option value="{{$car->carModel->id}}">{{$car->carModel->model_name}}</option>
            </select>
            @error('car_model_id')
                <span class="text-error">{{$message}}</span>
            @enderror
        </div>
        <div class="select-box">
            <label for="imageInput">Elegir una foto</label>
            <input type="file" name="photo" id="imageInput">
            @error('image')
                <span class="text-error">{{$message}}</span>
            @enderror
        </div>

        <input type="hidden" name="old_photo_sm" value="{{$car->photo_sm}}">
        <input type="hidden" name="old_photo_md" value="{{$car->photo_md}}">

        <button class="btn" type="submit">Subir</button>
    </form>
</div>
{{--    SCRITPS --}}
    <script>
            const selectedBrandId = $("#selectedBrand").attr('value')
            $.get(`getModelsByBrandId/${selectedBrandId}`, (data, status) => {
                    console.log(data);
                    let htmlOptions = "";
                    for (let i = 0; i < data.length; i++) {
                        htmlOptions += `<option value=${data[i].id}>${data[i].model_name}</option>`
                    }
                    $('#selectModel').attr('disabled', false); // works fine
                    $('#selectModel').html(htmlOptions);
            })

        function showCurrent(brandId) {
            if (brandId > 0) {
                $.get(`getModelsByBrandId/${brandId}`, (data, status) => {
                    console.log(data);
                    console.log(brandId);
                    if ($.isEmptyObject(data)) {
                        $('#selectModel').attr('disabled', true); // works fine
                        $('#selectModel').html('<option value="-1">Elige un modelo</option>'); // works fine
                    } else {
                        let htmlOptions = "";
                        htmlOptions += `<option value=-1>Elige un modelo</option>`
                        for (let i = 0; i < data.length; i++) {
                            htmlOptions += `<option value=${data[i].id}>${data[i].model_name}</option>`
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
