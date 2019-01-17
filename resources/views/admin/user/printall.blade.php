<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <title>Print All User Lists</title>
    <!-- Tell the browser to be responsive to screen width -->
    <meta content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no" name="viewport">
    <!-- Bootstrap 3.3.7 -->
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.1.3/css/bootstrap.min.css">
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.3/umd/popper.min.js"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.1.3/js/bootstrap.min.js"></script>
    <!-- Font Awesome -->
    <link rel="stylesheet" href="{{ asset('public/admin/bower_components/font-awesome/css/font-awesome.min.css')}}">
    <!-- Ionicons -->
    <link rel="stylesheet" href="{{ asset('public/admin/bower_components/Ionicons/css/ionicons.min.css')}}">

    <!-- Google Font -->
    <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,600,700,300italic,400italic,600italic">

    <link rel="stylesheet" type="text/css" href="//fonts.googleapis.com/css?family=Raleway" />

    <link rel="icon" type="image/png" href="{{asset('public/guest/images/favicon.png')}}" />
    <link rel="stylesheet" type="text/css" href="{{ asset('public/user/custom_icon/css/custom_icon.css')}}">
    <link rel="stylesheet" href="{{asset('public/admin/css/printall.css')}}">
</head>

<body>
<div class="button-part">
    <button class="btn btn-success print" onclick="window.print()">Print</button>
    <a class="btn btn-success back" href="{{route('user.index')}}">Back</a>
    <div class="clearfix"></div>
</div>
@for($i=0;$i<count($user_print_data['user_name']);$i++)
    <div class="print-container">
        <div class="logo-area">
            <img class="logo-img" src="{{asset('public/guest/images/logo.png')}}">
        </div>
        <div class="content-area">
            <h4 class="user-name">{{$user_print_data['user_name'][$i]}}</h4>
            @if($user_print_data['total_complete_star'][$i]>0)
                <h4 class="wellness-star">Wellness Stars:<span class="star-marks">{{$user_print_data['total_complete_star'][$i]}}</span><i class="fa fa-star total-star"></i> </h4>
            @else
                <h4 class="wellness-star">Wellness Stars:<span class="star-marks">{{$user_print_data['total_complete_star'][$i]}}</span></h4>
            @endif
            <div class="row detail-part">
                <div class="col-md-4 col-6 task-detail-part">
                    <h4 class="task-title">MY PHYSICAL</h4>
                    <div class="row task-progress">
                        <div class="progress-bar-out">
                            @if($user_print_data['my_physical_completed_star'][$i]>0)
                                <div class="progress-bar" style="width:100%"></div>
                            @else
                                <div class="progress-bar" style="width:0%"></div>
                            @endif

                        </div>
                        @if($user_print_data['my_physical_completed_star'][$i]>0)
                            <h6 class="sub-star-marks">{{$user_print_data['my_physical_completed_star'][$i]}}<i class="fa fa-star task-star"></i></h6>
                        @endif
                    </div>
                </div>

                <div class="col-md-4 col-6 task-detail-part">
                    <h4 class="task-title">MY EDUCATION</h4>
                    <div class="row task-progress">
                        <div class="progress-bar-out">
                            @if($user_print_data['my_education_completed_star'][$i]>0)
                                <div class="progress-bar" style="width:100%"></div>
                            @else
                                <div class="progress-bar" style="width:0%"></div>
                            @endif

                        </div>
                        @if($user_print_data['my_education_completed_star'][$i]>0)
                            <h6 class="sub-star-marks">{{$user_print_data['my_education_completed_star'][$i]}}<i class="fa fa-star task-star"></i></h6>
                        @endif
                    </div>
                </div>

                <div class="col-md-4 col-6 task-detail-part">
                    <h4 class="task-title">MY LIFESTYLE</h4>
                    <div class="row task-progress">
                        <div class="progress-bar-out">
                            @if($user_print_data['my_lifestyle_completed_star'][$i]>0)
                                <div class="progress-bar" style="width:100%"></div>
                            @else
                                <div class="progress-bar" style="width:0%"></div>
                            @endif

                        </div>
                        @if($user_print_data['my_lifestyle_completed_star'][$i]>0)
                            <h6 class="sub-star-marks">{{$user_print_data['my_lifestyle_completed_star'][$i]}}<i class="fa fa-star task-star"></i></h6>
                        @endif
                    </div>
                </div>

                <div class="col-md-4 col-6 information-holder">
                    <h6 class="information-label">Employee ID:<span class="information-data">{{$user_print_data['employee_id'][$i]}}</span> </h6>
                </div>

                <div class="col-md-4 col-6 information-holder">
                    <h6 class="information-label">Email:<span class="information-data">{{$user_print_data['email'][$i]}}</span> </h6>
                </div>

                <div class="col-md-4 col-6 information-holder">
                    <h6 class="information-label">Gender:<span class="information-data">{{$user_print_data['gender'][$i]}}</span> </h6>
                </div>

                <div class="col-md-4 col-6 information-holder">
                    <h6 class="information-label">Birthday:<span class="information-data">{{$user_print_data['birthday'][$i]}}</span> </h6>
                </div>

                <div class="col-md-4 col-6 information-holder">
                    <h6 class="information-label">Phone:<span class="information-data">{{$user_print_data['phone'][$i]}}</span> </h6>
                </div>
                <div class="col-md-4 col-6 information-holder"></div>

                <div class="col-md-3 col-6 place-information-holder">
                    <h6 class="information-label">Address:<span class="information-data">{{$user_print_data['address'][$i]}}</span> </h6>
                </div>

                <div class="col-md-3 col-6 place-information-holder">
                    <h6 class="information-label">City:<span class="information-data">{{$user_print_data['city'][$i]}}</span> </h6>
                </div>

                <div class="col-md-3 col-6 place-information-holder">
                    <h6 class="information-label">State:<span class="information-data">{{$user_print_data['state'][$i]}}</span> </h6>
                </div>

                <div class="col-md-3 col-6 place-information-holder">
                    <h6 class="information-label">Zip Code:<span class="information-data">{{$user_print_data['zip'][$i]}}</span> </h6>
                </div>



            </div>

            <div class="task-list-container">
                <h4 class="task-list-title">Complete Tasks</h4>
                @if($user_print_data['profile_state'][$i]==1)
                    <table class="task-list-table table table-striped table-bordered">
                        <thead>
                        <th>Title</th>
                        <th>Category</th>
                        </thead>
                        <tbody>
                        @if(!is_null($user_print_data['my_physical_task']['task'][$i]))
                            @for($j=0;$j<count($user_print_data['my_physical_task']['task'][$i]);$j++)
                                @if($user_print_data['my_physical_task']['state'][$i][$j]==1)
                                    <tr>
                                        <td>{{$user_print_data['my_physical_task']['task'][$i][$j]}}</td>
                                        <td>My Physical</td>
                                    </tr>
                                @endif
                            @endfor
                        @endif

                        @if(!is_null($user_print_data['my_education_task']['task'][$i]))
                            @for($j=0;$j<count($user_print_data['my_education_task']['task'][$i]);$j++)
                                @if($user_print_data['my_education_task']['state'][$i][$j]==1)
                                    <tr>
                                        <td>{{$user_print_data['my_education_task']['task'][$i][$j]}}</td>
                                        <td>My Education</td>
                                    </tr>
                                @endif
                            @endfor
                        @endif

                        @if(!is_null($user_print_data['my_lifestyle_task']['task'][$i]))
                            @for($j=0;$j<count($user_print_data['my_lifestyle_task']['task'][$i]);$j++)
                                @if($user_print_data['my_lifestyle_task']['state'][$i][$j]==1)
                                    <tr>
                                        <td>{{$user_print_data['my_lifestyle_task']['task'][$i][$j]}}</td>
                                        <td>My LifeStyle</td>
                                    </tr>
                                @endif
                            @endfor
                        @endif

                        </tbody>
                    </table>

                @else
                    <div class="alert alert-warning">
                        <strong class="warning-title">Warning: </strong> User have not completed profile, so there is no task to show here
                    </div>
                @endif

            </div>

            <div class="task-list-container">
                <h4 class="task-list-title">Incomplete Tasks</h4>
                @if($user_print_data['profile_state'][$i]==1)
                    <table class="task-list-table table table-striped table-bordered">
                        <thead>
                        <th>Title</th>
                        <th>Category</th>
                        </thead>
                        <tbody>
                        @if(!is_null($user_print_data['my_physical_task']['task'][$i]))
                            @for($j=0;$j<count($user_print_data['my_physical_task']['task'][$i]);$j++)
                                @if($user_print_data['my_physical_task']['state'][$i][$j]==0)
                                    <tr>
                                        <td>{{$user_print_data['my_physical_task']['task'][$i][$j]}}</td>
                                        <td>My Physical</td>
                                    </tr>
                                @endif
                            @endfor
                        @endif

                        @if(!is_null($user_print_data['my_education_task']['task'][$i]))
                            @for($j=0;$j<count($user_print_data['my_education_task']['task'][$i]);$j++)
                                @if($user_print_data['my_education_task']['state'][$i][$j]==0)
                                    <tr>
                                        <td>{{$user_print_data['my_education_task']['task'][$i][$j]}}</td>
                                        <td>My Education</td>
                                    </tr>
                                @endif
                            @endfor
                        @endif

                        @if(!is_null($user_print_data['my_lifestyle_task']['task'][$i]))
                            @for($j=0;$j<count($user_print_data['my_lifestyle_task']['task'][$i]);$j++)
                                @if($user_print_data['my_lifestyle_task']['state'][$i][$j]==0)
                                    <tr>
                                        <td>{{$user_print_data['my_lifestyle_task']['task'][$i][$j]}}</td>
                                        <td>My LifeStyle</td>
                                    </tr>
                                @endif
                            @endfor
                        @endif

                        </tbody>
                    </table>

                @else
                    <div class="alert alert-warning">
                        <strong class="warning-title">Warning: </strong> User have not completed profile, so there is no task to show here
                    </div>
                @endif
            </div>
        </div>

    </div>

@endfor

<script>
    $(document).ready(function () {
        window.print();

    })
</script>

</body>

</html>
