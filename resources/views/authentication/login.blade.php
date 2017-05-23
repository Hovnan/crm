@extends('master')

@section('content')
        <div id="" class="" style="min-height: 50px; background-color: #ffffff">
            <div class="col-md-3" style="padding: 17px 30px;">
                <img src="imgs/login.png" class="pull-left img-responsive" style="width: 50px">
            </div>
        </div>
        <div id="page-wrapper" class="sign-in-wrapper">
            <div class="graphs">
                <div class="sign-in-form">
                    <!---728x90--->
                    <div class="sign-in-form-top">
                        <img src="imgs/login-logo.png" class="img-responsive center-block">
                    </div>
                    <h3 class="blank1">Присоединиться к существующему филиалу</h3>
                    <h4 class="">Чтобы найти филиалы, к которым вы можете присоединиться, пожалуйста, введите свой адрес электронной почты</h4>
                    <form action="{{ route('login.email') }}" method="post">
                        {{ csrf_field() }}
                        <div class="alert alert-danger" style="display:none"></div>

                        <div class="alert alert-success" style="display:none"></div>

                        <div class="form-group {{ $errors->has('email')? 'has-error' : '' }}" id="email">
                            <div class="row">
                                <div class="col-md-8">
                                    <label for="mail">Адрес вашей электронной почты</label>
                                    <input class="form-control1" type="text" name="email" id="mail" placeholder="example@example.com">
                                    <span class="help-block">{{ $errors->has('email')? $errors->first('email') : '' }}</span>
                                </div>
                                <div class="clearfix"> </div>
                            </div>
                        </div>
                        <div class="form-group">
                            <div class="row">

                                <div class="col-md-8">
                                <a href="{{ route('register.start') }}" class="btn btn-link btn-block" style="text-align:left; color: #676767; text-decoration:none; padding: 7px 0; border-bottom: 1px solid #cdcece; border-top: 1px solid #cdcece"><img src="imgs/plus.png" width="25px;">&nbsp;Создать новую компанию<span class="pull-right"><img src="imgs/arr.png" width="10px;"></span></a>
                            </div>
                            </div>
                        </div>
                        <div class="form-group">
                            <div class="row">
                                <div class="col-md-6">
                                    <button id="log" type="submit" class="btn btn-info pull-left btn-cust">Найти</button>
                                </div>
                            </div>
                        </div>
                    </form>
                    <!---728x90--->
                </div>
            </div>
        </div>
        <!--footer section start
        <footer>
            <p>© 2015 Easy Admin Panel. All Rights Reserved | Design by <a href="https://w3layouts.com/" target="_blank">w3layouts.</a></p>
        </footer>
        footer section end-->