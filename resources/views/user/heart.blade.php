<link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.1.0/css/all.css" integrity="sha384-lKuwvrZot6UHsBSfcMvOkWwlCMgc0TaWr+30HWe3a4ltaBwTZhyTEggF5tJv8tbt" crossorigin="anonymous">
<link rel="stylesheet" type="text/css" href="{{asset('public/user/css/heartpage.css')}}">
@extends('user.template')
@section('content')
    <div id="heart-main">
        <div class="row" id="introduction-part">
            <!-- <div id="information-part" class="float-left"> -->
            <div id="information-part">
                <h4 id="employee-name-heart"> {{$user->first_name}}  {{$user->last_name}}</h4>
                <h6 id="employee-id-heart">Employee ID<span id="employee-id-number-heart">{{$user->employee_number}}</span></h6>
                <i class="demo-icon icon-heart" id="heart-icon-heart"></i>
            </div>

                @if($user->ambassador==0)
                <div class="row" id="mark-part-heart1">
                    <div>
                        <h4 id="wellness-star-name1">WELLNESS STARS</h4>
                        <i class="fa fa-star" id="star-icon-heart1">
                            <span id="mark-star-txt1">{{$my_physical_completed_star+$my_education_completed_star+$my_lifestyle_completed_star}}</span>
                        </i>
                    </div>
                    <div class="clearfix"></div>
                @else
                <div class="row" id="mark-part-heart">
                    <div class="float-right;">
                        <h4 id="wellness-star-name">WELLNESS STARS</h4>
                        <i class="fa fa-star" id="star-icon-heart">
                            <span id="mark-star-txt">{{$my_physical_completed_star+$my_education_completed_star+$my_lifestyle_completed_star}}</span>
                        </i>
                    </div>
                    <img src="{{asset('public/user/images/ambassador.png')}}" id="mark-img" class="float-right">
                @endif
            </div>
        </div>
        <hr class="line-heart">
        <div class="main-section-heart">
            <h4 class="health-category">MY PHYSICAL</h4>
            <div class="row">
                @if($my_physical_total_star>0)
                    <div class="progress progress-heart" >
                        <div class="progress-bar-heart" style="width:{{$my_physical_completed_star/$my_physical_total_star*100}}%"></div>
                    </div>
                @else
                    <div class="progress progress-heart" >
                        <div class="progress-bar-heart" style="width:0%"></div>
                    </div>
                @endif
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

            @foreach($my_physical_task as $task)
                @if($task['state']==0)
                    <h4 class="index-name">{{$task['task']['title']}}
                    </h4>
                @else
                    <h4 class="index-name">{{$task['task']['title']}}
                        <span id="check-mark"> <i class="fa fa-check-circle check-icon" aria-hidden="true"></i> </span>
                    </h4>
                @endif
            @endforeach
        </div>
        <hr class="line-heart">



        <div class="main-section-heart">
            <h4 class="health-category">MY EDUCATION</h4>
            <div class="row">
                @if($my_education_completed_star>0)
                    <div class="progress progress-heart">
                        <div class="progress-bar-heart" style="width:100%;"></div>
                    </div>
                @else
                    <div class="progress progress-heart">
                        <div class="progress-bar-heart" style="width:0%;"></div>
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
            <h4 class="note-heart">Complete one to get your wellness star. Do more, get more.</h4>
            @foreach($my_education_task as $task)
                @if($task['state']==0)
                    <h4 class="index-name">{{$task['task']['title']}}
                    </h4>
                @else
                    <h4 class="index-name">{{$task['task']['title']}}
                        <span id="check-mark"> <i class="fa fa-check-circle check-icon" aria-hidden="true"></i> </span>
                    </h4>
                @endif
            @endforeach

        </div>
        <hr class="line-heart">

        <div class="main-section-heart">
            <h4 class="health-category">MY LIFESTYLE</h4>
            <div class="row">
                @if($my_lifestyle_completed_star>0)
                    <div class="progress-heart">
                        <div class="progress-bar-heart " style="width:100%;"></div>
                    </div>
                @else
                    <div class="progress-heart">
                        <div class="progress-bar-heart " style="width:0%;"></div>
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

            <h4 class="note-heart">Complete one to get your wellness star. Do more, get more.</h4>
            @foreach($my_lifestyle_task as $task)
                @if($task['state']==0)
                    <h4 class="index-name">{{$task['task']['title']}}
                    </h4>
                @else
                    <h4 class="index-name">{{$task['task']['title']}}
                        <span id="check-mark"> <i class="fa fa-check-circle check-icon" aria-hidden="true"></i> </span>
                    </h4>
                @endif
            @endforeach
        </div>
    </div>


@endsection



















