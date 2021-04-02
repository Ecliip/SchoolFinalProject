@extends('layouts.admin')
@section('content')
    <div class="the-wrapper">
        <div class="wrapped-col">
            <h2>Editar una categoría</h2>
            <form class="row g-3" action="{{route('update.car-model', $carModel->id)}}" method="POST" enctype="multipart/form-data">
                <input type="hidden" name="old_photo_sm" value="{{$carModel->photo_sm}}">
                <input type="hidden" name="old_photo_md" value="{{$carModel->photo_md}}">
                @csrf
                <div class="mb-3">
                    <label for="modelName" class="form-label">Model</label>
                    <input value="{{$carModel->model_name}}" type="text" name="model_name" class="form-control" id="modelName">
                    @error('model_name')
                    <span class="text-danger">{{$message}}</span>
                    @enderror
                </div>
                <div class="mb-3">
                    <label for="modelDescription" class="form-label">Descripcion</label>
                    <textarea name="description" class="form-control" id="modelDescription" rows="3">{{$carModel->description}}</textarea>
                    @error('description')
                    <span class="text-danger">{{$message}}</span>
                    @enderror
                </div>
                <div class="mb-3">
                    <label for="selectCategory" class="form-label">Elige tipo de coche</label>
                    <select class="form-select" name="category_id" id="selectCategory" aria-label="Elegir una categoria">
                        <option selected={{$carModel->category->id}} value={{$carModel->category->id}}>{{$carModel->category->cat_name}}</option>
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
                    <select class="form-select" name="brand_id" id="selectBrand"  aria-label="Elegir una marca">
                        <option selected={{$carModel->brand->id}} value={{$carModel->brand->id}}>{{$carModel->brand->brand_name}}</option>
                        @foreach($brands as $brand)
                            <option value={{$brand->id}}>{{$brand->brand_name}}</option>
                        @endforeach
                        @error('brand_id')
                            <span class="text-danger">{{$message}}</span>
                        @enderror
                    </select>
                </div>
                <div class="mb-3">
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

        <div class="image-box-sm">
            <img src="{{asset($carModel->photo_sm)}}" alt="">
        </div>
    </div>
@endsection
