<html>
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0, maximum-scale=3.0, user-scalable=yes"/>
    <meta name="HandheldFriendly" content="true" />
    <meta name="apple-mobile-web-app-capable" content="YES" />
    <title>PTI Health</title>
    <link rel="stylesheet" type="text/css" href="{{ asset('public//guest/css/style.css')}}">
    <link rel="stylesheet" type="text/css" href="{{ asset('public//guest/css/responsive.css')}}">
    <link rel="stylesheet" type="text/css" href="{{ asset('public//guest/css/font-awesome.min.css')}}">
    <link rel="stylesheet" type="text/css" href="{{ asset('public//guest/css/bootstrap.css')}}">
    
    <link rel="stylesheet" type="text/css" href="{{ asset('public//guest/css/bootstrap-theme.css')}}">
    <link href="{{ asset('public//guest/css/slick-theme.css')}}" rel="stylesheet" type="text/css" />
    <link href=" {{ asset('public//guest/css/slick.css')}}" rel="stylesheet" type="text/css" />
    <link rel="stylesheet" type="text/css" href="{{ asset('public/user/custom_icon/css/custom_icon.css')}}">



    @php
        include("public/guest/js/get_item.php");
    @endphp

    <link rel="icon" type="image/png" href="{{asset('public/guest/images/favicon.png')}}" />

    <!-- All Fonts Here -->
    <link href='https://fonts.googleapis.com/css?family=Source+Sans+Pro' rel='stylesheet' type='text/css'>
    <link rel="stylesheet" type="text/css" href="http://fonts.googleapis.com/css?family=Raleway" />

    {{--<link rel="stylesheet" type="text/css" href="{{ asset('public/user/custom_font/css/fontello.css')}}">--}}

    <script src='https://www.google.com/recaptcha/api.js'></script>

</head>
<body>
<div id="header">
    <div class="container-fluid">
        <div class="row">
            <div class="col-md-12">
                <h1 class="logo"><a href=""><img src="{{ asset('public//guest/images/logo.png') }}" /></a></h1>
            </div>
        </div>
    </div>
</div>
<div class="main">

    <div class="container-fluid-slide" id="container">
        <script>
            drawGrid();
        </script>
    </div>
</div>

<div id="footer">
    <div class="container-fluid">
        <div class="row">
            <div class="col-sm-9">
                <p>Copyright © 2018 PTI Health, All Rights Reserved.</p>
            </div>
            <div class="col-sm-3 text-right">
                <ul class="social-footer">
                    <li><a href="https://www.facebook.com/groups/243012166404013/" target="_blank"><i class="fa fa-facebook" aria-hidden="true"></i></a></li>
                    {{--<li><a href="#"><i class="fa fa-twitter" aria-hidden="true"></i></a></li>--}}
                </ul>
            </div>
        </div>
    </div>
</div>
<div id="register-form" class="modal form-action" role="dialog" autocomplete="off">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal">&times;</button>
            </div>
            <div class="modal-body" >                
                <form method="POST" action="{{ route('register') }}"  aria-label="{{ __('Register') }}">@csrf
                    <input type="text" name="first_name" id="first_name" class="inp-text has-required" placeholder="First name" value="{{ old('first_name') }}" required autofocus>
                    @if ($errors->has('first_name'))
                        <span class="invalid-feedback" role="alert">
                                        <strong>{{ $errors->first('first_name') }}</strong>
                                    </span>
                    @endif

                    <input id="last_name" type="text" class="inp-text has-required" name="last_name" value="{{ old('last_name') }}" required autofocus  placeholder="Last name" />
                    @if ($errors->has('last_name'))
                        <span class="invalid-feedback" role="alert">
                                        <strong>{{ $errors->first('last_name') }}</strong>
                                    </span>
                    @endif


                    <input id="employee_number" type="text" class="inp-text has-required" name="employee_number" value="{{ old('employee_number') }}" required autofocus placeholder="Employee Number" />
                    @if ($errors->has('employee_number'))
                        <span class="invalid-feedback" role="alert">
                                        <strong>{{ $errors->first('employee_number') }}</strong>
                                    </span>
                    @endif


                    <input id="email" type="email" class="inp-text has-required" name="email" value="{{ old('email') }}" placeholder="Email" required/>
                    @if ($errors->has('email'))
                        <span class="invalid-feedback" role="alert">
                                        <strong>{{ $errors->first('email') }}</strong>
                                    </span>
                    @endif

                    <input id="password" type="password" class="inp-text has-required" name="password" autocomplete="off" placeholder="Password" required/>
                    @if ($errors->has('password'))
                        <span class="invalid-feedback" role="alert">
                                        <strong>{{ $errors->first('password') }}</strong>
                                    </span>
                    @endif

                    <input id="password-confirm" type="password" class="inp-text has-required" name="password_confirmation" autocomplete="off" required placeholder="Retype Password">



                    <div class="form-group" style="margin-bottom:0px">
                        {!! Recaptcha::render() !!}
                    </div>

                    <span class="invalid-captcha" style="color:red;margin-top:3px; marin-left:3px;display:none">
                        <strong>Captcha invalid</strong>
                    </span>

                    <button type="submit" class="btn btn-primary"><img src="{{asset('public//guest/images/icon-submit.png')}}" />
                        {{ __('Register') }}
                    </button>

                    <div class="loading-form">
                        <div class="lds-ellipsis"><div></div><div></div><div></div><div></div></div>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>
<div id="login-form" class="modal form-action" role="dialog" autocomplete="off">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal">&times;</button>
            </div>
            <div class="modal-body">
                <form method="POST" action="{{ route('login') }}" aria-label="{{ __('Login') }}">@csrf


                    <input id="login-email" type="email" autocomplete="off" class="inp-text has-required" placeholder="Email" name="email" value="{{ old('email') }}" required autofocus>
                    @if ($errors->has('email'))
                        <span class="invalid-feedback" role="alert">
                                        <strong>{{ $errors->first('email') }}</strong>
                                    </span>
                    @endif

                    <input id="login-password" type="password" autocomplete="off" class="inp-text has-required" name="password" placeholder="Password" value="" required>

                    @if ($errors->has('password'))
                        <span class="invalid-feedback" role="alert">
                                        <strong>{{ $errors->first('password') }}</strong>
                                    </span>
                    @endif

                    <div class="form-group" style="margin-bottom:0px">
                        {!! Recaptcha::render() !!}
                    </div>
                    <button type="submit" class="btn btn-primary"> <img src="{{asset('public//guest/images/icon-submit.png')}}" />
                        {{ __('Login') }}
                    </button>
                </form>
            </div>
        </div>
    </div>
</div>

<div id="event-form" class="modal form-action" role="dialog">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
        <div class="modal-header">
            <button type="button" class="close" data-dismiss="modal">&times;</button>
        </div>
      <div class="modal-body">
      <div class="container-fluid" style="padding-left:5px;padding-right:5px;">
        <div class="comming-event-title-house">
            <div class="comming-event-icon">
              <i class="demo-icon icon-event" id="comming-events-icon" ></i>
            </div>
            <div class='comming-event-top-title'>
                <h4 id="comming-events-text">COMING EVENTS</h4>
            </div>            
        </div>
          @if(!is_null($events))
          @foreach($events as $event)
              @if($loop->index<3)
        <div class="comming-event-house">
            <div class="event-img">
                <img src="/public/event_pictures/{{$event->featured_picture}}" class="comming-event-picture">
            </div>
            <div class="comming-event-detail">
                <h4 class="comming-event-category"> <?php echo strtoupper($event->tag_name) ?></h4>
                <h4 class="comming-event-title"><?php echo strtoupper($event->event_title) ?></h4>
                <h4 class="comming-event-time"><?php echo ((new DateTime($event->event_date))->format('F')." ".
                        (new DateTime($event->event_date))->format('d').", at ". (new DateTime($event->event_time))->format('h:i a')) ?></h4>
                <h4 class="comming-event-location">{{$event->event_location}}</h4>
            </div>
        </div>
      @if($loop->index<count($events)-1)
        <div class="line"></div>
      @endif
  @endif
    @endforeach
  @endif



    </div>          
</div>
    </div>
  </div>
</div>

    



{{--<script src="js/home_page/jquery-1.9.1.min.js"></script>--}}
<script src="https://ajax.googleapis.com/ajax/libs/jquery/1.9.1/jquery.min.js"></script>
<script type="text/javascript" src="{{ asset('public//guest/js/bootstrap.min.js') }}"></script>
<script src="{{ asset('public//guest/js/bootbox.min.js') }}"></script>
<script src="{{ asset('public//guest/js/scripts.js')}}"></script>
<script type="text/javascript" src="{{ asset('public//guest/js/slick.js')}}"></script>
<script type="text/javascript" src="{{ asset('public//guest/js/jquery.masonry.min.js')}}"></script>
{{--<script src="https://unpkg.com/masonry-layout@4/dist/masonry.pkgd.js"></script>--}}
{{--<script src="https://unpkg.com/imagesloaded@4/imagesloaded.pkgd.js"></script>--}}

<script type="text/javascript">
    jQuery(document).ready(function() {
        var windowsize = jQuery(window).width();
        if (windowsize > 767) {
            jQuery('.container-fluid-slide').masonry({
                itemSelector: '.grid-item',
                columnWidth: 215,
                 "margin-left":4,
            });
        }

        jQuery('.item-box-slide .content-box').slick({
            slidesToShow: 1,
            slidesToScroll: 1,
            arrows: false,
            autoplay: true,
            autoplaySpeed: 2000
        });
        jQuery('.had-popup').click(function(){
            jQuery('.grid-item').removeClass('show-effect');
            jQuery(this).parent().addClass('show-effect');

        });
    });

    window.onload = function() {
        var $recaptcha = document.querySelector('#g-recaptcha-response');
        if($recaptcha) {
            $recaptcha.setAttribute("required", "required");
        }
        $recaptcha.oninvalid = function(e) {
            $('.invalid-captcha').show();
        }
    };

    // var freeMasonry = jQuery('.container-fluid-slide');
    //
    //
    // jQuery('.container-fluid-slide').masonry({
    //     itemSelector: '.grid-item',
    //     columnWidth: 215,
    //     "margin-left":4,
    // });

    // $(window).resize(function () {
    //     drawGrid();
    //     var windowsize = jQuery(window).width();
    //     if (windowsize > 767) {
    //         freeMasonry.imagesLoaded()
    //             .done(function(){
    //                 freeMasonry.masonry({
    //                     itemSelector: '.grid-item',
    //                     columnWidth: 215,
    //                     "margin-left":4,
    //                 });
    //             });
    //     }
    // });




</script>
</body>
</html>