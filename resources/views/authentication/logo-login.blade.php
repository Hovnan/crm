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
                    <img id="logo-img" src="imgs/log-log.png" class="img-responsive center-block">
                </div>
                <h3 class="blank1">Начните вместе с Нами</h3>
                <div id="first" style="display: none">
                <form id="login-form" data="">
                    <div class="col-md-8" style="padding-left: 0">
                        <div class="form-group {{ $errors->has('password')? 'has-error' : '' }}" id="pswd">
                            <label for="password">Пароль</label>
                            <input type="hidden" name="email" value="{{ $user->email }}">
                            <input class="form-control1" type="password" name="password" id="password" placeholder="password">
                            <span class="help-block">{{ $errors->has('password')? $errors->first('password') : '' }}</span>
                        </div>
                        <div class="form-group" id="remember">
                            <input type="checkbox" name="remember_me">
                            <span>&nbsp;Запомни меня</span>
                        </div>
                        <a href="/forgot-password">Забыли пароль?</a>
                        <div class="form-group">
                            <!-- <input type="submit" class="btn btn-success pull-right" value="Login">-->
                            <div class="col-md-8 pad-20" style="padding-left:0">
                                <button id="log" type="submit" class="btn btn-info pull-left btn-cust">Войти</button>
                            </div>
                            <!--<div id="submit" class="col-md-8 pad-20" style="padding-left:0; display:none;">
                                <button type="submit" class="btn btn-info pull-left btn-cust">Enter</button>
                            </div>-->
                        </div>
                    </div>
                </form>
                </div>
                <div id="second">
                    <div class="form-group">
                        <div class="input-group col-md-8">
                            <a href="{{ route('login.forget') }}" class="btn btn-link btn-block" style="text-align:left; color: #676767; text-decoration:none; padding: 7px 0; border-bottom: 1px solid #cdcece; border-top: 1px solid #cdcece"><img src="imgs/join.png" width="25px;">&nbsp;Присоединиться к существующей компании<span class="pull-right"><img src="imgs/arr.png" width="10px;"></span></a>
                        </div>
                    </div>
                    <div class="form-group">
                        <div class="input-group col-md-8">
                            <a href="{{ route('register.start') }}" class="btn btn-link btn-block" style="text-align:left; color: #676767; text-decoration:none; padding: 7px 0; border-bottom: 1px solid #cdcece; border-top: 1px solid #cdcece"><img src="imgs/plus.png" width="25px;">&nbsp;Создать новую компанию<span class="pull-right"><img src="imgs/arr.png" width="10px;"></span></a>
                        </div>
                    </div>
                    @if($user->records()->first())
                        <h4>У Вас есть доступ к следующим филиалам</h4>
                        @foreach($user->records as $rec)

                            <div class="form-group">
                                <div class="input-group col-md-8">
                                    <a href="#" onclick="showPassword({{$rec->branch_id}})" class="btn btn-link btn-block" style="text-align:left; color: #676767; text-decoration:none; padding: 7px 0; border-bottom: 1px solid #cdcece; border-top: 1px solid #cdcece"><img src="imgs/br.png" width="25px;">&nbsp;{{ $rec->branch->name }}<span class="pull-right"><img src="imgs/arr.png" width="10px;"></span></a>
                                </div>
                            </div>
                        @endforeach
                    @else
                        <h3>У Вас нет филиалов</h3>
                @endif
                <!--</div>
                </div>-->
                </div>
                <!---728x90--->
            </div>
        </div>
    </div>


@stop

@section('scripts')
    <script type="text/javascript">
        $.ajaxSetup({
            headers: {
                "X-CSRF-TOKEN" : $('meta[name="csrf-token"]').attr('content')
            }
        });
        function showPassword(e) {
            event.preventDefault();
            $('#first').show();
            $('#second').hide();
            $('#login-form').attr('data', e);
            $('#block h1').text('Заполнить пароль');
            $('#logo-img').attr('src', 'imgs/password-logo.png');
        }

        $('#login-form').submit(function(event){
            var branch_id = $('#login-form').attr('data');
            var d = branch_id ? '/'+branch_id : '';
            event.preventDefault();
            var postData = {
                "email": $('input[name=email]').val(),
                "password": $('input[name=password]').val(),
                "remember_me": $('input[name=remember_me]').is(':checked')
            };
            $.ajax({
                type: 'POST',
                url: "/login"+d,
                data: postData,
                success: function(response){
                    //console.log('eeee');
                    window.location.href = response.redirect;
                },
                error: function(response){
                    //console.log(response);
                    $('.alert-danger').text(response.responseJSON.error).show();
                }
            });
        });
    </script>
@stop