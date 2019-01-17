<!DOCTYPE html>
<html lang="en">

<head>


    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta name="description" content="">
    <meta name="author" content="">

    <title></title>

    <!-- Bootstrap core CSS -->
    <link href="{{asset('vendor/bootstrap/css/bootstrap.min.css')}}" rel="stylesheet">

    <!-- Custom fonts for this template -->
    <link href="{{asset('vendor/fontawesome-free/css/all.min.css')}}" rel="stylesheet" type="text/css">
    <link href="https://fonts.googleapis.com/css?family=Montserrat:400,700" rel="stylesheet" type="text/css">
    <link href="https://fonts.googleapis.com/css?family=Lato:400,700,400italic,700italic" rel="stylesheet" type="text/css">

    <!-- Plugin CSS -->
    <link href="{{asset('vendor/magnific-popup/magnific-popup.css')}}" rel="stylesheet" type="text/css">
    <link href="{{asset('css/freelancer.min.css')}}" rel="stylesheet">

    <!-- Custom styles for this template -->
    <link href="{{asset('css/page2.css')}}" rel="stylesheet">
    <link rel="stylesheet" href="{{asset('iCheck/all.css')}}">


</head>

<body id="page-top">

@include('layouts.menu')
<div id="login-box">
    <div class="container1" style="width: 100%;height: 10%;padding-top: 0px">
        <img class="img-fluid mb-5 d-block mx-auto" style="width:20%;height: 100%;margin-top:105px" src="{{asset('img/logo.jpg')}}" alt="">
        <div style="">
            <a href="page2" style="margin-left: 80%;">Preview Page</a>
            <a href="page4" style="margin-left:2%;">Next Page</a>
        </div>
    </div>
    <div id="instructions" style="width:10%;height:5%;margin:auto;margin-top: 0px">
        <label style="font-size: 24px">CATEGORY1</label>
    </div>

    <form action="{{url('/addCategory')}}" method="post">
        {{csrf_field()}}
    <?php for($i=0;$i<10;$i++){?>
        <div class="category1">

            <div id="row1">
                <div id="name" style="display:inline-block;margin-left:20%">
                <input type="checkbox" class="flat-red select-user" name="check-{{$i}}" value={{$i}} {{$result[$i]['statues']}}/>
                </div>
                <div id="name" style="display:inline-block;">
                    <label style="">{{$i}}) NAME:</label>
                </div>
                <div id="name" style="display:inline-block;">
                    <label>FIRST</label>
                </div>
                <div id="name" style="display:inline-block;">
                    @if($result[$i]['id']!=0)
                        <input type="text" name="first_name-{{$i}}" value={{$result[$i]['first_name']}} />
                    @else
                        <input type="text" name="first_name-{{$i}}" placeholder="First"/>
                    @endif

                </div>
                <div id="name" style="display:inline-block;">
                    <label>LAST:</label>
                </div>
                <div id="name" style="display:inline-block;">
                    @if($result[$i]['id']!=0)
                        <input type="text" name="last_name-{{$i}}" value={{$result[$i]['last_name']}} />
                    @else
                        <input type="text" name="last_name-{{$i}}" placeholder="Last"/>
                    @endif
                </div>
                <div id="name" style="display:inline-block;">
                    <label>PHONE:</label>
                </div>
                <div id="name" style="display:inline-block;">
                    @if($result[$i]['id']!=0)
                        <input type="text" name="phone-{{$i}}" value={{$result[$i]['phone']}} />
                    @else
                        <input type="text" name="phone-{{$i}}" placeholder="phone" />
                    @endif

                </div>
                <div id="name" style="display:inline-block;">
                    <label>EMAIL:</label>
                </div>
                <div id="name" style="display:inline-block;">
                    @if($result[$i]['id']!=0)
                        <input type="email" name="email-{{$i}}" value={{$result[$i]['email']}} />
                    @else
                        <input type="email" name="email-{{$i}}" placeholder="email"/>
                    @endif
                </div>
                <input type="text" name="id-{{$i}}" value={{$result[$i]['id']}} style="display:none">

            </div>

        </div>


    <?php }?>
        <div id="name" style="">
            <input style="margin-left:45%;margin-bottom:3%;margin-top:2%" type="submit" value="S A V E">
        </div>
    </form>
        <div id="instructions" style="width:10%;height:5%;margin:auto;margin-top: 0px">
            <label style="font-size: 24px">CATAGORY2</label>
        </div>
        <div class="catagory2">
        <form action="{{url('/addCategory2')}}" method="post">
                {{csrf_field()}}
            <?php for($i=0;$i<5;$i++){?>
                <div class="left1">

                    <div id="row1">
                        <div id="name" style="display:inline-block;margin-left:20%">
                            <input type="checkbox" class="flat-red select-user" name="check-{{$i}}" value={{$i}} {{$result2[$i]['statues']}}/>
                        </div>
                        <div id="name" style="display:inline-block;">
                            <label style="">{{$i+1}}) NAME:</label>
                        </div>
                        <div id="name" style="display:inline-block;">
                            <label>FIRST</label>
                        </div>
                        <div id="name" style="display:inline-block;">
                            @if($result2[$i]['id']!=0)
                            <input type="text" name="first_name-{{$i}}" value={{$result2[$i]['first_name']}} />
                            @else
                            <input type="text" name="first_name-{{$i}}" placeholder="First" />
                            @endif
                        </div>
                        <div id="name" style="display:inline-block;">
                            <label>LAST:</label>
                        </div>
                        <div id="name" style="display:inline-block;">
                            @if($result2[$i]['id']!=0)
                            <input type="text" name="last_name-{{$i}}" value={{$result2[$i]['last_name']}} />
                            @else
                            <input type="text" name="last_name-{{$i}}" placeholder="Last" />
                            @endif

                        </div>
                        <div id="name" style="display:inline-block;">
                            <label>PHONE:</label>
                        </div>
                        <div id="name" style="display:inline-block;">
                            @if($result2[$i]['id']!=0)
                            <input type="text" name="phone-{{$i}}" value={{$result2[$i]['phone']}} />
                            @else
                            <input type="text" name="phone-{{$i}}" placeholder="phone" />
                                @endif
                        </div>
                        <div id="name" style="display:inline-block;">
                            <label>EMAIL:</label>
                        </div>
                        <div id="name" style="display:inline-block;">
                            @if($result2[$i]['id']!=0)
                            <input type="email" name="email-{{$i}}" value={{$result2[$i]['email']}} />
                            @else
                            <input type="email" name="email-{{$i}}" placeholder="email" />
                            @endif
                        </div>
                        <div id="name" style="display:none;">
                            <input type="text" name="id-{{$i}}" value={{$result2[$i]['id']}} />
                        </div>
                     </div>

                </div>
            <?php }?>
            <div id="name" style="">
                <input style="margin-left:45%;margin-bottom:3%;margin-top: 2%" type="submit" value="S A V E">
            </div>
            </form>
         </div>

        <div id="instructions" style="width:10%;height:5%;margin:auto;margin-top: 0px">
            <label style="font-size: 24px">CATAGORY3</label>
        </div>
        <div class="catagory3">

            <form action="{{url('/addCategory3')}}" method="post">
                {{csrf_field()}}
                <?php for($i=0;$i<5;$i++){?>
                <div class="left1">

                    <div id="row1">
                        <div id="name" style="display:inline-block;margin-left:20%">
                            <input type="checkbox" class="flat-red select-user" name="check-{{$i}}" value={{$i}} {{$result3[$i]['statues']}}/>
                        </div>
                        <div id="name" style="display:inline-block;">
                            <label style="">{{$i+1}}) NAME:</label>
                        </div>
                        <div id="name" style="display:inline-block;">
                            <label>FIRST</label>
                        </div>
                        <div id="name" style="display:inline-block;">
                            @if($result3[$i]['id']!=0)
                                <input type="text" name="first_name-{{$i}}" value={{$result3[$i]['first_name']}} />
                            @else
                                <input type="text" name="first_name-{{$i}}" placeholder="First" />
                            @endif
                        </div>
                        <div id="name" style="display:inline-block;">
                            <label>LAST:</label>
                        </div>
                        <div id="name" style="display:inline-block;">
                            @if($result3[$i]['id']!=0)
                                <input type="text" name="last_name-{{$i}}" value={{$result3[$i]['last_name']}} />
                            @else
                                <input type="text" name="last_name-{{$i}}" placeholder="Last" />
                            @endif

                        </div>
                        <div id="name" style="display:inline-block;">
                            <label>PHONE:</label>
                        </div>
                        <div id="name" style="display:inline-block;">
                            @if($result3[$i]['id']!=0)
                                <input type="text" name="phone-{{$i}}" value={{$result3[$i]['phone']}} />
                            @else
                                <input type="text" name="phone-{{$i}}" placeholder="phone" />
                            @endif
                        </div>
                        <div id="name" style="display:inline-block;">
                            <label>EMAIL:</label>
                        </div>
                        <div id="name" style="display:inline-block;">
                            @if($result3[$i]['id']!=0)
                                <input type="email" name="email-{{$i}}" value={{$result3[$i]['email']}} />
                            @else
                                <input type="email" name="email-{{$i}}" placeholder="email" />
                            @endif
                        </div>
                        <div id="name" style="display:none;">
                            <input type="text" name="id-{{$i}}" value={{$result3[$i]['id']}} />
                        </div>
                    </div>

                </div>
                <?php }?>
                <div id="name" style="">
                    <input style="margin-left:45%;margin-bottom:3%;margin-top: 2%" type="submit" value="S A V E">
                </div>
            </form>
</div>
<div style="height: 20px"></div>
<!-- Portfolio Modals -->

<!-- Bootstrap core JavaScript -->
<script src="{{asset('vendor/jquery/jquery.min.js')}}"></script>
<script src="{{ asset('iCheck/icheck.min.js')}}"></script>
<script src="{{asset('vendor/bootstrap/js/bootstrap.bundle.min.js')}}"></script>

<!-- Plugin JavaScript -->
<script src="{{asset('vendor/jquery-easing/jquery.easing.min.js')}}"></script>
<script src="{{asset('vendor/magnific-popup/jquery.magnific-popup.min.js')}}"></script>

<!-- Contact Form JavaScript -->
<script src="{{asset('js/jqBootstrapValidation.js')}}"></script>
<script src="{{asset('js/contact_me.js')}}"></script>

<!-- Custom scripts for this template -->
    <script>
        $(document).ready(function() {
            $('input[type="checkbox"].flat-red').iCheck({
                checkboxClass: 'icheckbox_flat-green'
            });


        });

    </script>
</body>

</html>
