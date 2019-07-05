@extends('layouts.main')
@section('title', 'Index')
@section('content')
    <div class="row">
        <div class="col-md-8 col-md-offset-2">
            <h1>Изменить Shipment</h1>
            <hr>

            <form action="/update_shipment">
                <div class="form-group">
                    <input name="id" id="id" type="hidden" class="form-control"  placeholder="Введите ID" value="{{$id}}" required>
                </div>
                <div class="form-group">
                    <label>Название</label>
                    <input name="name" id="name" type="text" class="form-control"  placeholder="Введите название" required>
                </div>
                <button type="submit" class="btn btn-success btn-lg btn-block">Изменить</button>
            </form>
        </div>
    </div>
@endsection