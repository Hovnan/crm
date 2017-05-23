@extends('master')
@section('content')

<div class="row" style="background: #fff;">
    <!---->
    <div id="register">
        <div class="left_block reg_4"><img src="/imgs/4.png" class="img-responsive center-block"></div>
        <div class="right_block">
            <div class="reg_title">Введите название компании и поддомена</div>
            <div class="space6"></div>
            <form action="{{ route('register-4', ['id' => $user->id]) }}" id="reg_form" method="post">
                {{ csrf_field() }}
                <div class="form-group">
                    <label class="control-label" for="company">Название компании:</label>
                    <input class="form-control" type="text" id="company" aria-describedby="inputGroupSuccess1Status" data-toggle="tooltip" data-placement="bottom" data-html="true" title="" data-empty="Заполните поле" name="name">
                    <span class="glyphicon glyphicon-remove form-control-feedback hidden" aria-hidden="true"></span>
                    <span class="sr-only" id="inputGroupSuccess1Status">(error)</span>
                </div>
                <div class="form-group">
                    <label class="control-label" for="sub">Название поддомена:</label>
                    <input class="form-control" id="sub" aria-describedby="inputGroupSuccess1Status" data-toggle="tooltip" data-placement="bottom" data-html="true" title="" data-empty="Заполните поле" name="domain">
                    <span class="glyphicon glyphicon-remove form-control-feedback hidden" aria-hidden="true"></span>
                    <span class="sr-only" id="inputGroupSuccess1Status">(error)</span>
                </div>
                <div class="text-center"><button type="submit" id="btnSubmit" class="btn">Далее <span class="glyphicon glyphicon-arrow-right" aria-hidden="true"></span></button></div>
            </form>
        </div>
    </div>
</div>
@stop