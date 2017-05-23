@extends('master')
@section('content')
    <section>
        <div class="row" style="background-color: #dddcdc">
            <div class="col-lg-1 col-md-1 col-sm-1 col-xs-1"></div>
            <div class="col-lg-10 col-sm-10 col-md-10 col-xs-10">
                <div class="col-lg-12 pad-n"><span class="pull-right "><a class="text-muted y-type" href="{{ route('login') }}">Войти</a></span></div>
                <!--Modal-->
                <div class="modal fade" id="myModal" role="dialog" >
                    <div class="modal-dialog modal-md">
                        <div class="modal-content text-muted border-0">
                            <form id="login-form">
                                <div class="modal-header z-type">
                                    <button type="button" class="close" data-dismiss="modal">&times;</button>
                                    <div class="container-fluid">
                                        <!-- Контейнер, в котором можно создавать классы системы сеток -->
                                        <div class="row">
                                            <div class="col-md-6">
                                                <h3 class="modal-title">Войти</h3>
                                                <span class="f-type">Вам необходимо заполнить поля</span>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="modal-body">
                                    <div class="container-fluid">
                                        <!-- Контейнер, в котором можно создавать классы системы сеток -->
                                        <div class="row pad-b10">
                                            <div class="col-xs-8">
                                                <p>Адрес вашей электронной почты</p>
                                                <input type="text" class="form-control" id="email" name="mail">
                                            </div>
                                        </div>
                                        <div class="row">
                                            <div class="col-xs-8">
                                                <p>Пароль</p>
                                                <input type="password" class="form-control" id="password" name="password">
                                            </div>
                                        </div>
                                        <div class="row">
                                            <div class="col-xs-8">
                                                Remember me
                                                <input type="checkbox" name="remember_me">
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="modal-footer x-type">
                                    <div class="container-fluid">
                                        <div class="row">
                                            <div class="col-md-8">
                                                <button type="submit" class="btn btn-info pull-left btn-cust">Войти</button>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
                <!--/.Modal-->
                <div class="col-lg-6 text-muted b-type">
                    <div class="text-center c-type">
                        <h1>МЫ ПОМОЖЕМ ВАМ ЛЕГКО УПРАВЛЯТЬ ВАШИМ БИЗНЕСОМ</h1>
                    </div>
                    <form action="{{ route('register.start') }}" method="post">
                        {{ csrf_field() }}
                        <div class="form-group pad-b30">
                            <span class="col-lg-12">Адрес вашей электронной почты</span>
                            <div class="col-md-10 m-type">
                                <input type="email" class="form-control1" id="mail" name="email" placeholder="">
                            </div>
                            <div class="col-xs-2 pad-l5">
                                <button type="submit" class="btn btn-info border-r0">Создать</button>
                            </div>
                        </div>
                    </form>
                </div>
                <div class="col-lg-6" ><img src="/imgs/top_right.png" class="img-responsive center-block"></div></div>
            <div class="col-lg-1 col-md-1 col-sm-1 col-xs-1"></div>
        </div>
        <div class="row">
            <div class="col-lg-1 col-md-1 col-sm-1 col-xs-1" style="height: 401px; background-color: #334e7a">

            </div>
            <div class="col-lg-10 col-sm-10 col-md-10 col-xs-10" style="padding-left: 0; padding-right: 0;">
                <div class="carousel slide" data-interval="4000" data-ride="carousel" id="custom_carousel">
                    <!-- Wrapper for slides -->
                    <div class="carousel-inner">
                        <div class="item active">
                            <div class="container-fluid">
                                <div class="row">
                                    <div class="top col-sm-7 back-blue"><img src="/imgs/sl_1.png" class="img-responsive center-block"></div>
                                    <div class="content col-sm-5 text-muted k-type">
                                        <h3>Посетители</h3>
                                        <p>Мы поможем Вам управлять списком Ваших посетителей добавление новых редактирование зарегистрированных удаление.</p>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="item">
                            <div class="container-fluid">
                                <div class="row">
                                    <div class="top col-sm-7 back-blue"><img src="/imgs/sl_2.png" class="img-responsive center-block"></div>
                                    <div class="content col-sm-5 text-muted pad-j">
                                        <h3>Посетители 2</h3>
                                        <p>Мы поможем Вам управлять Ваших посетителей добавление новых редактирование зарегистрированных удаление.</p>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="item">
                            <div class="container-fluid">
                                <div class="row">
                                    <div class="top col-sm-7 back-blue"><img src="/imgs/sl_3.png" class="img-responsive center-block"></div>
                                    <div class="content col-sm-5 text-muted pad-j">
                                        <h3>Посетители 3</h3>
                                        <p>Мы поможем Вам управлять Ваших посетителей добавление новых редактирование зарегистрированных удаление.</p>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="item">
                            <div class="container-fluid">
                                <div class="row">
                                    <div class="top col-sm-7 back-blue"><img src="/imgs/sl_4.png" class="img-responsive center-block"></div>
                                    <div class="content col-sm-5 text-muted pad-j">
                                        <h3>Посетители 4</h3>
                                        <p>Мы поможем Вам управлять Ваших посетителей добавление новых редактирование зарегистрированных удаление.</p>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="item">
                            <div class="container-fluid">
                                <div class="row">
                                    <div class="top col-sm-7 back-blue"><img src="/imgs/sl_5.png" class="img-responsive center-block"></div>
                                    <div class="content col-sm-5 text-muted pad-j">
                                        <h3>Посетители 5</h3>
                                        <p>Мы поможем Вам управлять Ваших посетителей добавление новых редактирование зарегистрированных удаление.</p>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <!-- End Item -->
                    </div>
                    <a data-slide="prev" href="#custom_carousel" class="left carousel-control"><i class="fa fa-chevron-left"></i></a>
                    <a data-slide="next" href="#custom_carousel" class="right carousel-control"><i class="fa fa-chevron-right"></i></a>
                    <!-- End Carousel Inner -->
                </div>
            </div>
            <div class="col-lg-1 col-md-1 col-sm-1 col-xs-1" style="height: 401px; background-color: #FFFFFF"></div>
        </div>
        <div class="row" style="background-color: #dddcdc;  ">
            <div class="col-lg-1 col-md-1 col-sm-1 col-xs-1 " style="padding-left: 0; padding-right: 0;">
                <div class="" style="background-color: #53b5d1; min-height:70px; margin-top: 100px; padding-left: 0; padding-right: 0;"></div>
            </div>
            <div class="col-lg-10 col-sm-10 col-md-10 col-xs-10 inf-row text-center" style="padding-left: 0; padding-right: 0;">
                <div class="col-xs-8 col-xs-offset-4 inf-1"><p> Удобно использовать</p></div>
                <div class="col-xs-9 inf-2">Прямой доступ через интернет</div>
                <div class="col-xs-10 col-xs-offset-2 inf-3">Никаких дополнительных настроек</div>
            </div>
            <div class="col-lg-1 col-md-1 col-sm-1 col-xs-1" style="padding-left: 0; padding-right: 0;">
                <div style="background-color: #73a1ec; min-height:70px; margin-top: 15px; padding-left: 0; padding-right: 0;"></div>
                <div style="background-color: #40c9b4; min-height:70px; margin-top: 100px; padding-left: 0; padding-right: 0;"></div>
            </div>
        </div>
            <div class="row" style="background-color: #fff;">
                <div class="col-lg-1 col-md-1 col-sm-1 col-xs-1"></div>
                <div class="col-lg-10 col-sm-10 col-md-10 col-xs-10">
                    <div class="col-sm-5"><img src="/imgs/sale.png" class="img-responsive center-block"></div>
                    <div class="col-sm-7 s-type">
                        <h2>Первый месяц бесплатно</h2>
                        <p class="text-muted">Супер возможность пользоваться услугами бесплатно цели месяц! Воспользовавшись убедитесь в реальности легкого и быстрого управления бизнесом.</p>
                    </div>
                </div>
                <div class="col-lg-1 col-md-1 col-sm-1 col-xs-1"></div>
            </div>
            <div class="row pad-t30 back-grey">
                <div class="col-lg-1 col-md-1 col-sm-1 col-xs-1"></div>
                <div class="col-lg-10 col-sm-10 col-md-10 col-xs-10">
                    <div class="col-lg-9 cust-div">
                        <div class="col-sm-4 pad-b30">
                            <img src="/imgs/tarif_1.png" class="img-responsive center-block">
                            <div class="center-block tarif-mid">
                                <div class="section pad-20">
                                    <span class="pull-left text-muted" style="width:90%">Кол-во посетителей:</span>
                                    <span class="pull-right" style="width:10%">50</span>
                                </div>
                                <div class="section pad-20">
                                    <span class="pull-left text-muted" style="width:90%">Кол-во сообщений:</span>
                                    <span class="pull-right" style="width:10%">50</span>
                                </div>
                                <div class="section pad-20">
                                    <span><img src="/imgs/line.png" class="img-responsive center-block"></span>
                                    <span class="pull-left text-muted" style="width:80%; padding-top: 5px;">Техподдержка:</span>
                                    <span class="pull-right" style="width:20%; padding-top: 5px;">mail</span>
                                </div>
                            </div>
                            <div class="back-succ tarif center-block" >
                                <span class="pull-left">Цена:</span>
                                <span class="pull-right">5000</span>
                            </div>
                        </div>
                        <div class="col-sm-4 pad-b30">
                            <img src="/imgs/tarif_2.png" class="img-responsive center-block">
                            <div class="center-block tarif-mid">
                                <div class="section pad-20">
                                    <span class="pull-left text-muted" style="width:90%">Кол-во посетителей:</span>
                                    <span class="pull-right" style="width:10%">50</span>
                                </div>
                                <div class="section pad-20">
                                    <span class="pull-left text-muted" style="width:90%">Кол-во сообщений:</span>
                                    <span class="pull-right" style="width:10%">50</span>
                                </div>
                                <div class="section pad-20">
                                    <span><img src="/imgs/line.png" class="img-responsive center-block"></span>
                                    <span class="pull-left text-muted" style="width:80%; padding-top: 5px;" >Техподдержка:</span>
                                    <span class="pull-right" style="width:20%; padding-top: 5px;">mail</span>
                                </div>
                            </div>
                            <div class="back-prim tarif center-block" >
                                <span class="pull-left">Цена:</span>
                                <span class="pull-right">5000</span>
                            </div>
                        </div>
                        <div class="col-sm-4 pad-b30">
                            <img src="/imgs/tarif_3.png" class="img-responsive center-block">
                            <div class="center-block tarif-mid">
                                <div class="section pad-20">
                                    <span class="pull-left text-muted" style="width:90%">Кол-во посетителей:</span>
                                    <span class="pull-right" style="width:10%">50</span>
                                </div>
                                <div class="section pad-20">
                                    <span class="pull-left text-muted" style="width:90%">Кол-во сообщений:</span>
                                    <span class="pull-right" style="width:10%">50</span>
                                </div>
                                <div class="section pad-20">
                                    <span><img src="/imgs/line.png" class="img-responsive center-block"></span>
                                    <span class="pull-left text-muted" style="width:80%; padding-top: 5px;">Техподдержка:</span>
                                    <span class="pull-right" style="width:20%; padding-top: 5px;">mail</span>
                                </div>
                            </div>
                            <div class="back-pink tarif center-block" >
                                <span class="pull-left">Цена:</span>
                                <span class="pull-right">5000</span>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-lg-1 col-md-1 col-sm-1 col-xs-1"></div>
            </div>
            <div class="row" style="background-color: #a6a5a5;">
                <div class="col-lg-1 col-md-1 col-sm-1 col-xs-1"></div>
                <div class="col-lg-10 col-sm-10 col-md-10 col-xs-10">
                    <div class="back-foot"><span class="pull-right text-muted">Посетители Сотрудники Расписание Бухгалтерия Абонементы</span></div>
                </div>
                <div class="col-lg-1 col-md-1 col-sm-1 col-xs-1"></div>
            </div>
    </section>
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
                "email": $('input[name=mail]').val(),
                "password": $('input[name=password]').val(),
                "remember_me": $('input[name=remember_me]').is(':checked')
            };
            console.log(postData);
            $.ajax({
                type: 'POST',
                url: '',// /login
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