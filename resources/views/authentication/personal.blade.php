@extends('master')
@section('content')
    <div class="row">
        <div class="col-md-12" style="min-height:50px; background-color: #ffffff;"></div>
        <div class="col-md-12" style="background-color: #f7f6f6;">
            <div class="col-md-8 col-md-offset-2 pad-t30"><img src="/imgs/personal.png" class="img-responsive center-block"></div>
            <div class="col-md-8 col-md-offset-3 pad-b25">
                <h1 style="padding-left:0; font-size: 38px; margin-bottom: 15px; font-family: 'Open Sans', arial; color: #555; font-size: 42px; font-weight: 300;">Подтверждения личности</h1>
                <h2 style="font-family: 'Open Sans', arial; -webkit-font-smoothing: antialiased; color: #555; font-size: 18px; font-weight: 400;">
                    Вам необходимо заполнить поля
                </h2>
            </div>
                <div class="col-md-6 col-md-offset-3">

                    <form action="{{ route('activate.post', ['id' => $user->id, 'activationCode' => $inform->token] }}" method="post">
                            {{ csrf_field() }}
                        <div class="form-group">
                            <div class="input-group col-md-8">
                                <p style="color: #555;">Ваше имя</p>
                                <input type="text" name="first_name" class="form-control" >
                            </div>
                        </div>
                        <div class="form-group">
                            <div class="input-group col-md-8">
                                <p style="color: #555;">Ваша Фамилия</p>
                                <input type="text" name="last_name" class="form-control" placeholder="">
                            </div>
                        </div>
                        <div class="form-group">
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
    <script type="text/javascript">
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
    </script>
@stop