<html>
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0, maximum-scale=3.0, user-scalable=yes"/>
    <meta name="HandheldFriendly" content="true" />
    <meta name="apple-mobile-web-app-capable" content="YES" />
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>PTI Health</title>

    <link rel="stylesheet" type="text/css" href="{{ asset('public/user/css/bootstrap.css')}}">
    <link rel="stylesheet" type="text/css" href="{{ asset('public/user/css/bootstrap-theme.css')}}">
    <link rel="stylesheet" type="text/css" href="{{ asset('public/guest/css/font-awesome.min.css')}}">
    {{--<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.1.0/css/bootstrap.min.css">--}}
    <link rel="stylesheet" href="{{asset('public/library/bootstrap.4.1.0.css')}}">

    <link rel="icon" type="image/png" href="{{asset('public/guest/images/favicon.png')}}" />

    {{--<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>--}}
    <script src="{{asset('public/library/jquery.3.3.1.js')}}"></script>
    <link href='https://fonts.googleapis.com/css?family=Sofia' rel='stylesheet'>
    <link href='{{asset('public/library/font_Sofia.css')}}' rel='stylesheet'>

    <link rel="icon" type="image/png" href="{{asset('public/guest/images/favicon.png')}}" />

    <link rel="stylesheet" type="text/css" href="{{ asset('public/user/css/style.css')}}">

    <!-- All Fonts Here -->
    <link href='https://fonts.googleapis.com/css?family=Source+Sans+Pro' rel='stylesheet' type='text/css'>
    <link href='{{asset('public/library/font_Source_Sans_Pro.css')}}' rel='stylesheet' type='text/css'>

    <link rel="stylesheet" type="text/css" href="http://fonts.googleapis.com/css?family=Raleway" />
    <link rel="stylesheet" type="text/css" href="{{asset('public/library/font_Raleway.css')}}" />
    <script>
        var event_path="<?php echo (asset('public/event_pictures'))?>/";
    </script>


    <script>var myvar;</script>


    <link rel="stylesheet" href="{{asset('/resources/views/my%20calendar/calender_style.css')}}">

    <script>
        function showMonthEvents(event_months) {
            var n=event_months['event'].length;
            var events=event_months['event'];
            var myevent=event_months['myevent'];

            if($('#event_in_homepage').length){    //IF HomePage
                $('#event_in_homepage').empty();
                var html='';
                for (var i=0;i<n;i++){
                    var is_myevent=false;
                    for (j=0;j<myevent.length;j++){
                        if (events[i]['id']==myevent[j]['id'])
                        {
                            is_myevent=true;
                            break;
                        }
                    }


                    var date=new Date(events[i]['event_date']+" "+events[i]['event_time']);
                    var date_options = {month: 'long', day: 'numeric' };

                    if (is_myevent){
                        html+='<div class="event event-registered">';
                        html+='<a href="event_confirm/'+events[i]['id']+'"><h4 class="event-title">';

                        // else{
                        //   html+='<div class="event event-registered">';
                        //  html+='<a href="event_confirm/'+events[i]['id']+'"><h4 class="event-title">';
                        //}


                        html+=events[i]['event_title'].toUpperCase()+'</h4></a>';
                        html+='<h4 class="event-content">'+date.toLocaleDateString('en',date_options)+', at '+events[i]['event_time'].toLowerCase()+'</h4>';
                        html+='<h4 class="event-place">'+events[i]['event_location']+'</h4>';
                        html+='</div>';
                    }
                }
                $('#event_in_homepage').html(html);
            }

            else if($('#events_list_in_calendar').length){   //IF Calendar Page.
                $('#events_list_in_calendar').empty();
                var html='';

                for (var i=0;i<n;i++){
                    var is_myevent=false;
                    var event=events[i];
                    for (j=0;j<myevent.length;j++){
                        if (events[i]['id']==myevent[j]['id'])
                        {
                            is_myevent=true;
                            break;
                        }
                    }
                    var date=new Date(event['event_date']+" "+event['event_time']);
                    var date_options = {month: 'long', day: 'numeric' };
                    html+='<div class="comming-event-house">\
                  <div class="row">';
                    if(event['featured_picture']!=null){
                        html+='<img src="'+event_path+event['featured_picture']+'" class="comming-event-picture">';
                    }
                    else
                    {
                        html+='<img src="public/event_pictures/event_default.jpg" class="comming-event-picture">'
                    }
                    html+='<div class="comming-event-detail">\
                   <h4 class="comming-event-category">'+event['tag_name'].toUpperCase()+'</h4>';

                    if (!is_myevent){
                        url="<?php echo(url('/single_event/'))?>";
                        url=url+'/'+event['id'];
                        console.log(url);
                        html=html+'<a href="'+url+'"><h4 class="comming-event-title">';
                    }
                    else {
                        url="<?php echo(url('/event_confirm/'))?>";
                        url=url+'/'+event['id'];
                        html=html+'<a href="'+url+'"><h4 class="comming-event-title">';
                    }

                    html=html+event['event_title'].toUpperCase()+'</h4></a>\
                         <h4 class="comming-event-time">'+date.toLocaleDateString('en',date_options)+', at '+event['event_time'].toLowerCase()+'</h4>\
                         <h4 class="comming-event-location">'+event['event_location']+'</h4></div></div></div>\
                         <div class="line"></div>';
                }

                console.log(html);
                $('#events_list_in_calendar').html(html);
            }
        }
    </script>


    {{------------------------Untested Code Here--}}
    {{--<script src="{{ asset('js/app.js') }}"></script>--}}
    <script>
        window.Laravel =<?php echo json_encode([
            'csrfToken' => csrf_token(),
        ]); ?>


            window.Laravel.userId = <?php echo auth::user()->id; ?>
    </script>
    <script>
        var APP_URL = {!! json_encode(url('/')) !!};
        console.log(APP_URL);
    </script>
    {{-----------------END---------------}}






<!-- // --------------------------------------------My Code Here-------------------------------------------------------------------- -->
    {{--<link rel="stylesheet" type="text/css" href="{{ asset('public/user/custom_font/css/fontello.css')}}">--}}
    <link rel="stylesheet" type="text/css" href="{{ asset('public/user/custom_icon/css/custom_icon.css')}}">
    {{----}}


</head>
<body class="grid-container">
<header>
    <h1 class="logo"><a href="./"><img src="{{asset('public/guest/images/logo.png')}}" id="logo-img" /></a></h1>
</header>
<nav class="sidenav">

    <a href="{{url('/home')}}" class="loggedin-home-menu"><i class="demo-icon icon-home"></i></a>
    <a href="{{url('/heart')}}" class="heart-menu"><i class="demo-icon icon-heart"></i></a>
    <a href="{{url('/alerts')}}" class="all-alert-menu"><i class="demo-icon icon-notification allert-fa">
            <!-- </i><span class="badge" id="badge">5</span></a> -->
        </i></a>
    <a href="{{url('/calendar')}}" class="calendar-menu"><i class="demo-icon icon-event"></i></a>
    <a href="{{url('/health-forms')}}" class="documents-menu"><i class="demo-icon icon-doc-icon"></i></a>
    <a href="{{url('/profile')}}" class="edit-menu"><i class="demo-icon icon-edit_profile"></i></a>
    <a href="{{ route('logout') }}" class="logout-menu"  onclick="event.preventDefault();document.getElementById('logout-form').submit();"><i class="demo-icon icon-logout"></i></a>
    <div class="badge" id="badge1"></div>

</nav>
<main class="main">
    @yield('content')
</main>
<footer id="footer">
    <div class="container-fluid">
        <div class="row">
            <div class="col-sm-8 col-8">
                <p>Copyright © 2018 PTI Health, All Rights Reserved.</p>
            </div>
            <div class="col-sm-4 col-4 text-right">
                <ul class="social-footer">
                    <li><a href="https://www.facebook.com/groups/243012166404013/" target="_blank"><i class="fa fa-facebook" aria-hidden="true"></i></a></li>
                    {{--<li><a href="#"><i class="fa fa-twitter" aria-hidden="true"></i></a></li>--}}
                </ul>
            </div>
        </div>
    </div>
</footer>


<form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
    @csrf</form>





{{--<script src="resources/assets/js/app.js" ></script>--}}
<script src="{{asset('public/user/notification_broadcast.js')}}"></script>
<script src="{{asset('/resources/views/my%20calendar/calendar.js')}}"></script>
</div>
<script>
    var i=0;
</script>
</body>































