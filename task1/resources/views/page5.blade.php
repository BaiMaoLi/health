<!DOCTYPE html>
<html lang="en">

<head>

    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta name="description" content="">
    <meta name="author" content="">

    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title></title>

    <!-- Bootstrap core CSS -->
    <link href="{{asset('vendor/bootstrap/css/bootstrap.min.css')}}" rel="stylesheet">

    <!-- Custom fonts for this template -->
    <link href="{{asset('vendor/fontawesome-free/css/all.min.css')}}" rel="stylesheet" type="text/css">
    <link href="https://fonts.googleapis.com/css?family=Montserrat:400,700" rel="stylesheet" type="text/css">
    <link href="https://fonts.googleapis.com/css?family=Lato:400,700,400italic,700italic" rel="stylesheet" type="text/css">

    <!-- Plugin CSS -->
    <link href="{{asset('vendor/magnific-popup/magnific-popup.css')}}" rel="stylesheet" type="text/css">

    <!-- Custom styles for this template -->
    <link href="{{asset('css/freelancer.min.css')}}" rel="stylesheet">
    <link href="{{asset('css/page1.css')}}" rel="stylesheet">

</head>

<body id="page-top">

<!-- Navigation -->
@include('layouts.menu')
<!-- Portfolio Grid Section -->
<div class="container1" style="width: 30%;margin:auto;margin-top:100px;">
    <img class="img-fluid mb-5 d-block mx-auto" style="width: 100%;height: 10%" src="{{asset('img/logo.jpg')}}" alt="">
</div>
<div style="">
    <a href="page4" style="margin-left: 80%;">Preview Page</a>
    <a href="page6" style="margin-left:2%;">Next Page</a>
</div>
<audio controls src="{{Session::get('urlo')}}" ></audio>
<div class="container">
    <div id="logintext" style="width: 70%;height: 450px;border-color: brown;background-color:lightcyan;border-radius:10px;margin:auto;margin-top: 20px;margin-bottom: 10%">

        <div id="newusersignup" style="display: block">
            <form action="infor" method="post">
                @csrf
                <div id="login-box">
                    <div class="left" style="margin-top: 50px;height: 100%">
                        <h1 style="margin-bottom: 20px;">Place Orger.</h1>
                        <h1 style="margin-bottom: 50px;">1) Calculate Total.</h1>
                        <div id="row1">
                            <div id="name" style="display:inline-block;width: 20%;margin:0">
                                <input type="text" style="margin:auto;width: 70%" name="pricefield" placeholder="PRICEFIELD" />
                            </div>
                            <div id="name" style="display:inline-block;margin-left:0%">
                                <label>plus</label>
                            </div>
                            <div id="name" style="display:inline-block;width:10%">
                                <input type="text" style="margin:auto;width: 70%" name="pricefield" placeholder="Cat1" />
                            </div>
                            <div id="name" style="display:inline-block;margin-left:0%">
                                <label>plus</label>
                            </div>
                            <div id="name" style="display:inline-block;width: 10%">
                                <input type="text" style="margin:auto;width: 70%" name="pricefield" placeholder="Cat2" />
                            </div>
                            <div id="name" style="display:inline-block;margin-left:0%">
                                <label>plus</label>
                            </div>
                            <div id="name" style="display:inline-block;width: 10%">
                                <input type="text" style="margin:auto;width: 70%" name="pricefield" placeholder="Cat3" />
                            </div>
                            <div id="name" style="display:inline-block;margin-left:0%">
                                <label>plus</label>
                            </div>
                            <div id="name" style="display:inline-block;width: 10%">
                                <input type="text" style="margin:auto;width: 70%" name="pricefield" placeholder="TAX" />
                            </div>
                            <div id="name" style="display:inline-block;margin-left:0%">
                                <label>=</label>
                            </div>
                            <div id="name" style="display:inline-block;width: 10%">
                                <input type="text" style="margin:auto;width: 70%" name="pricefield" placeholder="?" />
                            </div>
                         </div>
                        <h1 style="margin-top: 150px;">This Field be changed annuallary.</h1>
                    </div>
                </div>
            </form>
        </div>
    </div>
</div>
<!-- About Section -->
<style type="text/css">



    button.social-signin {
        margin-bottom: 20px;
        width: 220px;
        height: 36px;
        border: none;
        border-radius: 2px;
        color: #FFF;
        font-family: 'Roboto', sans-serif;
        font-weight: 500;
        transition: 0.2s ease;
        cursor: pointer;
    }

    button.social-signin:hover,
    button.social-signin:focus {
        box-shadow: 0 2px 4px rgba(0, 0, 0, 0.4);
        transition: 0.2s ease;
    }

    button.social-signin:active {
        box-shadow: 0 1px 2px rgba(0, 0, 0, 0.4);
        transition: 0.2s ease;
    }

    button.social-signin.facebook {
        background: #32508E;
    }

    button.social-signin.twitter {
        background: #55ACEE;
    }

    button.social-signin.google {
        background: #DD4B39;
    }

</style>
<!-- Portfolio Modals -->

<!-- Portfolio Modal 1 -->
<!-- <script type="text/javascript" language="javascript" src="jquery-3.3.7.min.js"></script> -->
<!-- Bootstrap core JavaScript -->
<script src="{{asset('vendor/jquery/jquery.min.js')}}"></script>
<script src="{{asset('vendor/bootstrap/js/bootstrap.bundle.min.js')}}"></script>

<!-- Plugin JavaScript -->
<script src="{{asset('vendor/jquery-easing/jquery.easing.min.js')}}"></script>
<script src="{{asset('vendor/magnific-popup/jquery.magnific-popup.min.js')}}"></script>

<!-- Contact Form JavaScript -->
<script src="{{asset('js/jqBootstrapValidation.js')}}"></script>
<script src="{{asset('js/contact_me.js')}}"></script>

<!-- Custom scripts for this template -->
</body>

</html>
