<script src="{{asset('public/library/jquery.3.3.1.js')}}"></script>
<script src="{{asset('/resources/views/my%20calendar/calendar.js')}}"></script>
<link rel="stylesheet" href="{{asset('/resources/views/my%20calendar/calender_style.css')}}">
<link rel="stylesheet" type="text/css" href="{{asset('public/user/css/single_event_confirmation.css')}}">

<script src="{{asset('/public/user/autolink.js')}}"></script>
<script>
    jQuery(function ($) {
        $('#event-description').autolink();
    });

</script>


@extends('user.template')


@section('content')
        <div class="single-event-left-part">
            {{--<img id="awaiting-mark" src="public/user/images/awaiting.png" >--}}
            <h4 id="employee-name">{{$user->first_name}}  {{$user->last_name}}</h4>
            <div class="row">
                <h4 id="employee-id-name">Employee ID</h4>
                <h4 id="employee-id-number">{{$user->employee_number}}</h4>
            </div>
            <div class="line"></div>
            <div class="row">
                <i class="demo-icon icon-event" id="event-icon" aria-hidden="true"></i>
                <h4 id="event-fundamental">COMING EVENTS&nbsp-&nbsp&nbsp<?php echo strtoupper((new DateTime($event->event_date))->format('F'))?>&nbsp&nbsp-&nbsp<?php echo strtoupper($event->event_title) ?></h4>
            </div>

            @if(!is_null($event->featured_picture))
                <img src="{{asset('public/event_pictures/')}}/{{$event->featured_picture}}" id="event-profile-picture">
            @else
                <img src="{{asset('public/event_pictures/event_default.jpg')}}" id="event-profile-picture">
            @endif
            <h4 id="event-category"><?php echo strtoupper($event->tag_name) ?></h4>
            <h4 id="event-title"><?php echo strtoupper($event->event_title) ?></h4>
            <h4 id="event-time"><?php echo ((new DateTime($event->event_date))->format('F')." ".
                    (new DateTime($event->event_date))->format('d').", at ". (new DateTime($event->event_time))->format('h:i a')) ?></h4>
            <h4 id="event-location">{{$event->event_location}}</h4>
            <h4 id="event-description">
                {{$event->event_body}}
            </h4>
            <a href="unregister/{{$event->id}}"> <button id="single-event-confirmation-button">NOT ABLE TO ATTEND THIS EVENT</button></a>
            <div class="v2"></div>
            <img id="awaiting-mark" src="{{asset('public/user/images/awaiting.png')}}" >
        </div>

        <div class="single-event-right-part">
            <div id="calendar"></div>
            {{--<script>--}}
                {{--window.onload=function() {--}}
                    {{--var date=new Date();--}}
                    {{--create_calendar(date.getFullYear(),date.getMonth(),'calendar');}--}}
            {{--</script>--}}
        </div>








@endsection



























