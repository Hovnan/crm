<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>Narrow Jumbotron Template for Bootstrap</title>
    <!-- Bootstrap core CSS -->
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css">

    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css">
    <!-- Custom styles for this template
    <link href="http://getbootstrap.com/examples/jumbotron-narrow/jumbotron-narrow.css" rel="stylesheet">-->
    <link rel="stylesheet" type="text/css" href="/style/style.css" />
    <link rel="stylesheet" type="text/css" href="/style/slider.css" />
</head>
<body>
<div id="sb-site" class="maincontent">
    <div class="wrapper">
        <div id="header" class="menu">

            <div class="side_menu">
                <div class="icon sb_open"><img src="/imgs/burger_icon.png" alt="" /></div>
                <div class="icon visitors" title="Посетители"><a href="#" data-toggle="modal" data-target="#add_modal"><span>Посетители</span><img src="/imgs/visitors_icon.png" alt="" /></a></div>
                <div class="icon employees" title="Сотрудники"><a href="#" data-toggle="modal" data-target="#add_modal"><span>Сотрудники</span><img src="/imgs/employees_icon.png" alt="" /></a></div>
                <div class="icon accounting" title="Бухгалтерия"><a href="#" data-toggle="modal" data-target="#add_modal"><span>Бухгалтерия</span><img src="/imgs/schedule_icon.png" alt="" /></a></div>
                <div class="icon timetable" title="Расписание"><a href="#" data-toggle="modal" data-target="#add_modal"><span>Расписание</span><img src="/imgs/bookkeeping_icon.png" alt="" /></a></div>
                <div class="icon timetable" title="Расписание"><a href="#" data-toggle="modal" data-target="#add_modal"><span>Занятия</span><img src="/imgs/lessons_icon.png" alt="" /></a></div>
                <div class="icon timetable" title="Расписание"><a href="#" data-toggle="modal" data-target="#add_modal"><span>Заявки</span><img src="/imgs/request_icon.png" alt="" /></a></div>
                <div class="icon abonements" title="Абонементы"><a href="#" data-toggle="modal" data-target="#add_modal"><span>Абонементы</span><img src="/imgs/abonements_icon.png" alt="" /></a></div>
            </div>
            <nav class="navbar navbar-default navbar-fixed-left mobile_menu" role="navigation">
                <div class="sb-toggle-left navbar-left">
                    <div class="navicon-line"></div>
                    <div class="navicon-line"></div>
                    <div class="navicon-line"></div>
                    <div class="navicon-line"></div>
                </div>
            </nav>
            <div class="logo hide">
                <a href="#" data-toggle="modal" data-target="#add_modal"><img src="/imgs/logo.png" width="80%" alt="" /></a>
            </div>
            <div class="menu">
                <div class="pull-left">
                    <div class="company">{{ $company->name }}</div>
                    <div class="acc">
                        <div class="title"><a href="#" data-toggle="modal" data-target="#add_modal">{{ $user->first_name .' '. $user->last_name }}</a></div>
                        <div class="info">{{ $role }}</div>
                    </div>
                </div>
                <div class="pull-right">
                    <div class="dropdown">
                        <div class="dropdown-toggle vertical-align" type="button" data-toggle="dropdown">
                            <div class="pull-left">Текуший филиал<br><b>Partners</b></div>
                            <span class="glyphicon glyphicon-chevron-down" aria-hidden="true"></span>
                            <div class="clear"></div>
                        </div>
                        <ul class="dropdown-menu">
                            <li><a href="#" data-toggle="modal" data-target="#add_modal">fil_2</a></li>
                            <li><a href="#" data-toggle="modal" data-target="#add_modal">fil_3</a></li>
                            <li>
                                <form action="/logout" method="post" id="logout-form">
                                    {{ csrf_field() }}
                                    <a href="#" onclick="document.getElementById('logout-form').submit()">Logout</a>
                                </form>
                            </li>
                        </ul>
                    </div>
                </div>
                <div class="clear"></div>
                <div class="space6"></div>
            </div>
            <div class="clear"></div>
        </div>

        <!-- Modal -->
        <div class="modal fade" id="add_modal" role="dialog" >
            <div class="modal-dialog modal-md">
                <div class="modal-content text-muted border-0">
                    <div class="modal-header z-type">
                        <button type="button" class="close" data-dismiss="modal">&times;</button>
                        <div class="container-fluid">
                            <!-- Контейнер, в котором можно создавать классы системы сеток -->
                            <div class="row">
                                <div class="col-md-12">
                                    <h3 class="modal-title">Добавить Филиала</h3>
                                    <span class="f-type">Для дальнейших действий Вам необходимо создать филиал</span>
                                </div>
                            </div>
                        </div>
                    </div>

                    <form action="{{ route('branches.store') }}" method="post">
                        {{ csrf_field() }}
                        <input type="hidden" name="company_id" value="{{ $company->id }}">
                    <div class="modal-body">
                        <div class="container-fluid">
                            <!-- Контейнер, в котором можно создавать классы системы сеток -->
                            <div class="row pad-b10">
                                <div class="col-xs-8">
                                    <p>Название Филиала*</p>
                                    <input type="text" class="form-control" id="email" name="name">
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-xs-8">
                                    <p>Адрес*</p>
                                    <input type="text" class="form-control" name="address">
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="modal-footer x-type">
                        <div class="container-fluid">
                            <div class="row">
                                <div class="col-md-8">
                                    <button type="submit" class="btn btn-info pull-left btn-cust" onclick="addFilial()">Добавить <i class="fa fa-arrow-right" aria-hidden="true"></i></button>
                                </div>
                            </div>
                        </div>
                    </div>
                    </form>
                </div>
            </div>
        </div>
        <!-- / Modal -->
<div class="container">
    @include('layouts.top-menu')

    @yield('content')

</div> <!-- /container -->

    </div>
</div>
    <script type="text/javascript" src="https://ajax.googleapis.com/ajax/libs/jquery/3.1.1/jquery.min.js"></script>
    <script type="text/javascript" src="/js/bootstrap.min.js"></script>
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

        $('document').ready(function(){
            $('#add_modal').modal("show");
        });
    </script>
</body></html>
