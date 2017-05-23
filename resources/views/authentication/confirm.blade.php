@extends('master')

@section('content')
    <div id="" class="" style="min-height: 50px; background-color: #ffffff">
        <div class="col-md-3" style="padding: 17px 30px;">
            <img src="imgs/login.png" class="pull-left img-responsive" style="width: 50px">
        </div>
    </div>
    <div id="page-wrapper" class="sign-in-wrapper">
        <div class="graphs">
            <div class="sign-in-form" style="width: 70%">
                <!---728x90--->
                <div class="sign-in-form-top">
                    <img src="imgs/email-logo.png" class="img-responsive center-block">
                </div>
                <h3 class="blank1">Подтверждение Вашей электронной почты</h3>
                <h4 class="">Мы отправили специальную ссылку на {{ $invite->email }}.
                    Кликните по ссылке, чтобы подтвердить почту и начнем работу.<br>
                    Неверный адрес? Пожалуйста введите новый адрес
                </h4>

            </div>
        </div>
    </div>
@stop