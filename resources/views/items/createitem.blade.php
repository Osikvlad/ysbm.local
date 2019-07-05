@extends('layouts.main')
@section('title', 'Index')
@section('content')
    <div class="row">
        <div class="col-md-8 col-md-offset-2">
            <h1>Создать новый Item</h1>
            <hr>
            @if(Session::has('Error-item'))
                <p class="alert {{Session::get('alert-class', 'alert-danger')}}">{{Session::get('Error-item')}}</p>
            @endif
            <form action="/create_item">
                <div class="form-group">
                    <label>ID</label>
                    <input name="id" id="id" type="text" class="form-control"  placeholder="Введите ID" required>
                </div>
                <label>Shipment ID</label>
                <select name="shipment_id" id="shipment_id" class="form-control" id="exampleFormControlSelect1">
                    @foreach($shipments as $shipment)
                        <option name="shipment_id" id="shipment_id" value="{{$shipment->id}}">{{$shipment->name}}</option>
                    @endforeach
                </select>
                <div class="form-group">
                    <label>Название</label>
                    <input name="name" id="name" type="text" class="form-control"  placeholder="Введите название" required>
                </div>
                <div class="form-group">
                    <label>Item code</label>
                    <input name="code" id="code" type="text" class="form-control"  placeholder="Введите ID" required>
                </div>
                <button type="submit" class="btn btn-success btn-lg btn-block">подтвердить</button>
            </form>
        </div>
    </div>
@endsection