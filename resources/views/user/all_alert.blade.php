<link rel="stylesheet" type="text/css" href="{{asset('public/user/css/all_alert.css')}}">
@extends('user.template')
@section('content')
    <div id="all-alert-main">
        <h4 id="employee-name">{{$user->first_name}}  {{$user->last_name}}</h4>
        <div class="row">
            <h4 id="employee-id-name">Employee ID</h4>
            <h4 id="employee-id-number">{{$user->employee_number}}</h4>
        </div>
        <div>
        <h4 class="float-right" id="clear-alerts">CLEAR ALERTS</h4>
        <div class="row">
            <i class="demo-icon icon-notification" id="my-alert-icon" aria-hidden="true"></i>
            <h4 id="my-alert-txt">MY ALERTS</h4>
        </div>
        </div>        <div class="line"></div>
        <div id="AllAlerts">
            {{--<div class="all-alert-house event-alert">--}}
                {{--<h4 class="alert-title">THE TIME OF EVENT HAS CHANGED</h4>--}}
                {{--<h4 class="event-time">4T Event is now October 17th, at 2:00pm</h4>--}}
                {{--<h4 class="event-location">River Bends Park</h4>--}}
            {{--</div>--}}
            {{--<div class="line"></div>--}}

            {{--<div class="all-alert-house message-unread">--}}
                {{--<h4 class="alert-title">MESSAGE UNREAD</h4>--}}
                {{--<h4 class="message-content">Remember there two get your requires prevension screenings done. There is only 2 more months until to earn points for the <span class="readmore">...more</h4>--}}
            {{--</div>--}}
            {{--<div class="line"></div>--}}

            {{--<div class="all-alert-house meassage-read">--}}
                {{--<h4 class="alert-title">MESSAGE READ 1</h4>--}}
                {{--<h4 class="message-content" style="width:500px;">Remember there two get your requires prevension screenings done. There is only 2 more months until to earn points for</h4>--}}
            {{--</div>--}}
            {{--<div class="line"></div>--}}

            {{--<div class="all-alert-house meassage-read">--}}
                {{--<h4 class="alert-title">MESSAGE READ 1</h4>--}}
                {{--<h4 class="message-content">Remember there two get your requires prevension screenings done. There is only 2 more months until to earn points for</h4>--}}

            {{--</div>--}}
            {{--<div class="line"></div>--}}
            {{--<div class="all-alert-house meassage-read">--}}
                {{--<h4 class="alert-title">MESSAGE READ 1</h4>--}}
                {{--<h4 class="message-content">Remember there two get your requires prevension screenings done. There is only 2 more months until to earn points for</h4>--}}
            {{--</div>--}}
            {{--<div class="line"></div>--}}
            {{--<div class="all-alert-house alert-more">--}}
                {{--<i class="fa fa-angle-down"></i>--}}
            {{--</div>--}}
            {{--</div>--}}
        </div>
    </div>




@endsection