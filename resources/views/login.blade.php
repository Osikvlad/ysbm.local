@extends('layouts.mainlogin')
@section('title', 'Index')
@section('content')
    <div class="row">
        <div class="col-md-8 col-md-offset-2">
            <h1>Вход</h1>
            <hr>
            @if(Session::has('Error-login'))
                <p class="alert {{Session::get('alert-class', 'alert-danger')}}">{{Session::get('Error-login')}}</p>
            @endif
            <form action="/login">
                <div class="form-group">
                    <label>Email:</label>
                    <input name="email" id="email" type="text" class="form-control"  placeholder="Введите Email" required>
                </div>
                <div class="form-group">
                    <label>Пароль</label>
                    <input name="password" id="password" type="password" class="form-control"  placeholder="Введите пароль" required>
                </div>
                <button type="submit" class="btn btn-success btn-lg btn-block">подтвердить</button>
            </form>
        </div>
    </div>
@endsection