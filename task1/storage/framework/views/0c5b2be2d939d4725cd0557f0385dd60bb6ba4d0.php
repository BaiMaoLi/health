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
    <link href="<?php echo e(asset('css/freelancer.min.css')); ?>" rel="stylesheet">
    <!-- Plugin CSS -->
    <link href="<?php echo e(asset('vendor/magnific-popup/magnific-popup.css')); ?>" rel="stylesheet" type="text/css">

    <!-- Custom styles for this template -->
    <link href="<?php echo e(asset('css/page2.css')); ?>" rel="stylesheet">
    <link rel="stylesheet" href="<?php echo e(asset('iCheck/all.css')); ?>">
    <!-- audio add -->


    <!-- -->

</head>

<body id="page-top">

<?php echo $__env->make('layouts.menu', \Illuminate\Support\Arr::except(get_defined_vars(), array('__data', '__path')))->render(); ?>

<!-- Portfolio Grid Section -->
<div id="login-box">

    <div class="container1" style="width: 100%;height: 10%;padding-top: 0px">
        <img class="img-fluid mb-5 d-block mx-auto" style="width:20%;height: 100%;margin-top:105px" src="<?php echo e(asset('img/logo.jpg')); ?>" alt="">
        <div style="width:10%;margin-left:90%"><a href="page3">Next Page</a></div>
    </div>

    <div id="instructions" style="width:120px;height:5%;margin:auto;margin-top: 0px">
        <label style="font-size: 24px">RECORDER</label>
    </div>

    
        <?php echo e(csrf_field()); ?>

    <div id="" style="width: 100%;margin: auto">
            <div id="controls">
                <button id="recordButton" style="width:100px;margin-left: 39%;border-radius:10px;">Record</button>
                <button id="pauseButton" style="width: 100px;margin-left: 2%;border-radius:10px;" disabled>Pause</button>
                <button id="stopButton" style="width:100px;margin-left: 2%;border-radius:10px;" disabled>Stop</button>
            </div>
            <ol id="recordingsList" style="margin-left:39%;margin-top:2%;"></ol>

    </div>
    

    <div id="instructions" style="width:10%;height:5%;margin:auto;margin-top: 0px">
        <label style="font-size: 24px">CATEGORY-1</label>
    </div>

    <form action="<?php echo e(url('/addCategory0')); ?>" method="post">
        <?php echo e(csrf_field()); ?>

        <?php for($i=0;$i<10;$i++){?>
        <div class="category1">

            <div id="row1">
                <div id="name" style="display:inline-block;margin-left:20%">
                    <input type="checkbox" class="flat-red select-user" name="check-<?php echo e($i); ?>" value=<?php echo e($i); ?> <?php echo e($result1[$i]['statues']); ?>/>
                </div>
                <div id="name" style="display:inline-block;">
                    <label style=""><?php echo e($i); ?>) NAME:</label>
                </div>
                <div id="name" style="display:inline-block;">
                    <label>FIRST</label>
                </div>
                <div id="name" style="display:inline-block;">
                    <?php if($result1[$i]['id']!=0): ?>
                        <input type="text" name="first_name-<?php echo e($i); ?>" value=<?php echo e($result1[$i]['first_name']); ?> />
                    <?php else: ?>
                        <input type="text" name="first_name-<?php echo e($i); ?>" placeholder="First"/>
                    <?php endif; ?>

                </div>
                <div id="name" style="display:inline-block;">
                    <label>LAST:</label>
                </div>
                <div id="name" style="display:inline-block;">
                    <?php if($result1[$i]['id']!=0): ?>
                        <input type="text" name="last_name-<?php echo e($i); ?>" value=<?php echo e($result1[$i]['last_name']); ?> />
                    <?php else: ?>
                        <input type="text" name="last_name-<?php echo e($i); ?>" placeholder="Last"/>
                    <?php endif; ?>
                </div>
                <div id="name" style="display:inline-block;">
                    <label>PHONE:</label>
                </div>
                <div id="name" style="display:inline-block;">
                    <?php if($result1[$i]['id']!=0): ?>
                        <input type="text" name="phone-<?php echo e($i); ?>" value=<?php echo e($result1[$i]['phone']); ?> />
                    <?php else: ?>
                        <input type="text" name="phone-<?php echo e($i); ?>" placeholder="phone" />
                    <?php endif; ?>

                </div>
                <div id="name" style="display:inline-block;">
                    <label>EMAIL:</label>
                </div>
                <div id="name" style="display:inline-block;">
                    <?php if($result1[$i]['id']!=0): ?>
                        <input type="email" name="email-<?php echo e($i); ?>" value=<?php echo e($result1[$i]['email']); ?> />
                    <?php else: ?>
                        <input type="email" name="email-<?php echo e($i); ?>" placeholder="email"/>
                    <?php endif; ?>
                </div>
                <input type="text" name="id-<?php echo e($i); ?>" value=<?php echo e($result1[$i]['id']); ?> style="display:none">

            </div>

        </div>


        <?php }?>
        <div id="name" style="">
            <input style="margin-left:45%;margin-bottom:3%;margin-top:2%" type="submit" value="S A V E">
        </div>
    </form>

<div style="height: 20px"></div>




</div>
<!-- Bootstrap core JavaScript -->
<script src="https://cdn.rawgit.com/mattdiamond/Recorderjs/08e7abd9/dist/recorder.js"></script>
<script src="<?php echo e(asset('vendor/jquery/jquery.min.js')); ?>"></script>
<script src="<?php echo e(asset('vendor/bootstrap/js/bootstrap.bundle.min.js')); ?>"></script>
<script src="<?php echo e(asset('iCheck/icheck.min.js')); ?>"></script>
<script src="<?php echo e(asset('iCheck/icheck.min.js')); ?>"></script>

<!-- Plugin JavaScript -->
<script src="<?php echo e(asset('vendor/jquery-easing/jquery.easing.min.js')); ?>"></script>
<script src="<?php echo e(asset('vendor/magnific-popup/jquery.magnific-popup.min.js')); ?>"></script>

<!-- Contact Form JavaScript -->
<script src="<?php echo e(asset('js/jqBootstrapValidation.js')); ?>"></script>
<script src="<?php echo e(asset('js/contact_me.js')); ?>"></script>
<script src="<?php echo e(asset('js/record.js')); ?>"></script>

<script>
    $(document).ready(function() {
        $('input[type="checkbox"].flat-red').iCheck({
            checkboxClass: 'icheckbox_flat-green'
        });
    });

</script>
<!-- Custom scripts for this template -->
</body>

</html>
