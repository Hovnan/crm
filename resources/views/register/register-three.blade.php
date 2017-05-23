@extends('master')
@section('content')
    <div class="row" style="background: #fff;">
        <div id="register" class="col-md-12">
                <div class="left_block reg_3 col-md-8">
                    <img src="/imgs/3.png" class="img-responsive center-block">
                </div>
            <div class="right_block col-md-4">
                <div class="reg_title">Давайте знакомиться!</div>
                <div class="space6"></div>
                <div class="reg_info">Ваше имя будет отображаться вместе с вашими сообщениями</div>
                <form action="{{ route('register-3', ['id' => $user->id]) }}" id="reg_form" method="post">
                    {{ csrf_field() }}
                    <div class="form-group {{ $errors->has('first_name')? 'has-error' : '' }}" id="first_name">
                        <label class="control-label" for="nom">Ваше имя:</label>
                        <input class="form-control" type="text" id="nom" name="first_name">
                        <!--<span class="glyphicon glyphicon-remove form-control-feedback hidden" aria-hidden="true"></span>-->
                        <span class="sr-only" id="inputGroupSuccess1Status">(error)</span>
                    </div>
                    <div class="form-group {{ $errors->has('password')? 'has-error' : '' }}" id="last_name">
                        <label class="control-label" for="surname">Ваше фамилия:</label>
                        <input class="form-control" type="text" id="surname" name="last_name">
                        <span class="help-block">{{ $errors->has('last_name')? $errors->first('last_name') : '' }}</span>
                    </div>
                    <div class="text-center"><button type="submit" id="btnSubmit" class="btn">Далее <span class="glyphicon glyphicon-arrow-right" aria-hidden="true"></span></button></div>
                </form>
            </div>
        </div>
    </div>
@stop