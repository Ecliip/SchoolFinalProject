@extends('layouts.admin')
@section('content')
    {{--        INICIO MENSAJE DE EXITO      --}}
    @if(session('success'))
        <div class="notification__success">
            {{session('success')}}
        </div>
    @endif
    {{--        FIN MENSAJE DE EXITO      --}}

    <div class="the-wrapper">
{{--        INICIO FORMULARIO CARROCERIAS      --}}
        <div class="wrapped-col">
            <h2>Añadir una categoria</h2>
            <form class="form" action="{{route('add.category')}}" method="POST" enctype="multipart/form-data">
                @csrf
                <div class="mb-3">
                    <label for="categoryField" class="form-label">Categoria</label>
                    <input type="text" name="cat_name" class="form-control" id="categoryField">
                    @error('cat_name')
                    <span class="text-danger">{{$message}}</span>
                    @enderror
                </div>
                <div class="mb-3">
                    <label for="exampleFormControlTextarea1" class="form-label">Descripcion</label>
                    <textarea name="description" class="form-control" id="exampleFormControlTextarea1" rows="3"></textarea>
                    @error('description')
                    <span class="text-danger">{{$message}}</span>
                    @enderror
                </div>
                <div class="file-wrapper">
                    <label for="formFile" class="form-label">Selecciona una foto</label>
                    <input class="form-control" name="photo" type="file" id="formFile">
                    @error('photo')
                    <span class="text-danger">{{$message}}</span>
                    @enderror
                </div>
                <div class="col-auto">
                    <button type="submit" class="btn btn-primary mb-3">Subir</button>
                </div>
            </form>
        </div>
        {{--        FINAL FORMULARIO CARROCERIAS      --}}
        {{--        INICIO FORMULARIO MARCAS      --}}
        <div class="wrapped-col">
            <h2>Añadir una marca</h2>
            <form class="form" action="{{route('add.brand')}}" method="POST" enctype="multipart/form-data">
                @csrf
                <div class="mb-3">
                    <label for="brandField" class="form-label">Marca</label>
                    <input type="text" name="brand_name" class="form-control" id="brandField">
                    @error('brand_name')
                        <span class="text-danger">{{$message}}</span>
                    @enderror
                </div>
                <div class="mb-3">
                    <label for="exampleFormControlTextarea1" class="form-label">Descripcion</label>
                    <textarea name="description" class="form-control" id="exampleFormControlTextarea1" rows="3"></textarea>
                    @error('description')
                    <span class="text-danger">{{$message}}</span>
                    @enderror
                </div>
                <div class="file-wrapper">
                    <label for="formFile" class="form-label">Selecciona una foto</label>
                    <input class="form-control" name="photo" type="file" id="formFile">
                    @error('photo')
                    <span class="text-danger">{{$message}}</span>
                    @enderror
                </div>
                <div class="col-auto">
                    <button type="submit" class="btn btn-primary mb-3">Subir</button>
                </div>
            </form>
        </div>
        {{--        FINAL FORMULARIO MARCAS      --}}
        {{--        INICIO FORMULARIO MODELOS      --}}
        <div class="wrapped-col">
            <h2>Añadir un Modelo</h2>
            <form class="form" action="{{route('add.car-model')}}" method="POST" enctype="multipart/form-data">
                @csrf
                <div class="mb-3">
                    <label for="modelName" class="form-label">Model</label>
                    <input type="text" name="model_name" class="form-control" id="modelName">
                    @error('model_name')
                        <span class="text-danger">{{$message}}</span>
                    @enderror
                </div>
                <div class="mb-3">
                    <label for="modelDescription" class="form-label">Descripcion</label>
                    <textarea name="description" class="form-control" id="modelDescription" rows="3"></textarea>
                    @error('description')
                        <span class="text-danger">{{$message}}</span>
                    @enderror
                </div>
                <div class="mb-3">
                    <label for="selectCategory" class="form-label">Elige tipo de coche</label>
                    <select class="form-select" name="category_id" id="selectCategory" aria-label="Elegir una categoria">
                        <option selected value=-1>Elige tipo de coche</option>
                        @foreach($categories as $category)
                        <option value={{$category->id}}>{{$category->cat_name}}</option>
                        @endforeach
                        @error('category_id')
                            <span class="text-danger">{{$message}}</span>
                        @enderror
                    </select>
                </div>
                <div class="mb-3">
                    <label for="selectBrand" class="form-label">Elige marca</label>
                    <select class="form-select" name="theBrand" id="selectBrand" aria-label="Elegir una marca">
                        <option selected value=-1>Elige marca deseada</option>
                        @foreach($brands as $brand)
                            <option value={{$brand->id}}>{{$brand->brand_name}}</option>
                        @endforeach
                        @error('theBrand')
                            <span class="text-danger">{{$message}}</span>
                        @enderror
                    </select>
                </div>
                <div class="file-wrapper">
                    <label for="formFile" class="form-label">Selecciona una foto</label>
                    <input class="form-control" name="photo" type="file" id="formFile">
                    @error('photo')
                        <span class="text-danger">{{$message}}</span>
                    @enderror
                </div>
                <div class="col-auto">
                    <button type="submit" class="btn btn-primary mb-3">Subir</button>
                </div>
            </form>
        </div>
        {{--        FINAL FORMULARIO MODELOS      --}}
    </div>
    {{--        INICIO FOTOS DE CARROCERIAS, MARCAS, MODELOS      --}}
    <div class="the-wrapper">
        {{--        INICIO SECCION FOTOS DE CARROCERIAS      --}}
        @if($categories)
        <div class="wrapped-col">
            <h2>Categorias</h2>
            @foreach($categories as $category)
                <div class="category__item mb-2">
                    <h3 class="category__name">{{$category->cat_name}}</h3>
                    <div class="image-box-sm">
                        <img src="{{asset($category->photo_sm)}}" alt="Carroceria {{$category->cat_name}}">
                    </div>
                    <div class="buttons-group">
                        <a class="btn" href="{{route('edit.category', $category->id)}}">Editar</a>
                        <a class="btn" href="{{route('delete.category', $category->id)}}">Eliminar</a>
                    </div>
                </div>
            @endforeach
            <div class="pagination-wrapper">
            </div>

        </div>
        @endif
        {{--        FIN SECCION FOTOS DE CARROCERIAS      --}}

        {{--        INICIO SECCION FOTOS DE MARCAS      --}}
        @if($brands)
        <div class="wrapped-col">
            <h2>Marcas</h2>
            @foreach($brands as $brand)
                <div class="category__item">
                    <h3 class="category__name">{{$brand->brand_name}}</h3>
                    <div class="image-box-sm">
                        <img src="{{asset($brand->photo_sm)}}" alt="Marca {{$brand->brand_name}}">
                    </div>
                    <div class="buttons-group">
                        <a href="{{route('edit.brand', $brand->id)}}">Editar</a>
                        <a href="{{route('delete.brand', $brand->id)}}">Eliminar</a>
                    </div>
                </div>
            @endforeach
        </div>
        @endif
        {{--        FIN SECCION FOTOS DE MARCAS      --}}

        {{--        INICIO SECCION FOTOS DE MODELOS DE COCHES      --}}
        @if($carModels)
            <div class="wrapped-col">
                <h2>Modelos</h2>
                @foreach($carModels as $carModel)
                    <div class="category__item">
                        <h3 class="category__name">{{$carModel->model_name}}</h3>
                        <div class="image-box-sm">
                            <img src="{{asset($carModel->photo_sm)}}" alt="Modelo de coche {{$carModel->mode_name}}">
                        </div>
                        <div>Categoria: {{$carModel->category->cat_name}}</div>
                        <div>Marca: {{$carModel->brand->brand_name}}</div>
                        <div class="buttons-group">
                            <a href="{{route('edit.car-model', $carModel->id)}}">Editar</a>
                            <a href="{{route('delete.car-model', $carModel->id)}}">Eliminar</a>
                        </div>
                    </div>
                @endforeach
            </div>
        @endif
        {{--        FIN SECCION FOTOS DE MODELOS DE COCHES      --}}
    </div>
@endsection



