@extends('layouts.classic')
@section('content')

    <div class="container-horizontal">
        <aside class="aside-col">
                <ul>
                    <li>Carroceria:
                        <div>
                            <select id="category" name="category_id">
                                <option value=-1>Elige carroceria</option>
                                @foreach($categories as $category)
                                    <option value={{$category->id}}>{{$category->cat_name}}</option>
                                @endforeach
                            </select>
                        </div>
                    </li>
                    <li>Marca:
                        <div>
                            <select id="brand" name="brand_id">
                                <option value=-1>Elige marca</option>
                                @foreach($brands as $brand)
                                    <option  value={{$brand->id}}>{{$brand->brand_name}}</option>
                                @endforeach
                            </select>
                        </div>
                    </li>
                    <li>Modelo:
                        <div>
                            <select id="model"  name="model_id">
                                <option value=-1>Elige modelo</option>
                                @foreach($models as $model)
                                    <option  value={{$model->id}}>{{$model->model_name}}</option>
                                @endforeach
                            </select>
                        </div>
                    </li>
                </ul>
                <button type="submit" onclick="getCarsByParams()">Buscar</button>
        </aside>
        <div class="big-col" style="">
            <a class="add_car_btn" href="{{route('submit-form.car')}}">Añadir un coche</a>
            <div id="allCars">
                @foreach($cars as $car)
                    <div class="car">
                        <div class="image-box-sm">
                            <img src="{{asset($car->photo_sm)}}" alt="{{$car->brand->brand_name.' '.$car->carModel->model_name}}">
                        </div>

                        <div class="car__body">
                            <h3>{{$car->brand->brand_name.' '.$car->carModel->model_name}}</h3>
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
                                    <li>
                                        <span class="car__mini-title">Combustible: </span>
                                        <span class="car__data">{{$car->engine}}</span>
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
                            @auth
                                <a href="{{route('add.cart', $car->id)}}">Agregar a cesta</a>
                                <a href="{{route('edit.car', $car->id)}}">Editar</a>
                                <a href="{{route('delete.car', $car->id)}}">Eliminar</a>
                            @endauth
                            <a href="{{route('info.car', $car->id)}}">Info</a>
                        </div>
                    </div>
                @endforeach
            </div>

            <div class="pagination" style="margin: 2rem; display: flex">
                <span style="margin: auto">{{$cars->links()}}</span>
            </div>
            <a class="add_car_btn" href="{{route('submit-form.car')}}">Añadir un coche</a>
        </div>
    </div>


@endsection
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
<script>

    function getCarsByParams(val) {
        let carsContainer = $('#allCars');
        let categoryObj = {'name': 'category_id', 'value': parseInt($('#category')[0].value) };
        let modelObj = {'name': 'model_id', 'value': parseInt($('#model')[0].value) };
        let brandObj = {'name': 'brand_id', 'value': parseInt($('#brand')[0].value) };
        let paramQuery = '';

        console.log(categoryObj, brandObj, modelObj);
        if (categoryObj.value > 0) {
            if(!paramQuery) {
                paramQuery += '?'
            } else {
                paramQuery += '&';
            }
            paramQuery += `category_id=${categoryObj.value}`
        }
        if (modelObj.value > 0) {
            if(!paramQuery) {
                paramQuery += '?'
            } else {
                paramQuery += '&';
            }
            paramQuery += `car_model_id=${modelObj.value}`
        }
        if (brandObj.value > 0) {
            if(!paramQuery) {
                paramQuery += '?'
            } else {
                paramQuery += '&';
            }
            paramQuery += `brand_id=${brandObj.value}`
        }
                console.log(val);
        if (paramQuery) {
            $.get(`findCars/${paramQuery}`, (data, status) => {
                console.log(paramQuery);
                paramQuery = '';
                console.log(paramQuery);
                console.log(data);
                const carArr = data.data;
                if ($.isEmptyObject(data.data)) {
                    carsContainer.html( '<h1>No encontrado ningún coche</h1>');
                } else {
                    let htmlResponse = "";

                    for (let i = 0; i < carArr.length; i++) {
                        let baseUrl = "{{asset('/')}}";
                        htmlResponse += `                    <div class="car">
                        <div class="image-box-sm">
                            <img src="`+ baseUrl + carArr[i].photo_sm +`" alt="{{$car->brand->brand_name.' '.$car->carModel->model_name}}">
                        </div>

                        <div class="car__body">
                            <h3>{{$car->brand->brand_name.' '.$car->carModel->model_name}}</h3>
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
                            <span class="car__data">`+ carArr[i].price +`</span>
                                    </li>
                                    <li>
                                        <span class="car__mini-title">Potencia CV: </span>
                                        <span class="car__data">`+ carArr[i].power_hp +`</span>
                                    </li>
                                    <li>
                                        <span class="car__mini-title">Combustible: </span>
                                        <span class="car__data">`+ carArr[i].engine +`</span>
                                    </li>
                                </div>
                                <div>
                                    <li>
                                        <span class="car__mini-title">Kilómetros: </span>
                                        <span class="car__data">`+ carArr[i].kilometers +`</span>
                                    </li>
                                    <li>
                                        <span class="car__mini-title">puertas: </span>
                                        <span class="car__data">`+ carArr[i].dors +`</span>
                                    </li>
                                    {{--                    TODO fix automatico to Automatica--}}
                        <li>
                            <span class="car__mini-title">transmisión: </span>
                            <span class="car__data">`+ carArr[i].transmission +`</span>
                                    </li>
                                    <li>
                                        <span class="car__mini-title">tracción: </span>
                                        <span class="car__data">`+ carArr[i].traccion +`</span>
                                    </li>
                                </div>
                            </ul>
                            @auth
                        <a href="`+`cart/add/${carArr[i].id}    ` +`">Agregar a cesta...</a>
                                <a href="{{route('edit.car', $car->id)}}">Editar...</a>
                                <a href="{{route('delete.car', $car->id)}}">Delete...</a>
                            @endauth
                        <a href="`+`car/info/${carArr[i].id}` +`">Ver...</a>
                        </div>
                    </div>
`;
                        console.log(carArr[i]);
                        // console.log(htmlResponse);
                    }
                    carsContainer.html(htmlResponse);
                }

            });
        } else {
            location.reload();
        }
            }
</script>
