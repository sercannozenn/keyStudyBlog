<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="icon" href="{{ asset('assets/_con/images/icon.png') }}">

    <title>Login</title>

    <link href='http://fonts.googleapis.com/css?family=Roboto:400,100,300,500,700,900' rel='stylesheet' type='text/css'>

    <!-- nanoScroller -->
    <link rel="stylesheet" type="text/css"
          href="{{ asset('bower_components/nanoscroller/bin/css/nanoscroller.css') }}"/>

    <!-- FontAwesome -->
    <link rel="stylesheet" type="text/css" href="{{ asset('bower_components/fontawesome/css/font-awesome.min.css') }}"/>

    <!-- Material Design Icons -->
    <link rel="stylesheet" type="text/css"
          href="{{ asset('assets/material-design-icons/css/material-design-icons.min.css') }}"/>

    <!-- IonIcons -->
    <link rel="stylesheet" type="text/css" href="{{ asset('bower_components/ionicons/css/ionicons.min.css') }}"/>

    <!-- WeatherIcons -->
    <link rel="stylesheet" type="text/css"
          href="{{ asset('bower_components/weather-icons/css/weather-icons.min.css') }}"/>

    <!-- Main -->
    <link rel="stylesheet" type="text/css" href="{{ asset('assets/_con/css/con-base.css') }}"/>

<!--[if lt IE 9]>
    <script src="{{ asset('bower_components/html5shiv/dist/html5shiv.min.js') }}"></script>
    <![endif]-->


</head>

<body>

<section id="sign-in">

    <!-- Background Bubbles -->
    <canvas id="bubble-canvas"></canvas>
    <!-- /Background Bubbles -->

    <!-- Sign In Form -->
    <form action="{{ route('login') }}" method="POST">
        @csrf

        <div class="row links">
            <div class="col s6 logo">
                <img src="assets/_con/images/logo-white.png" alt="">
            </div>
            <div class="col s6 right-align">
                <strong>Sign In</strong> / <a href="{{ route('register') }}">Sign Up</a></div>
        </div>

        <div class="card-panel clearfix">
            @if($errors->any())
                <div class="row mr-0">
                    <div class="col-12">
                        @foreach ($errors->all() as $error)
                            <div class="alert alert-danger">
                                {{ $error }}
                            </div>
                        @endforeach
                    </div>
                </div>
            @endif
            <div class="row">
                <div class="col"></div>
            </div>

            <!-- Username -->
            <div class="input-field">
                <i class="fa fa-user prefix"></i>
                <input id="username-input" type="email" name="email" class="validate" value="{{ old('email') }}">
                <label for="username-input">Email</label>
            </div>
            <!-- /Username -->

            <!-- Password -->
            <div class="input-field">
                <i class="fa fa-unlock-alt prefix"></i>
                <input id="password-input" type="password" name="password" class="validate">
                <label for="password-input">Password</label>
            </div>
            <!-- /Password -->

            <div class="switch">
                <label>
                    <input type="checkbox" name="remember" checked/>
                    <span class="lever"></span>
                    Remember
                </label>
            </div>

            <button class="waves-effect waves-light btn-large z-depth-0 z-depth-1-hover">Sign In</button>
        </div>

    </form>
    <!-- /Sign In Form -->

</section>


<!-- jQuery -->
<script type="text/javascript" src="{{ asset('bower_components/jquery/dist/jquery.min.js') }}"></script>

<!-- jQuery RAF (improved animation performance) -->
<script type="text/javascript"
        src="{{ asset('bower_components/jquery-requestAnimationFrame/dist/jquery.requestAnimationFrame.min.js') }}"></script>

<!-- nanoScroller -->
<script type="text/javascript"
        src="{{ asset('bower_components/nanoscroller/bin/javascripts/jquery.nanoscroller.min.js') }}"></script>

<!-- Materialize -->
<script type="text/javascript" src="{{ asset('bower_components/materialize/bin/materialize.js') }}"></script>


<!-- Sortable -->
<script type="text/javascript" src="{{ asset('bower_components/Sortable/Sortable.min.js') }}"></script>

<!-- Main -->
<script type="text/javascript" src="{{ asset('assets/_con/js/_con.js') }}"></script>

<!-- Google Prettify -->
<script type="text/javascript" src="{{ asset('bower_components/code-prettify/src/prettify.js') }}"></script>


</body>

</html>
