@extends('master')

@section('content')

    <div class="row">
        <div class="col-md-6 col-md-offset-3">
            <div class="panel panel-primary">
                <div class="panel-heading">
                    <h3 class="panel-title">Register</h3>
                </div>
                <div class="panel-body">
                    <form action="/register" method="post">
                        {{ csrf_field() }}
                        <div class="form-group">
                            <div class="input-group">
                                <span class="input-group-addon"><i class="fa fa-envelope"></i></span>
                                <input type="email" name="email" class="form-control" placeholder="example@example.com">
                            </div>
                        </div>
                        <div class="form-group">
                            <div class="input-group">
                                <span class="input-group-addon"><i class="fa fa-user"></i></span>
                                <input type="text" name="first_name" class="form-control" placeholder="First name">
                            </div>
                        </div>
                        <div class="form-group">
                            <div class="input-group">
                                <span class="input-group-addon"><i class="fa fa-user"></i></span>
                                <input type="text" name="last_name" class="form-control" placeholder="Last name">
                            </div>
                        </div>
                        <div class="form-group">
                            <div class="input-group">
                                <span class="input-group-addon"><i class="fa fa-lock"></i></span>
                                <input type="password" name="password" class="form-control" placeholder="password">
                            </div>
                        </div>
                        <div class="form-group">
                            <div class="input-group">
                                <span class="input-group-addon"><i class="fa fa-lock"></i></span>
                                <input type="password" name="password_confirmation" class="form-control" placeholder="Confirm password">
                            </div>
                        </div>
                        <div class="form-group">
                                <input type="submit" class="btn btn-success pull-right" value="Register">
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>

@stop
<div id="register">
    <!---->
    <div class="left_block">
        <div class="logo">
            <a href="#"><img src="/imgs/logo.png" width="80%" alt="" /></a>
        </div>
        <div class="reg_title">Проверьте свою электронную почту!</div>
        <div class="space6"></div>
        <div class="reg_info">Мы отправили шестизначный код подтверждения на katyarka2006@mail.ru. Введите его ниже, чтобы подтвердить адрес электронной почты.</div>
        <form action="" id="reg_form">
            <div class="form-group">
                <label class="control-label" for="email">&nbsp;</label>
                <input class="form-control" id="email" aria-describedby="inputGroupSuccess1Status" data-toggle="tooltip" data-placement="bottom" data-html="true" title="" data-empty="Заполните поле" data-email="Некорректный адрес эл. почты" name="email">
                <span class="glyphicon glyphicon-remove form-control-feedback hidden" aria-hidden="true"></span>
                <span class="sr-only" id="inputGroupSuccess1Status">(error)</span>
            </div>
            <div class="text-center"><button type="button" id="btnSubmit" class="btn">Далее <span class="glyphicon glyphicon-arrow-right" aria-hidden="true"></span></button></div>
        </form>
        <div class="space6"></div>
        <div class="reg_info">Не забудьте оставить это окно открытым во время проверки вашего кода.</div>
    </div>
    <div class="right_block reg_2"></div>
    <!---->
    <div class="left_block reg_3"></div>
    <div class="right_block">
        <div class="reg_title">Давайте знакомиться!</div>
        <div class="space6"></div>
        <div class="reg_info">Ваше имя будет отображаться вместе с вашими сообщениями</div>
        <form action="" id="reg_form">
            <div class="form-group">
                <label class="control-label" for="name">Ваше имя:</label>
                <input class="form-control" id="name" aria-describedby="inputGroupSuccess1Status" data-toggle="tooltip" data-placement="bottom" data-html="true" title="" data-empty="Заполните поле" name="name">
                <span class="glyphicon glyphicon-remove form-control-feedback hidden" aria-hidden="true"></span>
                <span class="sr-only" id="inputGroupSuccess1Status">(error)</span>
            </div>
            <div class="form-group">
                <label class="control-label" for="surname">Ваше фамилия:</label>
                <input class="form-control" type="text" id="surname" aria-describedby="inputGroupSuccess1Status" data-toggle="tooltip" data-placement="bottom" data-html="true" title="" data-empty="Заполните поле" name="surname">
                <span class="glyphicon glyphicon-remove form-control-feedback hidden" aria-hidden="true"></span>
                <span class="sr-only" id="inputGroupSuccess1Status">(error)</span>
            </div>
            <div class="text-center"><button type="button" id="btnSubmit" class="btn">Далее <span class="glyphicon glyphicon-arrow-right" aria-hidden="true"></span></button></div>
        </form>
    </div>
   <!---->
    <div class="left_block reg_4"></div>
    <div class="right_block">
        <div class="reg_title">Введите название компании и поддомена</div>
        <div class="space6"></div>
        <form action="" id="reg_form">
            <div class="form-group">
                <label class="control-label" for="company">Название компании:</label>
                <input class="form-control" type="text" id="company" aria-describedby="inputGroupSuccess1Status" data-toggle="tooltip" data-placement="bottom" data-html="true" title="" data-empty="Заполните поле" name="company">
                <span class="glyphicon glyphicon-remove form-control-feedback hidden" aria-hidden="true"></span>
                <span class="sr-only" id="inputGroupSuccess1Status">(error)</span>
            </div>
            <div class="form-group">
                <label class="control-label" for="sub">Название поддомена:</label>
                <input class="form-control" id="sub" aria-describedby="inputGroupSuccess1Status" data-toggle="tooltip" data-placement="bottom" data-html="true" title="" data-empty="Заполните поле" name="sub">
                <span class="glyphicon glyphicon-remove form-control-feedback hidden" aria-hidden="true"></span>
                <span class="sr-only" id="inputGroupSuccess1Status">(error)</span>
            </div>
            <div class="text-center"><button type="button" id="btnSubmit" class="btn">Далее <span class="glyphicon glyphicon-arrow-right" aria-hidden="true"></span></button></div>
        </form>
    </div>
    <!---->
    <div class="top" style="width:100%; height:600px; background-color: #dddcdc;">
        <div class="left_part" style="width:40%; background-color: #dddcdc; float:left;">
            <div class="reg_title" style="font-size: 40px;">Мы поможем Вам<br>
                легко управлять <br>
                Вашим бизнесом</div>
            <div class="form-group row">

                <label class="control-label" for="company">Адрес вашей электронной почты</label>
                <div class="col-sm-10">
                    <input class="form-control" type="text" placeholder="Заполните поле" name="owner">

                    <span class="glyphicon glyphicon-remove form-control-feedback hidden" aria-hidden="true"></span>
                    <span class="sr-only" id="inputGroupSuccess1Status">(error)</span>
                </div>
                <div class="col-sm-2">
                    <button type="button" class="btn btn-primary">Create</button>
                </div>
            </div>


        </div>
        <div class="right_part"><img src="/imgs/top_right.png" style="width:60%; margin-top:20px">
        </div>
    </div>
    <div class="" style="width:100%; height: 600px;"><!--1920px-->
        <!--<div class="left_block" style="background-color:#334e7a; width:60%;" >
            <img src="/imgs/page/middle.png">
        </div>

        <div class="right_block" style="width:40%; " >
        </div>-->
        <div class="carousel slide" data-interval="4000" data-ride="carousel" id="custom_carousel">
            <!-- Wrapper for slides -->
            <div class="carousel-inner">
                <div class="item active">
                    <div class="container-fluid">
                        <div class="row">
                            <div class="top col-md-7 col-xs-12 text-center" style="background-color: #334e7a;"><img src="/imgs/page/slider_1.png" class="img-responsive"></div>
                            <div class="content col-md-5 col-xs-12">
                                <h2>Slide 1</h2>
                                <p>Lorem ipsum dolor sit amet, consectetur adipisicing elit. Animi, labore, magni illum nemo ipsum quod voluptates ab natus nulla possimus incidunt aut neque quaerat mollitia perspiciatis assumenda asperiores consequatur soluta.</p><p>Lorem ipsum dolor sit amet, consectetur adipisicing elit. Animi, labore, magni illum nemo ipsum quod voluptates ab natus nulla possimus incidunt aut neque quaerat mollitia perspiciatis assumenda asperiores consequatur soluta.</p>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="item">
                    <div class="container-fluid">
                        <div class="row">
                            <div class="top col-md-7 col-xs-12 text-center" style="background-color: #334e7a;"><img src="/imgs/page/slider_2.png" class="img-responsive"></div>
                            <div class="content col-md-5 col-xs-12">
                                <h2>Slide 2</h2>
                                <p>Lorem ipsum dolor sit amet, consectetur adipisicing elit. Animi, labore, magni illum nemo ipsum quod voluptates ab natus nulla possimus incidunt aut neque quaerat mollitia perspiciatis assumenda asperiores consequatur soluta.</p><p>Lorem ipsum dolor sit amet, consectetur adipisicing elit. Animi, labore, magni illum nemo ipsum quod voluptates ab natus nulla possimus incidunt aut neque quaerat mollitia perspiciatis assumenda asperiores consequatur soluta.</p>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="item">
                    <div class="container-fluid">
                        <div class="row">
                            <div class="top col-md-7 col-xs-12 text-center" style="background-color: #334e7a;"><img src="/imgs/page/slider_3.png" class="img-responsive"></div>
                            <div class="content col-md-5 col-xs-12">
                                <h2>Slide 3</h2>
                                <p>Lorem ipsum dolor sit amet, consectetur adipisicing elit. Animi, labore, magni illum nemo ipsum quod voluptates ab natus nulla possimus incidunt aut neque quaerat mollitia perspiciatis assumenda asperiores consequatur soluta.</p><p>Lorem ipsum dolor sit amet, consectetur adipisicing elit. Animi, labore, magni illum nemo ipsum quod voluptates ab natus nulla possimus incidunt aut neque quaerat mollitia perspiciatis assumenda asperiores consequatur soluta.</p>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="item">
                    <div class="container-fluid">
                        <div class="row">
                            <div class="top col-md-7 col-xs-12 text-center" style="background-color: #334e7a;"><img src="/imgs/page/slider_4.png" class="img-responsive"></div>
                            <div class="content col-md-5 col-xs-12">
                                <h2>Slide 1</h2>
                                <p style="" class="text-success">  Мы поможем Вам управлять списком
                                    Ваших посетителей:
                                    добавление новых, редактирование ранее
                                    зарегестрированных, удаление.</p>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="item">
                    <div class="container-fluid">
                        <div class="row">
                            <div class="top col-md-7 col-xs-12 text-center" style="background-color: #334e7a;"><img src="/imgs/page/slider_5.png" class="img-responsive"></div>
                            <div class="content col-md-5 col-xs-12">
                                <h2>Slide 2</h2>
                                <p>Lorem ipsum dolor sit amet, consectetur adipisicing elit. Animi, labore, magni illum nemo ipsum quod voluptates ab natus nulla possimus incidunt aut neque quaerat mollitia perspiciatis assumenda asperiores consequatur soluta.</p><p>Lorem ipsum dolor sit amet, consectetur adipisicing elit. Animi, labore, magni illum nemo ipsum quod voluptates ab natus nulla possimus incidunt aut neque quaerat mollitia perspiciatis assumenda asperiores consequatur soluta.</p>
                            </div>
                        </div>
                    </div>
                </div>

                <!-- End Item -->
            </div>
            <!--<a data-slide="prev" href="#custom_carousel" class="izq carousel-control">‹</a>
            <a data-slide="next" href="#custom_carousel" class="der carousel-control">›</a>-->
            <a data-slide="prev" href="#custom_carousel" class="left carousel-control"><i class="fa fa-chevron-left"></i></a>
            <a data-slide="next" href="#custom_carousel" class="right carousel-control"><i class="fa fa-chevron-right"></i></a>
            <!-- End Carousel Inner -->

        </div>
        <!-- End Carousel -->
        <script src="main2.js"  type="text/javascript"></script>
    </div>
    <div class="" style="width:100%; height: 600px; background-color: #dddcdc;">
        <div class="" style="width:65%; height: 70px; background-color: #73a1ec; border-radius:35px 0 0 35px; margin-left: 444px; margin-top: 25px;">

        </div>
        <div class="" style="width:75%; height: 70px; background-color: #53b5d1; border-radius:0 35px 35px 0; margin-left: 0px; margin-top: 25px;">

        </div>
        <div class="" style="width:80%; height: 70px; background-color: #40c9b4; border-radius:35px 0 0 35px; margin-left: 254px; margin-top: 25px;">

        </div>
    </div>

    <div class="left_block reg_4"></div>
    <div class="right_block">
        <div class="reg_title">Введите название компании и поддомена</div>
        <div class="space6"></div>
        <form action="" id="reg_form">
            <div class="form-group">
                <label class="control-label" for="company">Название компании:</label>
                <input class="form-control" type="text" id="company" aria-describedby="inputGroupSuccess1Status" data-toggle="tooltip" data-placement="bottom" data-html="true" title="" data-empty="Заполните поле" name="company">
                <span class="glyphicon glyphicon-remove form-control-feedback hidden" aria-hidden="true"></span>
                <span class="sr-only" id="inputGroupSuccess1Status">(error)</span>
            </div>
            <div class="form-group">
                <label class="control-label" for="sub">Название поддомена:</label>
                <input class="form-control" id="sub" aria-describedby="inputGroupSuccess1Status" data-toggle="tooltip" data-placement="bottom" data-html="true" title="" data-empty="Заполните поле" name="sub">
                <span class="glyphicon glyphicon-remove form-control-feedback hidden" aria-hidden="true"></span>
                <span class="sr-only" id="inputGroupSuccess1Status">(error)</span>
            </div>
            <div class="text-center"><button type="button" id="btnSubmit" class="btn">Далее <span class="glyphicon glyphicon-arrow-right" aria-hidden="true"></span></button></div>
        </form>
    </div>
        <!---->
    <div class="left_block">
        <div class="logo">
            <a href="#"><img src="/imgs/logo.png" width="80%" alt="" /></a>
        </div>
        <div class="reg_title">Создать компанию</div>
        <form action="" id="reg_form">
            <div class="form-group">
                <label class="control-label" for="email">Адрес вашей эл. почты:</label>
                <input class="form-control" id="email" value="<?= isset($_POST['mail'])? trim($_POST['mail']): ''; ?>" aria-describedby="inputGroupSuccess1Status" data-toggle="tooltip" data-placement="bottom" data-html="true" title="" data-empty="Заполните поле" data-email="Некорректный адрес эл. почты" name="email">
                <span class="glyphicon glyphicon-remove form-control-feedback hidden" aria-hidden="true"></span>
                <span class="sr-only" id="inputGroupSuccess1Status">(error)</span>
            </div>
            <div class="form-group">
                <label class="control-label" for="pwd">Пароль:</label>
                <input class="form-control" type="password" id="pwd" aria-describedby="inputGroupSuccess1Status" data-toggle="tooltip" data-placement="bottom" data-html="true" title="" data-empty="Заполните поле" data-lenght="Слишком короткий пароль" name="password">
                <span class="glyphicon glyphicon-remove form-control-feedback hidden" aria-hidden="true"></span>
                <span class="sr-only" id="inputGroupSuccess1Status">(error)</span>
            </div>
            <div class="form-group">
                <label class="control-label" for="conf_pwd">Повторите пароль:</label>
                <input class="form-control" type="password" id="conf_pwd" aria-describedby="inputGroupSuccess1Status" data-toggle="tooltip" data-placement="bottom" data-html="true" title="" data-empty="Заполните поле" data-confirm="Пароли не совпадают" name="confirm_password">
                <span class="glyphicon glyphicon-remove form-control-feedback hidden" aria-hidden="true"></span>
                <span class="sr-only" id="inputGroupSuccess1Status">(error)</span>
            </div>
            <div class="text-center"><button type="button" id="btnSubmit" class="btn">Далее <span class="glyphicon glyphicon-arrow-right" aria-hidden="true"></span></button></div>
        </form>
    </div>
    <div class="right_block reg_1"></div>
    <!---->
</div>
