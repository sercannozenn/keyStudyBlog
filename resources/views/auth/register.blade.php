<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="icon" href="{{ asset('assets/_con/images/icon.png') }}">

    <title>User Register</title>

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

<section id="sign-up">

    <!-- Background Bubbles -->
    <canvas id="bubble-canvas"></canvas>
    <!-- /Background Bubbles -->

    <!-- Sign Up Form -->
    <form action="{{ route('register') }}" method="POST">
        @csrf
        <div class="row links">
            <div class="col s6 logo">
                <img src="{{ asset('assets/_con/images/logo-white.png') }}" alt="">
            </div>
            <div class="col s6 right-align"><a href="{{ route('login') }}">Sign In</a> /
                <strong>Sign Up</strong>
            </div>
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
                <!-- First Name -->
                <div class="col m12 s12">
                    <div class="input-field">
                        <i class="fa fa-user prefix"></i>
                        <input id="input_name" name="name" type="text">
                        <label for="input_name">Name</label>
                    </div>
                </div>
                <!-- /First Name -->
            </div>

            <!-- Email -->
            <div class="input-field">
                <i class="fa fa-envelope prefix"></i>
                <input id="input_email" type="email" name="email">
                <label for="input_email">Email</label>
            </div>
            <!-- /Email -->


            <!-- Password -->
            <div class="input-field">
                <i class="fa fa-unlock-alt prefix"></i>
                <input id="input_password" type="password" name="password">
                <label for="input_password">Password</label>
            </div>
            <!-- /Password -->

            <!-- Password Confirm-->
            <div class="input-field">
                <i class="fa fa-unlock-alt prefix"></i>
                <input id="input_password_confirmation" type="password" name="password_confirmation">
                <label for="input_password_confirmation">Password Confirmation</label>
            </div>
            <!-- /Password Confirm-->

            <button class="waves-effect waves-light btn-large z-depth-0 z-depth-1-hover">Sign Up</button>
        </div>

    </form>
    <!-- /Sign Up Form -->

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
