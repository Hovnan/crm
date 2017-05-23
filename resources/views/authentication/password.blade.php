@extends('master')
@section('content')
    <div class="row" id="one">
        <div class="col-md-12" style="min-height:50px; background-color: #ffffff;"></div>
        <div class="col-md-12" style="background-color: #f7f6f6;">
            <div class="col-md-8 col-md-offset-2 pad-t30" id="img"><img src="/imgs/password-logo.png" class="img-responsive center-block"></div>
            <div class="col-md-8 col-md-offset-3 pad-b25">
                <h3 class="blank1" >Создать пароль</h3>
                <h2 style="font-family: 'Open Sans', arial; -webkit-font-smoothing: antialiased; color: #555; font-size: 18px; font-weight: 400;">
                    Вам необходимо заполнить поля
                </h2>
            </div>
                <div class="col-md-6 col-md-offset-3">

                    <form action="{{ route('activate.post', ['id' => $user->id, 'activationCode' => $inform->token]) }}" method="post">
                    {{ csrf_field() }}
                        <div class="form-group" id="password">
                            <div class="input-group col-md-8">
                                <p style="color: #555;">пароль</p>
                                <input type="password" name="password" class="form-control1" >
                            </div>
                        </div>
                        <div class="form-group" id="password_confirmation">
                            <div class="input-group col-md-8">
                                <p style="color: #555;">Confirm пароль</p>
                                <input type="password" name="password_confirmation" class="form-control1" placeholder="password">
                            </div>
                        </div>
                        <div class="form-group" id="button">
                            <!-- <input type="submit" class="btn btn-success pull-right" value="Login">-->
                            <div class="col-md-8 pad-20" style="padding-left:0">
                                <button type="button" class="btn btn-info pull-left btn-cust" onclick="activate()">Далее <span class="glyphicon glyphicon-arrow-right" aria-hidden="true"></span></button>
                            </div>
                        </div>
                        <div class="form-group" id="first_name" style="display: none">
                            <div class="input-group col-md-8">
                                <p style="color: #555;">Ваше имя</p>
                                <input type="text" name="first_name" class="form-control" >
                            </div>
                        </div>
                        <div class="form-group" id="last_name" style="display: none">
                            <div class="input-group col-md-8">
                                <p style="color: #555;">Ваша Фамилия</p>
                                <input type="text" name="last_name" class="form-control" placeholder="">
                            </div>
                        </div>
                        <div class="form-group" id="activate" style="display: none">
                            <!-- <input type="submit" class="btn btn-success pull-right" value="Login">-->
                            <div class="col-md-8 pad-20" style="padding-left:0">
                                <button type="submit" class="btn btn-info pull-left btn-cust">Далее <span class="glyphicon glyphicon-arrow-right" aria-hidden="true"></span></button>
                            </div>
                        </div>
                    </form>
                    <br>
                    <br>
                    <br>
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
    <!--<script type="text/javascript">
        $.ajaxSetup({
            headers: {
                "X-CSRF-TOKEN" : $('meta[name="csrf-token"]').attr('content')
            }
        });

        $('#login-form').submit(function(event){

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
        });
    </script>-->
    <script type="text/javascript">
        function activate() {
            $('#one img').attr('src', '/imgs/personal.png');
            $('#one h1').text('Подтверждения личности');
            $('#password').hide();
            $('#password_confirmation').hide();
            $('#button').hide();
            $('#first_name').show();
            $('#last_name').show();
            $('#activate').show();
        }
    </script>

@stop