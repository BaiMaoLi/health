<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- CSRF Token -->
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>Reset Password</title>

    {{--<!-- Scripts -->--}}
    {{--<script src="{{ asset('public/js/app.js') }}" defer></script>--}}

    <!-- Fonts -->
    <link rel="dns-prefetch" href="https://fonts.gstatic.com">
    <link href="https://fonts.googleapis.com/css?family=Raleway:300,400,600" rel="stylesheet" type="text/css">
    <link rel="stylesheet" href="{{asset('public/css/forgot.css')}}">
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>

</head>

<body>
    <div class="main-content">
        <div class="logo-area">
            <img class="logo-img" src="{{asset('public/guest/images/logo.png')}}"/>
        </div>
        <h4 class="reset-password-title">Reset your password</h4>

        <div class="form-part">
            @if (session('status'))
                {{--<div class="alert alert-success" role="alert">--}}
                    {{--{{ session('status') }}--}}
                {{--</div>--}}
                <h5 class="reset-link-receieved lighter">
                    Check your email for a link to reset your password. If it doesn’t appear within a few minutes, check your spam folder.
                </h5>
                <button class="submit-btn back" id="back">Return to sign in</button>
            @else
                <h5 class="password-reset-subject">Enter your email address and we will send you a link to reset your password</h5>
                <form method="POST" action="{{ route('password.email') }}" aria-label="{{ __('Reset Password') }}">
                    @csrf
                    <div class="form-group">
                        <input id="email" type="email" class="form-control{{ $errors->has('email') ? ' is-invalid' : '' }}" name="email" value="{{ old('email') }}" placeholder="Email"  required>
                        @if ($errors->has('email'))
                            <span class="invalid-feedback" role="alert">
                        <strong>{{ $errors->first('email') }}</strong>
                    </span>
                        @endif
                    </div>

                    <button type="submit" class="submit-btn">
                        {{ __('Send Password Reset Link') }}
                    </button>
                </form>
            @endif
        </div>

    </div>
<script>
    $('#back').click(function () {
        window.location.href='/login';
    })

</script>

</body>

