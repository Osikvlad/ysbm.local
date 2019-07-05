@extends('layouts.main')
@section('title', 'Index')
@section('content')
    <div class="container">
        <div class="row">
            <div class="col-md-10">
                <h1>Shipment list</h1>
            </div>

            <div class="col-md-2">
                <a href="/createshipment" class="btn btn-lg btn-block btn-primary">Создать Shipment</a>
            </div>
            <div class="col-md-2">
                <a href="/createitem" class="btn btn-lg btn-block btn-success">Создать Item</a>
            </div>
            <div class="col-md-12">
                <hr>
            </div>
        </div>
        @if(Session::has('success'))
            <p class="alert {{Session::get('alert-class', 'alert-info')}}">{{Session::get('success')}}</p>
        @endif
        @if(Session::has('success-item'))
            <p class="alert {{Session::get('alert-class', 'alert-info')}}">{{Session::get('success-item')}}</p>
        @endif
        @if(Session::has('success-delete'))
            <p class="alert {{Session::get('alert-class', 'alert-info')}}">{{Session::get('success-delete')}}</p>
        @endif
        @if(Session::has('success-login'))
            <p class="alert {{Session::get('alert-class', 'alert-info')}}">{{Session::get('success-login')}}</p>
        @endif
        @if(Session::has('success-update'))
            <p class="alert {{Session::get('alert-class', 'alert-info')}}">{{Session::get('success-update')}}</p>
        @endif
        @foreach($shipments as $shipment)
            <div class="col-md-16">
                <a href="/shipment/{{$shipment->id}}" style="color: #080808; font-size: 2.6rem;">{{$shipment->name}}</a><br>

                <form action="/deleteshipment">
                    <input name="id" value="{{$shipment->id}}" type="hidden">
                    <button class="delete-shipment btn btn-danger" id="{{$shipment->id}}">Удалить</button>
                    <a type="submit" href="/updateshipment/{{$shipment->id}}" class="btn btn-primary">Изменить</a>
                </form>

            </div><hr>
        @endforeach
    </div>
    <script>
        $(".delete-shipment").click(function() {
            alert("Вы действительно хотите удалить этот Shipment?");

        });
    </script>

@endsection