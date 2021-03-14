@extends('layouts.admin')
@section('content')
    <div class="the-wrapper">
        <div class="wrapped-col">
            <h2>Editar una marca</h2>
            <form class="row g-3" action="{{route('update.brand', $brand->id)}}" method="POST" enctype="multipart/form-data">
                @csrf
                <div class="mb-3">
                    <label for="brandField" class="form-label">Marca</label>
                    <input type="text" name="brand_name" class="form-control" id="brandField" value="{{$brand->brand_name}}">
                    @error('brand_name')
                    <span class="text-danger">{{$message}}</span>
                    @enderror
                </div>
                <div class="mb-3">
                    <label for="exampleFormControlTextarea1" class="form-label">Descripcion</label>
                    <textarea name="description" class="form-control" id="exampleFormControlTextarea1" rows="3">{{$brand->description}}</textarea>
                    @error('description')
                    <span class="text-danger">{{$message}}</span>
                    @enderror
                </div>
                <div class="mb-3">
                    <label for="formFile" class="form-label">Selecciona una foto</label>
                    <input class="form-control" name="photo" type="file" id="formFile">
                    @error('photo')
                    <span class="text-danger">{{$message}}</span>
                    @enderror
                </div>
                <input type="hidden" name="old_photo_sm" value="{{$brand->photo_sm}}">
                <input type="hidden" name="old_photo_md" value="{{$brand->photo_md}}">
                <div class="col-auto">
                    <button type="submit" class="btn btn-primary mb-3">Actualizar</button>
                </div>
            </form>
        </div>

        <div class="image-box-sm">
            <img src="{{asset($brand->photo_sm)}}">
        </div>
    </div>
@endsection
