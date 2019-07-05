@extends('layouts.main')
@section('title', 'Index')
@section('content')
    <div class="row">
        <div class="col-md-8 col-md-offset-2">
            <h1>Создать новый Shipment</h1>
            <hr>
            @if(Session::has('Error-shipment'))
                <p class="alert {{Session::get('alert-class', 'alert-danger')}}">{{Session::get('Error-shipment')}}</p>
            @endif
            <form action="/create_shipment">
                <div class="form-group">
                    <label>ID</label>
                    <input name="id" id="id" type="text" class="form-control"  placeholder="Введите ID" required>
                </div>
                <div class="form-group">
                    <label>Название</label>
                    <input name="name" id="name" type="text" class="form-control"  placeholder="Введите название" required>
                </div>
                    <button type="submit" class="btn btn-success btn-lg btn-block">подтвердить</button>
            </form>
        </div>
    </div>
@endsection