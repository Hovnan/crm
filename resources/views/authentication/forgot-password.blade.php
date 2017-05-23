@extends('master')

@section('content')
    <div class="row">
        <div class="col-md-12" style="min-height:50px; background-color: #ffffff;"></div>
        <div class="col-md-12" style="background-color: #f7f6f6;" id="block">
            <div class="col-md-8 col-md-offset-2 pad-t30"><img src="imgs/password-logo.png" class="img-responsive center-block"></div>
            <div class="col-md-8 col-md-offset-3 pad-b25">
                <h1 style="padding-left:0; font-size: 38px; margin-bottom: 15px; font-family: 'Open Sans', arial; color: #555; font-size: 42px; font-weight: 300;">Восстановить пароль</h1>
                <h2 style="font-family: 'Open Sans', arial; -webkit-font-smoothing: antialiased; color: #555; font-size: 18px; font-weight: 400;">
                    Код отправиться на ваш email
                </h2>
            </div>
            <div class="col-md-6 col-md-offset-3">
                <!--<form id="login-form" action="/login" method="post">-->
                <form action="/forgot-password" method="post">
                    {{ csrf_field() }}
                    @if(session('success'))
                        <div class="alert alert-success">{{ session('success') }}</div>
                    @endif
                    <div class="form-group" id="email">
                        <div class="input-group col-md-8">
                            <p style="color: #555;">Адрес вашей электронной почты</p>
                            <input type="text" name="email" class="form-control" placeholder="example@example.com">
                        </div>
                    </div>
                    <div class="form-group">
                        <div class="col-md-8 pad-20" style="padding-left:0">
                            <button type="submit" class="btn btn-info pull-left btn-cust">Отправить код</button>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>
@stop