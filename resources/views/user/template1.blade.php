<html>
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0, maximum-scale=3.0, user-scalable=yes"/>
    <meta name="HandheldFriendly" content="true" />
    <meta name="apple-mobile-web-app-capable" content="YES" />
    <meta name="csrf-token" content="{{ csrf_token() }}">


    <title>PTI Health</title>
    <link rel="stylesheet" type="text/css" href="{{ asset('style.css')}}">
    
    <link rel="stylesheet" type="text/css" href="{{ asset('public/user/css/bootstrap.css')}}">
   <link rel="stylesheet" type="text/css" href="{{ asset('public/user/css/bootstrap-theme.css')}}">
    <link rel="stylesheet" type="text/css" href="{{ asset('public/guest/css/font-awesome.min.css')}}">
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.1.0/css/bootstrap.min.css">
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
    <link href='https://fonts.googleapis.com/css?family=Sofia' rel='stylesheet'>
    <link rel="stylesheet" href="https://www.w3schools.com/w3css/4/w3.css">

    <!-- All Fonts Here -->
    <link href='https://fonts.googleapis.com/css?family=Source+Sans+Pro' rel='stylesheet' type='text/css'>
    <link rel="stylesheet" type="text/css" href="http://fonts.googleapis.com/css?family=Raleway" />


    {{------------------------Untested Code Here--}}
    {{--<script src="{{ asset('js/app.js') }}"></script>--}}
    <script>
        window.Laravel =<?php echo json_encode([
            'csrfToken' => csrf_token(),
        ]); ?>

            window.Laravel.userId = <?php echo auth::user()->id; ?>
    </script>
    {{-----------------END---------------}}






<!-- // --------------------------------------------My Code Here-------------------------------------------------------------------- -->
    <link rel="stylesheet" type="text/css" href="{{ asset('public/user/custom_font/css/fontello.css')}}">
{{----}}




    
    
</head>
<body >
{{--<div id="app">--}}
<div id="header">
    <div class="container-fluid">
        <div class="row">
            <div class="col-md-12">
                <h1 class="logo"><a href="./"><img src="{{asset('public/guest/images/logo.png')}}" id="logo-img" /></a></h1>
            </div>
        </div>
    </div>
    <script>
        var APP_URL = {!! json_encode(url('/')) !!};
        console.log(APP_URL);
    </script>
</div>
<div class="sidenav fixed-left">
        {{--<a href="logged" class="loggedin-home-menu"><i class="demo-icon icon-home"></i></a>--}}
    <a href="{{url('/logged')}}" class="loggedin-home-menu"><i class="demo-icon icon-home"></i></a>
        <a href="{{url('/heart')}}" class="heart-menu"><i class="demo-icon icon-heart"></i></a>
        <a href="{{url('/all_alert')}}" class="all-alert-menu"><i class="demo-icon icon-notification allert-fa">
        <!-- </i><span class="badge" id="badge">5</span></a> -->
        </i></a>
        <a href="{{url('/calendar')}}" class="calendar-menu"><i class="demo-icon icon-event"></i></a>
        <a href="{{url('/userprofile')}}" class="edit-menu"><i class="demo-icon icon-edit_profile"></i></a>
        <a href="{{ route('logout') }}" class="logout-menu"  onclick="event.preventDefault();
                                                     document.getElementById('logout-form').submit();"><i class="demo-icon icon-logout"></i></a>

</div>
<form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
 @csrf</form>




    <div class="main transbox">
        @yield('content')
        <div id='footer-space'>
        </div>
    </div>
<!-- </div> -->
<div class="badge" id="badge1"></div>

<div id="footer">
    <div class="container-fluid">
        <div class="row">
            <div class="col-sm-8 col-8">
                <p>Copyright © 2018 PTI Wellbeing, All Rights Reserved.</p>
            </div>
            <div class="col-sm-4 col-4 text-right">
                <ul class="social-footer">
                    <li><a href="#"><i class="fa fa-facebook" aria-hidden="true"></i></a></li>
                    <li><a href="#"><i class="fa fa-twitter" aria-hidden="true"></i></a></li>
                </ul>
            </div>
        </div>
    </div>
</div>

{{--<script src="resources/assets/js/app.js" ></script>--}}
<script src="{{asset('public/user/notification_broadcast.js')}}"></script>
{{--</div>--}}
<script>
    var i=0;
</script>
</body>


