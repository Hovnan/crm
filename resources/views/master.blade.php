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
    <link href="/style/slider.css" rel="stylesheet" type="text/css">
    <link href="/style/style.css" rel="stylesheet" type="text/css">
</head>

<!--<body class="sticky-header left-side-collapsed"  onload="initMap()">-->
<body class="sticky-header left-side-collapsed">
<section>

        @yield('content')

</section>
<script src="/js/jquery.js" type="text/javascript"></script>
<script src="/js/bootstrap.min.js" type="text/javascript"></script>
<script src="/js/scripts.js" type="text/javascript"></script>
<script type="text/javascript">
    $(document).ready(function(){
        $('.nmn').css('min-height', $(window).height());
    });
</script>
@yield('scripts')
</body>
</html>