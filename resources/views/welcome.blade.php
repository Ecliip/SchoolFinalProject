@extends('layouts.classic')
@section('content')
    @if($categories->count() > 0)
        <section>
            <h2>Carrocerias mas populares</h2>

                <div class="the-wrapper-25">
                    @foreach($categories as $category)
                        <a href="{{route('all.car')}}">
                            <div class="card-25">
                                <h3>{{$category->category}}</h3>
                                <div class="image-box-sm">
                                    <img src="{{$category->photo_sm}}">
                                </div>
                            </div>
                        </a>
                    @endforeach

                </div>
            <a class="open-all" href="{{route('all.car')}}">Ver todas las carrocerias</a>
        </section>
    @endif
    @if($brands->count() > 0)
        <section>
            <h2>Marcas mas populares</h2>
            <div class="the-wrapper-25">
                @foreach($brands as $brand)
                    <a href="{{route('all.car')}}">
                        <div class="card-25">
                            <h3>{{$brand->brand}}</h3>
                            <div class="image-box-sm">
                                <img src="{{$brand->photo_sm}}">
                            </div>
                        </div>
                    </a>
                @endforeach
            </div>
            <a class="open-all" href="{{route('all.car')}}">Ver todas las marcas</a>
        </section>
    @endif
    @if($models->count() > 0)
        <section>
            <h2>Modelos mas populares</h2>
            <div class="the-wrapper-25">
                @foreach($models as $model)
                    <a href="{{route('all.car')}}">
                        <div class="card-25">
                            <h3>{{$model->model}}</h3>
                            <div class="image-box-sm">
                                <img src="{{$model->photo_sm}}">
                            </div>
                        </div>
                    </a>
                @endforeach
            </div>
            <a class="open-all" href="{{route('all.car')}}">Ver todas los modelos</a>
        </section>
    @endif
@endsection
