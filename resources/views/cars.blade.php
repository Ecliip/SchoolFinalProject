@extends('layouts.classic')
@section('content')

    <div class="container-horizontal">
        <aside class="aside-col">
            <form method="get" action="{{route('all.car')}}">
                <ul>
                    <li>Carroceria:
                        <div>
                            <select onchange="getCarsByCategory(this.value)" name="category_id">
                                <option value=-1>Elige carroceria</option>
                                @foreach($categories as $category)
                                    <option value={{$category->id}}>{{$category->cat_name}}</option>
                                @endforeach
                            </select>
                        </div>
                    </li>
                    <li>Precio:
                        <div>
                            <select name="precio">
                                <option value="-1">Elige precio</option>
                                <option value="3000 - 4999">3000 - 4999</option>
                                <option value="5000 - 9999">5000 - 9999</option>
                                <option value="10000 - 19999">10000 - 19999</option>
                                <option value=">20000">>20000</option>
                            </select>
                        </div>
                    </li>
                    <li>Potencia CV
                        <div>
                            <select name="cvs">
                                <option value="-1">Elige potencia en cv</option>
                                <option value="50 - 99">50 - 99</option>
                                <option value="100 - 199">100 - 199</option>
                                <option value="200 - 499">200 - 499</option>
                                <option value=">500">>500</option>
                            </select>
                        </div>
                    </li>
                    <li>Combustible:
                        <div>
                            <select name="engine">
                                <option value="unknown">Tipo de combustible</option>
                                <option value="Gasolina">Gasolina</option>
                                <option value="Diesel">Diesel</option>
                                <option value="Eléctrico">Eléctrico</option>
                                <option value="Mix">Mix</option>
                            </select>
                        </div>
                    </li>
                    <li>Kilómetros:
                        <div>
                            <select name="engine">
                                <option value="unknown">Kilometraje</option>
                                <option value="0">0</option>
                                <option value=">1">1</option>
                                <option value=">10000">10000</option>
                                <option value="30000">30000</option>
                            </select>
                        </div>
                    </li>
                    <li>puertas:
                        <div>
                            <select name="engine">
                                <option value="unknown">puertas</option>
                                <option value=">1">1</option>
                                <option value=">2">2</option>
                                <option value=">5">>5</option>
                            </select>
                        </div>
                    </li>
                    <li>transmisión:
                        <div>
                            <select name="transmission">
                                <option value="unknown">Tipo de transmisión</option>
                                <option value="Automático">Automática</option>
                                <option value="Manual">Manual</option>
                            </select>
                        </div>
                    </li>
                    <li>tracción:
                        <div>
                            <select name="traccion">
                                <option value="unknown">Tipo de tracción</option>
                                <option value="Fwd">Delantera</option>
                                <option value="Rwd">Rwd</option>
                                <option value="Awd">Awd</option>
                                <option value="x_4wd">x_4wd</option>
                                <option value="x_4x4">4x4</option>
                            </select>
                        </div>
                    </li>
                </ul>
                <button type="submit">Aplicar</button>
            </form>


        </aside>
        <div class="big-col">
{{--            {{$request}}--}}
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
                                <a href="{{route('add.cart', $car->id)}}">Agregar a cesta...</a>
                                <a href="{{route('edit.car', $car->id)}}">Editar...</a>
                                <a href="{{route('delete.car', $car->id)}}">Delete...</a>
                            @endauth
                            <a href="{{route('info.car', $car->id)}}">Ver...</a>
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

    function getCarsByCategory(val) {
        let carsContainer = $('#allCars');
        if (val > 0) {
            console.log(val);

            $.get(`findCars/?category_id=${val}`, (data, status) => {
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
        }
    };

</script>
