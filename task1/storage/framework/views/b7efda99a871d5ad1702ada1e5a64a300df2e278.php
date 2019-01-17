<!DOCTYPE html>
<html lang="en">

<head>

    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta name="description" content="">
    <meta name="author" content="">

    <meta name="csrf-token" content="<?php echo e(csrf_token()); ?>">

    <title></title>

    <!-- Bootstrap core CSS -->
    <link href="<?php echo e(asset('vendor/bootstrap/css/bootstrap.min.css')); ?>" rel="stylesheet">

    <!-- Custom fonts for this template -->
    <link href="<?php echo e(asset('vendor/fontawesome-free/css/all.min.css')); ?>" rel="stylesheet" type="text/css">
    <link href="https://fonts.googleapis.com/css?family=Montserrat:400,700" rel="stylesheet" type="text/css">
    <link href="https://fonts.googleapis.com/css?family=Lato:400,700,400italic,700italic" rel="stylesheet" type="text/css">

    <!-- Plugin CSS -->
    <link href="<?php echo e(asset('vendor/magnific-popup/magnific-popup.css')); ?>" rel="stylesheet" type="text/css">

    <!-- Custom styles for this template -->
    <link href="<?php echo e(asset('css/freelancer.min.css')); ?>" rel="stylesheet">
    <link href="<?php echo e(asset('css/page1.css')); ?>" rel="stylesheet">

</head>

<body id="page-top">

<?php echo $__env->make('layouts.menu', \Illuminate\Support\Arr::except(get_defined_vars(), array('__data', '__path')))->render(); ?>

<!-- Portfolio Grid Section -->
    <div class="container1" style="width: 30%;margin:auto;margin-top:85px;">
        <img class="img-fluid mb-5 d-block mx-auto" style="width: 100%;height: 10%" src="<?php echo e(asset('img/logo.jpg')); ?>" alt="">
    </div>
    <div class="container">
        <div class="row" style="margin-top: 150px">
            <div id="loginmenu" style="width:12%;margin-left: 20%">
                <button id="newuser" style="background-color:lightseagreen;width:100%"><label style="font-size: 18px;color:brown;margin:auto;">New User</label></button>
            </div>
            <div id="loginmenu" style="width:12%;margin: auto">
                <button id="member" style="background-color:lightseagreen ;width:100%"><label style="font-size: 18px;color:brown;margin:auto">Member</label></button>
            </div>
            <div id="loginmenu" style="width:12%;margin-right: 20%">
                <button id="speciallogin" style="background-color:lightseagreen;width:100%"><label style="font-size: 18px;color:brown;margin:auto">Special Login</label></button>
            </div>
        </div>

        <div id="logintext" style="width: 70%;height: 450px;border-color: brown;background-color:lightcyan;border-radius:10px;margin:auto;margin-top: 20px;margin-bottom: 10%">

            <div id="memberlogin">
                <form action="<?php echo e(route('login')); ?>" method="post">
                    <?php echo csrf_field(); ?>
                    <div id="login-box">
                        <div class="left" style="margin-top: 50px">
                            <h1 style="margin-bottom: 60px">Member Login</h1>
                            <input type="text" style="margin-bottom: 30px" name="eight_digit" placeholder="Unique Number" />
                            <input type="text"  style="margin-bottom: 30px" name="password" placeholder="4-Digits" />
                            <input type="submit" id="submit" name="signup_submit" value="Login" />
                        </div>
                    </div>
                </form>
            </div>

            <div id="newusersignup">
                <form action="register" method="post">
                    <?php echo csrf_field(); ?>
                    <div id="login-box">
                        <div class="left" style="margin-top: 50px">
                            <h1>List your information.</h1>
                            <input type="text" name="first_name" placeholder="FirstName" required/>
                            <input type="text" name="last_name" placeholder="LastName" required/>
                            <input type="text" name="address" placeholder="Adress" required/>
                            <input type="text" name="phone_number" placeholder="Phone Number" required/>
                            <input type="text" name="email" placeholder="Email" required/>
                            <input type="text" style="margin-bottom: 0" name="password" placeholder="4-Digits" required/>

                            <input id="submit" type="submit" value="Sign up" />
                        </div>
                    </div>
                </form>
            </div>

            <div id="speciallog">
                <form action="<?php echo e(route('login')); ?>" method="post">
                    <?php echo csrf_field(); ?>
                    <div id="login-box">
                        <div class="left" style="margin-top: 50px">
                            <h1 style="margin-bottom: 60px">Special Login</h1>
                            <input type="text" style="margin-bottom: 30px" name="eight_digit" placeholder="Unique Number" />
                            <input type="text"  style="margin-bottom: 30px" name="password" placeholder="4-Digits" />
                            <input type="submit" id="submit" name="signup_submit" value="Login" />
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
<!-- Bootstrap core JavaScript -->
<script src="<?php echo e(asset('vendor/jquery/jquery.min.js')); ?>"></script>
<script src="<?php echo e(asset('vendor/bootstrap/js/bootstrap.bundle.min.js')); ?>"></script>

<!-- Plugin JavaScript -->
<script src="<?php echo e(asset('vendor/jquery-easing/jquery.easing.min.js')); ?>"></script>
<script src="<?php echo e(asset('vendor/magnific-popup/jquery.magnific-popup.min.js')); ?>"></script>

<!-- Contact Form JavaScript -->
<script src="<?php echo e(asset('js/jqBootstrapValidation.js')); ?>"></script>
<script src="<?php echo e(asset('js/contact_me.js')); ?>"></script>

<!-- Custom scripts for this template -->
<script tyle="text/javascript">
    $(document).ready(function(){
        $('#newuser').click(function(){
            $('#newusersignup').show();
            $('#memberlogin').hide();
            $('#speciallog').hide();
        });

        $('#member').click(function(){
            $('#newusersignup').hide();
            $('#memberlogin').show();
            $('#speciallog').hide();
        });

        $('#speciallogin').click(function(){
            $('#newusersignup').hide();
            $('#memberlogin').hide();
            $('#speciallog').show();
        });
    });
</script>


</body>

</html>
