<link rel="stylesheet" type="text/css" href="{{asset('public/user/css/loghomepage.css')}}">
<script src="{{asset('public/library/jquery.3.3.1.js')}}"></script>
{{--<script src="{{asset('/resources/views/my%20calendar/calendar.js')}}"></script>--}}
{{--<link rel="stylesheet" href="{{asset('/resources/views/my%20calendar/calender_style.css')}}">--}}

@extends('user.template')
@section('content')

    @if(is_null($profile) or is_null($profile->address) or is_null($profile->city) or is_null($profile->city)
                            or is_null($profile->state) or is_null($profile->zip) or is_null($profile->email) or is_null($profile->phone)
                            or is_null($profile->birthday) or is_null($profile->gender))
        <h6 class="incompleted-profile-warning">PLEASE GO TO THE <a href="{{url('/profile')}}" style="color:white">EDIT PROFILE </a> PAGE AND FILL OUT THE MISSING FIELDS TO COMPLETE YOUR PROFILE</h6>
    @endif

<div class="logged-home-main">

    <div class="logged-home-left-part">
        {{--<div class="row home-profile" >--}}
        <div class="home-profile" >
            <div class="profile-photo">
                @if (!is_null($profile))
                    @if (!is_null($profile->profile_picture))
                        <img src="{{$profile->profile_picture}}" id="user-photo">
                    @else
                        <img src="{{asset('public/user/images/profile_pictures/avatar.jpg')}}" id="user-photo">
                    @endif
                @else
                    <img src="{{asset('public/user/images/profile_pictures/avatar.jpg')}}" id="user-photo">
                @endif
            </div>
            <div class="profile-detail ">
                @if($user->ambassador==0)
                    <img src="public/user/images/ambassador.png" style="visibility: hidden">
                @else
                    <img src="public/user/images/ambassador.png">
                @endif

                <h4 id="name"> {{$user->first_name}}  {{$user->last_name}}</h4>
                    <h6 id="employee-id-name">Employee ID
                        <span id="employee-id-number">{{$user->employee_number}}</span></h6>
                <h6 id="wellness-star" >WELLNESS STARS</h6>
                    <i class="fa fa-star wellness-star-icon" aria-hidden="true"><span class="wellness-star-mark">{{$my_physical_completed_star+$my_education_completed_star+$my_lifestyle_completed_star}}</span></i>
            </div>

        </div>
        <hr class="line1">


        <div class="home-progress">
            <div class="row">
                <i class="demo-icon icon-heart" id="top-mark" aria-hidden="true"></i>
                <p id="top-mark-text">HEALTH ASSESSMENT PROGRESS</p>
            </div>

            <h4 class="my-education-text">MY PHYSICAL</h4>

            <div class="row my-physical-progress">
                <div class="progress progress-outer">
                    @if($my_physical_total_star>0)
                        <div class="progress-bar1 " style="width:{{$my_physical_completed_star/$my_physical_total_star*100}}%;"></div>
                    @else
                        <div class="progress-bar1 " style="width:0%;"></div>
                    @endif

                </div>
                @if($my_physical_completed_star>0)
                    @if($my_physical_completed_star>1)
                        <h4 class="my-physical-mark">{{$my_physical_completed_star}}
                            <span><i class="fa fa-star my-health-star"  aria-hidden="true"></i></span>
                        </h4>
                    @else
                        <h4 class="my-physical-mark">
                            <span><i class="fa fa-star my-health-star"  aria-hidden="true"></i></span>
                        </h4>
                    @endif
                @endif
            </div>

            <h4 class="my-education-text">MY EDUCATION</h4>
            <div class="row">
                @if($my_education_total_star>0)
                    <div class="progress progress-outer">
                        <div class="progress-bar1 " style="width:{{$my_education_completed_star*100}}%;"></div>
                    </div>
                @else
                    <div class="progress progress-outer">
                        <div class="progress-bar1 " style="width:0%;"></div>
                    </div>
                @endif
                @if($my_education_completed_star>0)
                    @if($my_education_completed_star>1)
                        <h4 class="my-physical-mark">{{$my_education_completed_star}}
                            <span><i class="fa fa-star my-health-star"  aria-hidden="true"></i></span>
                        </h4>
                    @else
                        <h4 class="my-physical-mark">
                            <span><i class="fa fa-star my-health-star"  aria-hidden="true"></i></span>
                        </h4>
                    @endif
                @endif
            </div>

            <h4 class="my-education-text">MY LIFESTYLE</h4>
            <div class="row">
                @if($my_lifestyle_total_star>0)
                    <div class="progress progress-outer" >
                        <div class="progress-bar1 " style="width:{{$my_lifestyle_completed_star*100}}%;"></div>
                    </div>
                @else
                    <div class="progress progress-outer" >
                        <div class="progress-bar1 " style="width:0%;"></div>
                    </div>
                @endif

                @if($my_lifestyle_completed_star>0)
                    @if($my_lifestyle_completed_star>1)
                        <h4 class="my-physical-mark">{{$my_lifestyle_completed_star}}
                            <span><i class="fa fa-star my-health-star"  aria-hidden="true"></i></span>
                        </h4>
                    @else
                        <h4 class="my-physical-mark">
                            <span><i class="fa fa-star my-health-star"  aria-hidden="true"></i></span>
                        </h4>
                    @endif
                @endif
            </div>
        </div>
        <hr class="line2">

        <div class="MY-ALERTS">
            <div class="row">
                <i class="demo-icon icon-notification" id="alert-icon" aria-hidden="true"></i>
                <h4 id="alert-top-text">MY ALERTS</h4>
            </div>
            <div id="My-alert">
            {{--<h4 id="alert-title"> THE TIME OF EVENT HAS CHANGED</h4>--}}
            {{--<h6 id="alert-content">4T Event is now Octobor 17th, at 2:00pm</h6>--}}
            {{--<h6 id="alert-place">River Bends Park</h6>--}}
            </div>
        </div>
    </div>
    <div class="logged-home-right-part">
         <div id="calendar"></div>
         <script>
             {{--// window.onload=function() {--}}
             //      var date=new Date();
             //      create_calendar(date.getFullYear(),date.getMonth(),'calendar');
             {{--$(document).ready(function(){--}}
                 {{--var date=new Date();--}}
                 {{--create_calendar(date.getFullYear(),date.getMonth(),'calendar');--}}
            {{--})--}}

         </script>

         <div class="event-house">
             <div class="row event-header">
                 <i class="demo-icon icon-event " id="event-icon" aria-hidden="true"></i>
                 <h4 id="my-event">MY EVENTS</h4>
             </div>
             <div id="event_in_homepage">

             </div>

         </div>
         <div class="vertical_line"></div>
      </div>
</div>
@endsection
