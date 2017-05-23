@extends('master')
@section('content')

    <div id="" class="sign-in-wrapper">
        <div class="graphs">
            <div class="row" style="background: #fff;">
                <div class="col-lg-1 col-md-1 col-sm-1 col-xs-1"></div>
                <!--<div class="col-lg-10 col-sm-10 col-md-10 col-xs-10" style="padding-left: 0; padding-right: 0;">-->
                    <!--<div id="register">-->
                        <!--<div class="" style="width: 34%;
    float: left;
    min-width: 250px;
    height: 100%;">-->


                <div class="col-lg-4 col-sm-4 col-md-4 col-xs-4" style="padding-left: 0; padding-right: 0;">
                    <div class="col-xs-10 col-xs-offset-1">
                        <div class="reg_title">
                            Создать компанию
                        </div>
                        <form action="{{ route('register-1') }}" id="reg_form" method="post">
                            {{ csrf_field() }}
                            <div class="form-group {{ $errors->has('email')? 'has-error' : '' }}">
                                <label for="email">Адрес вашей эл. почты:</label>
                                <input type="text" class="form-control1" id="email" value="{{ $mail? $mail : old('email') }}" name="email">
                                <span class="help-block">{{ $errors->has('email')? $errors->first('email') : '' }}</span>
                            </div>
                            <div class="form-group {{ $errors->has('password')? 'has-error' : '' }}">
                                <label for="pwd">Пароль:</label>
                                <input class="form-control1" type="password" id="pwd" name="password">
                                <span class="help-block">{{ $errors->has('password')? $errors->first('password') : '' }}</span>
                            </div>
                            <div class="form-group {{ $errors->has('password_confirmation')? 'has-error' : '' }}">
                                <label for="conf_pwd">Повторите пароль:</label>
                                <input class="form-control1" type="password" id="conf_pwd" name="password_confirmation">
                                <span class="help-block">{{ $errors->has('password_confirmation')? $errors->first('password_confirmation') : '' }}</span>
                            </div>
                            <div class="text-center"><button type="submit" id="btnSubmit" class="btn btn-cust">Далее <span class="glyphicon glyphicon-arrow-right" aria-hidden="true"></span></button></div>
                        </form>
                    </div>
                </div>
                <div class="nmn col-lg-6 col-sm-6 col-md-6 col-xs-6" style="background-color: #334e7a;">

                <!--<div class="nmn" style="background-color: #334e7a; width: 66%;
    float: left;
    height: 100%;">-->
                    <img src="/imgs/1.png" class="img-responsive center-block">
                </div>
                    <!--</div>
                </div>-->
                <div class="nmn col-lg-1 col-md-1 col-sm-1 col-xs-1" style="background-color: #334e7a;"></div>
            </div>
        </div>
    </div>
@stop
