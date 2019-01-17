<link rel="stylesheet" href="{{asset('/resources/views/my%20calendar/calender_style.css')}}">
<script src="{{asset('public/library/jquery.3.3.1.js')}}"></script>
<link rel="stylesheet" type="text/css" href="{{asset('public/user/css/calendar.css')}}">

@extends('user.template')
<script src="{{asset('/resources/views/my%20calendar/calendar.js')}}"></script>
@section('content')
        <div class="left-part">
            <h4 id="employee-name">{{$user->first_name}}  {{$user->last_name}}</h4>
            <div class="row">
                <h4 id="employee-id-name">Employee ID</h4>
                <h4 id="employee-id-number">{{$user->employee_number}}</h4>
            </div>
            <div class="line"></div>
            <?php $a="alerts"?>
                <div class="row" >
                    <i class="demo-icon icon-event" id="comming-events-icon" aria-hidden="true"></i>
                    <?php $prev_month=(int)(new DateTime($month))->format('m')-1?>
                    <?php $next_month=(int)(new DateTime($month))->format('m')+1?>
                     <div class="row" id="comming-events-title">
                         <h4 class="comming-events-text" >COMING EVENTS -</h4><h4 class="comming-events-text second" id="prev"><<</h4><h4 class="comming-events-text second" style="margin-left:0px" id="this-month"> &nbsp <?php echo strtoupper($month)?></h4><h4 class="comming-events-text second" id="next">>></h4>
                     </div>
                </div>

                <div id="events_list_in_calendar">

                </div>
        </div>
        <div class="right-part">
            <div class="v2"></div>
            <div id="calendar"></div>
            {{--<script>--}}
                {{--window.onload=function() {--}}
                    {{--var date=new Date();--}}
                    {{--create_calendar(date.getFullYear(),{{(int)(new DateTime($month))->format('m')-1}},'calendar');--}}
                {{--}--}}
            {{--</script>--}}
        </div>
@endsection












