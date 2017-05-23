<!DOCTYPE HTML>
<!--https://w3layouts.com/easy-admin-panel-flat-bootstrap-responsive-web-template/-->
<html>
<head>
    <title>CRM</title>
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <meta name="keywords" content="" />

    <link href="/css/bootstrap.min.css" rel="stylesheet">
    <!-- Custom CSS -->
    <link href="/css/style.css" rel='stylesheet' type='text/css' />
    <!-- Graph CSS -->
    <link href="/css/font-awesome.css" rel="stylesheet">
    <!-- jQuery -->
    <!-- lined-icons -->
    <link rel="stylesheet" href="/css/icon-font.min.css" type='text/css' />
    <!-- //lined-icons -->
    <!--animate-->
    <link href="/css/animate.css" rel="stylesheet" type="text/css" media="all">
    <link href="/style/jquery-ui.css" rel="stylesheet" type="text/css">
</head>

<!--<body class="sticky-header left-side-collapsed"  onload="initMap()">-->
<body class="sticky-header left-side-collapsed">
<section>
    <!-- left side start-->
    <div class="left-side sticky-left-side" id="swd">
        <!--logo and iconic logo start--><!--
        <div class="logo">
            <h1><a href="http://bricoliege.be">Brico <span>Liege</span></a></h1>
        </div>
        <div class="logo-icon text-center">
           <a href="#" ><i class="lnr lnr-menu"></i> </a>
        </div>-->
        <!--logo and iconic logo end-->
        <div class="left-side-inner">
            <!--sidebar nav start-->
            <ul class="nav nav-pills nav-stacked custom-nav">
                <li><a id="menyushka" class="toggle-btn  menu-collapsed"><img src="/imgs/burger_icon.png" alt="Menu"></a></li>

                <li class="menu-list {{ $active == 'dashboard'? 'active' : '' }}"><a data-toggle="tooltip" title="Главная" {{ $branch ? 'href=/dashboard/'.$branch->id : 'href=/dashboard' }}> <!--class="toggle-btn menu-collapsed"--><img src="/imgs/home_icon.png" alt=""><span>Главная</span></a></li>

                <li class="menu-list {{ $active == 'customers'? 'active' : '' }}">
                    <a data-toggle="tooltip" title="Посетители" {{ $branch ? 'href=/customers/'.$branch->id : "href=# data-toggle=modal data-target=#add_modal" }}><img src="/imgs/visitors_icon.png" alt="Посетители">
                        <span>Посетители</span>
                    </a>
                </li>
                <li class="menu-list {{ $active == 'employees'? 'active' : '' }}">
                    <a data-toggle="tooltip" title="Сотрудники" {{ $branch ? 'href=/employees/'.$branch->id : "href=# data-toggle=modal data-target=#add_modal" }}><img src="/imgs/employees_icon.png" alt="Сотрудники">
                        <span>Сотрудники</span>
                    </a>
                </li>
                <li class="menu-list {{ $active == 'accountings'? 'active' : '' }}">
                    <a data-toggle="tooltip" title="Бухгалтерия" {{ $branch ? 'href=/accountings/'.$branch->id : "href=# data-toggle=modal data-target=#add_modal" }}><img src="/imgs/bookkeeping_icon.png" alt="Бухгалтерия">
                        <span>Бухгалтерия</span>
                    </a>
                </li>
                <li class="menu-list {{ $active == 'timetables'? 'active' : '' }}">
                    <a data-toggle="tooltip" title="Расписание" {{ $branch ? 'href=/timetables/'.$branch->id : "href=# data-toggle=modal data-target=#add_modal" }}><img src="/imgs/schedule_icon.png" alt="Расписание">
                        <span>Расписание</span>
                    </a>
                </li>
                <li class="menu-list {{ $active == 'trainings'? 'active' : '' }}">
                    <a data-toggle="tooltip" title="Занятия" {{ $branch ? 'href=/trainings/'.$branch->id : "href=# data-toggle=modal data-target=#add_modal" }}><img src="/imgs/lessons_icon.png" alt="Занятия">
                        <span>Занятия</span>
                    </a>
                </li>
                <li class="menu-list {{ $active == 'requests'? 'active' : '' }}">
                    <a data-toggle="tooltip" title="Заявки" {{ $branch ? 'href=/requests/'.$branch->id : "href=# data-toggle=modal data-target=#add_modal" }}><img src="/imgs/request_icon.png" alt="Заявки">
                        <span>Заявки</span>
                    </a>
                </li>
                <li class="menu-list {{ $active == 'subscribers'? 'active' : '' }}">
                    <a data-toggle="tooltip" title="Абонементы" {{ $branch ? 'href=/subscribers/'.$branch->id : "href=# data-toggle=modal data-target=#add_modal" }}><img src="/imgs/abonements_icon.png" alt="Абонементы">
                        <span>Абонементы</span>
                    </a>
                </li>
            </ul>
            <!--sidebar nav end-->
        </div>
    </div>
    <!-- left side end-->

    <!-- main content start-->
    <!--New content-->
    <div class="main-content">
        <!-- header-starts -->
        <div class="header-section">
            <!--notification menu start -->
            <div class="menu-right">
                <div class="user-panel-top">
                    <div class="profile_details_left">
                        <div class="user-name">
                            <p>{{ $branch ? $branch->name : 'No Branch' }}</p>
                        </div>
                        <!--<ul class="nofitications-dropdown">
                            <li class="dropdown">
                                <a href="#" class="dropdown-toggle" data-toggle="dropdown" aria-expanded="false"><i class="fa fa-envelope"></i><span class="badge">3</span></a>

                                <ul class="dropdown-menu">
                                    <li>
                                        <div class="notification_header">
                                            <h3>You have 3 new messages</h3>
                                        </div>
                                    </li>
                                    <li><a href="#">
                                            <div class="user_img"><img src="/images/1.png" alt=""></div>
                                            <div class="notification_desc">
                                                <p>Lorem ipsum dolor sit amet</p>
                                                <p><span>1 hour ago</span></p>
                                            </div>
                                            <div class="clearfix"></div>
                                        </a></li>
                                    <li class="odd"><a href="#">
                                            <div class="user_img"><img src="/images/1.png" alt=""></div>
                                            <div class="notification_desc">
                                                <p>Lorem ipsum dolor sit amet </p>
                                                <p><span>1 hour ago</span></p>
                                            </div>
                                            <div class="clearfix"></div>
                                        </a></li>
                                    <li><a href="#">
                                            <div class="user_img"><img src="/images/1.png" alt=""></div>
                                            <div class="notification_desc">
                                                <p>Lorem ipsum dolor sit amet </p>
                                                <p><span>1 hour ago</span></p>
                                            </div>
                                            <div class="clearfix"></div>
                                        </a></li>
                                    <li>
                                        <div class="notification_bottom">
                                            <a href="#">See all messages</a>
                                        </div>
                                    </li>
                                </ul>
                            </li>
                            <li class="login_box" id="loginContainer">
                                <div class="search-box">
                                    <div id="sb-search" class="sb-search">
                                        <form>
                                            <input class="sb-search-input" placeholder="Enter your search term..." type="search" id="search">
                                            <input class="sb-search-submit" type="submit" value="">
                                            <span class="sb-icon-search"> </span>
                                        </form>
                                    </div>
                                </div>
                                <!-- search-scripts --><!--
                                <script src="/js/classie.js"></script>
                                <script src="/js/uisearch.js"></script>
                                <script>
                                    new UISearch(document.getElementById('sb-search'));
                                </script>
                                <!-- //search-scripts --><!--
                            </li>
                            <li class="dropdown">
                                <a href="#" class="dropdown-toggle" data-toggle="dropdown" aria-expanded="false"><i class="fa fa-bell"></i><span class="badge blue">3</span></a>
                                <ul class="dropdown-menu">
                                    <li>
                                        <div class="notification_header">
                                            <h3>You have 3 new notification</h3>
                                        </div>
                                    </li>
                                    <li><a href="#">
                                            <div class="user_img"><img src="/images/1.png" alt=""></div>
                                            <div class="notification_desc">
                                                <p>Lorem ipsum dolor sit amet</p>
                                                <p><span>1 hour ago</span></p>
                                            </div>
                                            <div class="clearfix"></div>
                                        </a></li>
                                    <li class="odd"><a href="#">
                                            <div class="user_img"><img src="/images/1.png" alt=""></div>
                                            <div class="notification_desc">
                                                <p>Lorem ipsum dolor sit amet </p>
                                                <p><span>1 hour ago</span></p>
                                            </div>
                                            <div class="clearfix"></div>
                                        </a></li>
                                    <li><a href="#">
                                            <div class="user_img"><img src="/images/1.png" alt=""></div>
                                            <div class="notification_desc">
                                                <p>Lorem ipsum dolor sit amet </p>
                                                <p><span>1 hour ago</span></p>
                                            </div>
                                            <div class="clearfix"></div>
                                        </a></li>
                                    <li>
                                        <div class="notification_bottom">
                                            <a href="#">See all notification</a>
                                        </div>
                                    </li>
                                </ul>
                            </li>
                            <li class="dropdown">
                                <a href="#" class="dropdown-toggle" data-toggle="dropdown" aria-expanded="false"><i class="fa fa-first-order"></i><span class="badge blue1">22</span></a>
                                <ul class="dropdown-menu">
                                    <li>
                                        <div class="notification_header">
                                            <h3>You have 8 pending task</h3>
                                        </div>
                                    </li>
                                    <li><a href="#">
                                            <div class="task-info">
                                                <span class="task-desc">Database update</span><span class="percentage">40%</span>
                                                <div class="clearfix"></div>
                                            </div>
                                            <div class="progress progress-striped active">
                                                <div class="bar yellow" style="width:40%;"></div>
                                            </div>
                                        </a></li>
                                    <li><a href="#">
                                            <div class="task-info">
                                                <span class="task-desc">Dashboard done</span><span class="percentage">90%</span>
                                                <div class="clearfix"></div>
                                            </div>

                                            <div class="progress progress-striped active">
                                                <div class="bar green" style="width:90%;"></div>
                                            </div>
                                        </a></li>
                                    <li><a href="#">
                                            <div class="task-info">
                                                <span class="task-desc">Mobile App</span><span class="percentage">33%</span>
                                                <div class="clearfix"></div>
                                            </div>
                                            <div class="progress progress-striped active">
                                                <div class="bar red" style="width: 33%;"></div>
                                            </div>
                                        </a></li>
                                    <li><a href="#">
                                            <div class="task-info">
                                                <span class="task-desc">Issues fixed</span><span class="percentage">80%</span>
                                                <div class="clearfix"></div>
                                            </div>
                                            <div class="progress progress-striped active">
                                                <div class="bar  blue" style="width: 80%;"></div>
                                            </div>
                                        </a></li>
                                    <li>
                                        <div class="notification_bottom">
                                            <a href="#">See all pending task</a>
                                        </div>
                                    </li>
                                </ul>
                            </li>
                            <div class="clearfix"></div>
                        </ul>-->
                    </div>
                    <div class="profile_details">
                        <ul>
                            <li class="dropdown profile_details_drop">
                                <a href="#" class="dropdown-toggle" data-toggle="dropdown" aria-expanded="false">
                                    <div class="profile_img">
                                        <!--<span style="background:url(/template/admin_images/1.jpg) no-repeat center"> </span>
                                        --><div class="user-name">
                                            <p>{{ $user->first_name . ' ' .$user->last_name }}<span>{{ $record? $record->role : 'Owner' }}</span></p>
                                        </div>
                                        <i class="lnr lnr-chevron-down"></i>
                                        <i class="lnr lnr-chevron-up"></i>
                                        <div class="clearfix"></div>
                                    </div>
                                </a>
                                <ul class="dropdown-menu drp-mnu">
                                    <li> <a href="#"><i class="fa fa-cog"></i> Settings</a> </li>
                                    <li> <a href="{{ $branch ? route('dashboard.profile', ['branch' => $branch->id]) : '#' }}"><i class="fa fa-user"></i>Профиль</a> </li>
                                    <li>
                                        <form action="/logout" method="post" id="logout-form">
                                            {{ csrf_field() }}
                                            <a href="#" onclick="document.getElementById('logout-form').submit()" style="color: black;"><i class="fa fa-sign-out"></i> Выйти</a>
                                        </form>
                                    </li>
                                </ul>
                            </li>
                            <div class="clearfix"> </div>
                        </ul>
                    </div>
                </div>
            </div>
            <!--notification menu end -->
        </div>
        <!-- //header-ends -->
        @yield('content')
    </div>
    <!--/new content-->

</section>
<script src="/js/jquery.js" type="text/javascript"></script>
<script src="/js/bootstrap.min.js" type="text/javascript"></script>
<script src="/js/scripts.js" type="text/javascript"></script>
<script src="/js/jquery.mask.min.js"></script>
<script type="text/javascript">
    $(document).ready(function(){
        $('[data-toggle="tooltip"]').tooltip();
    });
</script>
@yield('scripts')

</div>
</body>
</html>