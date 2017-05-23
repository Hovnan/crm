@extends('master')
@section('content')
<div class="row" style="background: #fff;">
    <!---->
    <div id="register">
        <div class="left_block">
            <div class="logo">
                <a href="#"><img src="/imgs/logo.png" width="80%" alt="" /></a>
            </div>
            <div class="reg_title">Проверьте свою электронную почту!</div>
            <div class="space6"></div>
            <div class="reg_info">Мы отправили шестизначный код подтверждения на {{ $user->email }}. Введите его ниже, чтобы подтвердить адрес электронной почты.</div>
            <form action="{{ route('register-2', ['id' => $user->id]) }}" id="reg_form" method="post">
                {{ csrf_field() }}
                <div class="form-group {{ $errors->has('code')? 'has-error' : '' }}">
                    <label class="control-label" for="code">&nbsp;</label>
                    <input class="form-control" id="code" name="code" value="{{ old('code') }}">
                    <span class="help-block">{{ $errors->has('code')? $errors->first('code') : '' }}</span>
                </div>
                <div class="text-center"><button type="submit" id="btnSubmit" class="btn">Далее <span class="glyphicon glyphicon-arrow-right" aria-hidden="true"></span></button></div>
            </form>
            <div class="space6"></div>
            <div class="reg_info">Не забудьте оставить это окно открытым во время проверки вашего кода.</div>
        </div>
        <div class="right_block reg_2"><img src="/imgs/2.png" class="img-responsive center-block"></div>

    </div>
</div>
    @stop