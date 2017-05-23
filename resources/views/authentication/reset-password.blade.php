@extends('master')

@section('content')
    <div class="row" id="block" style="background-color: #f7f6f6;">
        <div class="col-md-12" style="min-height:50px; background-color: #ffffff;"></div>
        <div class="col-md-12" >
            <div class="col-md-8 col-md-offset-2 pad-t30" id="img"><img src="/imgs/password-logo.png" class="img-responsive center-block"></div>
            <div class="col-md-8 col-md-offset-3 pad-b25">
                <h1 style="padding-left:0; font-size: 38px; margin-bottom: 15px; font-family: 'Open Sans', arial; color: #555; font-size: 42px; font-weight: 300;">Создать пароль</h1>
                <h2 style="font-family: 'Open Sans', arial; -webkit-font-smoothing: antialiased; color: #555; font-size: 18px; font-weight: 400;">
                    Вам необходимо заполнить поля
                </h2>
            </div>
            <div class="col-md-6 col-md-offset-3">

                <form action="" method="post">
                    @if(count($errors) > 0)
                        <div class="alert alert-danger">
                            <ul>
                                @foreach($errors->all() as $error)
                                    <li>{{ $error }}</li>
                                @endforeach
                            </ul>
                        </div>
                    @endif
                    {{ csrf_field() }}
                    <div class="form-group" id="password">
                        <div class="input-group col-md-8">
                            <p style="color: #555;">Пароль</p>
                            <input type="password" name="password" class="form-control" >
                        </div>
                    </div>
                    <div class="form-group" id="password_confirmation">
                        <div class="input-group col-md-8">
                            <p style="color: #555;">Подтвердить пароль</p>
                            <input type="password" name="password_confirmation" class="form-control">
                        </div>
                    </div>
                    <div class="form-group" id="activate">
                        <div class="col-md-8 pad-20" style="padding-left:0">
                            <button type="submit" class="btn btn-info pull-left btn-cust">Обновление пароля</button>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>
@stop