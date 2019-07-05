@extends('layouts.main')
@section('title', 'Index')
@section('content')
    <div class="container">
        <div class="row">
            <div class="col-md-10">
                <h1>Товары этой доставки:</h1>
            </div>

            <div class="col-md-2">
                <a href="/shipment" class="btn btn-lg btn-block btn-primary">Вернуться назад</a>
            </div>
            <div class="col-md-12">
                <hr>
            </div>
        </div>
        @if(Session::has('success-delete-item'))
            <p class="alert {{Session::get('alert-class', 'alert-info')}}">{{Session::get('success-delete-item')}}</p>
        @endif
        @if(count($items) !== 0)
        @foreach($items as $item)
            <div class="col-md-16">
                <a style="color: #080808; font-size: 2.6rem;">{{$item->name}}</a><br>
                <span style="color: #133d55; font-size: 2.0rem;">Доастака:{{$item->shipment_id}}</span><br>
                <span style="color: #133d55; font-size: 2.0rem;">Код Товара:{{$item->code}}</span>

                <form action="/deleteitem">
                    <input name="id" value="{{$item->id}}" type="hidden">
                    <button class="delete-shipment btn btn-danger" id="">Удалить</button>
                </form><hr>

            </div>
        @endforeach
            @else
            <h2 style="text-align: center;">Эта доставка пуста:(</h2>
            @endif
    </div>
    <script>
        $(".delete-shipment").click(function() {
            alert("Вы действительно хотите удалить этот Item?");

        });
    </script>

@endsection