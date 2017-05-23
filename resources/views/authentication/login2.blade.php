@extends('master')

@section('content')
    <div class="row">
        <div class="col-md-12" style="min-height:50px; background-color: #ffffff;"></div>
        <div class="col-md-12" style="background-color: #f7f6f6;">
            <div class="col-md-8 col-md-offset-2 pad-t30"><img src="imgs/login-logo.png" class="img-responsive center-block"></div>
            <div class="col-md-8 col-md-offset-3 pad-b25">
                <h1 style="padding-left:0; font-size: 38px; margin-bottom: 15px; font-family: 'Open Sans', arial; color: #555; font-size: 42px; font-weight: 300;">Присоединиться к существующему филиалу</h1>
                <h2 style="font-family: 'Open Sans', arial; -webkit-font-smoothing: antialiased; color: #555; font-size: 18px; font-weight: 400;">
                    Чтобы найти филиалы, к которым вы можете присоединиться,
                    пожалуйста, введите свой адрес электронной почты
                </h2>
            </div>
                <div class="col-md-6 col-md-offset-3">

                    <form id="login-form" action="/login" method="post">
                        {{ csrf_field() }}
                        <div class="alert alert-danger" style="display:none"></div>

                        <div class="alert alert-success" style="display:none"></div>
                        <div class="form-group" id="email">
                            <div class="input-group col-md-8">
                                <p style="color: #555;">Адрес вашей электронной почты {{ $user->email }}</p>
                                <input type="hidden" name="email" class="form-control" placeholder="example@example.com" value="{{ $user->email }}">
                            </div>
                        </div>
                        <div class="form-group" id="pswd">
                            <div class="input-group col-md-8">
                                <input type="password" name="password" class="form-control" placeholder="password">
                            </div>
                        </div>
                        <div class="form-group" id="remember">
                            <input type="checkbox" name="remember_me">
                            <span>&nbsp;Запомни меня</span>
                        </div>
                        <div class="form-group">
                            <button class="btn btn-info btn-xs"><i class="fa fa-plus" aria-hidden="true"></i></button>
                            <a href="#" class="btn btn-link" style="color: grey; text-decoration: none;">Создать новую компанию</a>
                        </div>
                        <!--<a href="/forgot-password">Forgot your Password?</a>-->
                        <div class="form-group">
                           <!-- <input type="submit" class="btn btn-success pull-right" value="Login">-->
                            <div class="col-md-8 pad-20" style="padding-left:0">
                                <button id="log" type="submit" class="btn btn-info pull-left btn-cust">Найти</button>
                            </div>
                            <!--<div id="submit" class="col-md-8 pad-20" style="padding-left:0; display:none;">
                                <button type="submit" class="btn btn-info pull-left btn-cust">Enter</button>
                            </div>-->
                        </div>
                    </form>

                    <br>
                    <br>
                    <br>
                    <!--</div>
                </div>-->
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

        /* $('#login-form').submit(function(event){

            event.preventDefault();
            var postData = {
                "email": $('input[name=email]').val(),
                "password": $('input[name=password]').val(),
                "remember_me": $('input[name=remember_me]').is(':checked')
            };
            $.ajax({
                type: 'POST',
                url: '/login',
                data: postData,
                success: function(response){
                    window.location.href = response.redirect;
                },
                error: function(response){
                    //console.log(response);
                    $('.alert-danger').text(response.responseJSON.error).show();
                }
            });
        });*/
    </script>
@stop