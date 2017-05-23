<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>CRM</title>
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
                <div class="icon visitors" title="Посетители"><a href="/visitors/"><span>Посетители</span><img src="/imgs/visitors_icon.png" alt="" /></a></div>
                <div class="icon employees" title="Сотрудники"><a href="/employees/"><span>Сотрудники</span><img src="/imgs/employees_icon.png" alt="" /></a></div>
                <div class="icon accounting" title="Бухгалтерия"><a href="/accounting/"><span>Бухгалтерия</span><img src="/imgs/schedule_icon.png" alt="" /></a></div>
                <div class="icon timetable" title="Расписание"><a href="/timetable/"><span>Расписание</span><img src="/imgs/bookkeeping_icon.png" alt="" /></a></div>
                <div class="icon timetable" title="Расписание"><a href="/classes/"><span>Занятия</span><img src="/imgs/lessons_icon.png" alt="" /></a></div>
                <div class="icon timetable" title="Расписание"><a href="/request/"><span>Заявки</span><img src="/imgs/request_icon.png" alt="" /></a></div>
                <div class="icon abonements" title="Абонементы"><a href="/abonements/"><span>Абонементы</span><img src="/imgs/abonements_icon.png" alt="" /></a></div>
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
                <a href="#"><img src="/imgs/logo.png" width="80%" alt="" /></a>
            </div>
            <div class="menu">
                <div class="pull-left">
                    <div class="company">{{ $company->name }}</div>
                    <div class="acc">
                        <div class="title"><a href="{{ route($role.'.profile', ['company' => $company->id, 'branch' => $branch->id]) }}">{{ ($user->first_name || $user->last_name)? $user->first_name .' '. $user->last_name: 'Set last_name and First_name' }}</a></div>
                        <div class="info">{{ $role }}</div>
                    </div>
                </div>
                <div class="pull-right">
                    <div class="dropdown">
                        <div class="dropdown-toggle vertical-align" type="button" data-toggle="dropdown">
                            <div class="pull-left">Текуший филиал<br><b>{{ $branch->name }}</b></div>
                            <span class="glyphicon glyphicon-chevron-down" aria-hidden="true"></span>
                            <div class="clear"></div>
                        </div>
                        <ul class="dropdown-menu">
                            @if($user->branches()->first())
                                @foreach($user->branches as $br)
                                    @if($br->id == $branch->id) @continue @endif
                                    <li><a href="{{ route($user->role[$br->id].'.profile', ['company' => $br->company_id, 'branch' => $br->id]) }}"> {{ $br->name }}</a></li>
                                @endforeach
                            @endif
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
<div class="container">
    @include('layouts.top-menu')

    @yield('content')

</div> <!-- /container -->

    <script type="text/javascript" src="https://ajax.googleapis.com/ajax/libs/jquery/3.1.1/jquery.min.js"></script>
    <script type="text/javascript" src="/js/bootstrap.min.js"></script>
        @yield('scripts')
    </div>
    </div></body></html>

