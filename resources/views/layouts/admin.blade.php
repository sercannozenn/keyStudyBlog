<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>@yield('title')</title>

    <link href='http://fonts.googleapis.com/css?family=Roboto:400,100,300,500,700,900' rel='stylesheet' type='text/css'>

    <link rel="stylesheet" type="text/css"
          href="{{ asset('bower_components/nanoscroller/bin/css/nanoscroller.css') }}"/>

    <link rel="stylesheet" type="text/css" href="{{ asset('bower_components/fontawesome/css/font-awesome.min.css') }}"/>

    <link rel="stylesheet" type="text/css"
          href="{{ asset('assets/material-design-icons/css/material-design-icons.min.css') }}"/>

    <link rel="stylesheet" type="text/css" href="{{ asset('bower_components/ionicons/css/ionicons.min.css') }}"/>

    <link rel="stylesheet" type="text/css"
          href="{{ asset('bower_components/weather-icons/css/weather-icons.min.css') }}"/>

    <link rel="stylesheet" type="text/css" href="{{ asset('assets/_con/css/con-base.css') }}"/>
@yield('css')

<!--[if lt IE 9]>
    <script src="{{ asset('bower_components/html5shiv/dist/html5shiv.min.js') }}"></script>
    <![endif]-->
</head>

<body>
<nav class="navbar-top">
    <div class="nav-wrapper">
        <a href="#" class="yay-toggle">
            <div class="burg1"></div>
            <div class="burg2"></div>
            <div class="burg3"></div>
        </a>
        <a href="{{ route('dashboard') }}" class="brand-logo">
            <img src="assets/_con/images/logo.png" alt="Con">
        </a>
        <ul>
            <li class="user">
                <a class="dropdown-button" data-activates="user-dropdown" href="#!">
                    <img src="{{ asset('assets/_con/images/user.jpg') }}" alt="{{ auth()->user()->name }}"
                         class="circle"> {{ auth()->user()->name }} <i
                        class="mdi-navigation-expand-more right"></i>
                </a>

                <ul id="user-dropdown" class="dropdown-content" style="margin-top: 60px">

                    <li class="divider"></li>
                    <li>
                        <a href="#" onclick="event.preventDefault(); document.getElementById('logout-form').submit();">
                            <i class="fa fa-sign-out"></i> Logout
                        </a>
                    </li>

                    <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
                        @csrf
                    </form>
                </ul>
            </li>
        </ul>
    </div>
</nav>

<aside class="yaybar yay-shrink yay-hide-to-small yay-gestures">
    <div class="top">
        <div>
            <a href="#" class="yay-toggle">
                <div class="burg1"></div>
                <div class="burg2"></div>
                <div class="burg3"></div>
            </a>
            <a href="{{ route('dashboard') }}" class="brand-logo">
                <img src="{{ asset('assets/_con/images/logo-white.png') }}" alt="Con">
            </a>
        </div>
    </div>
    <div class="nano">
        <div class="nano-content">
            <ul>
                <li class="label">Menu</li>

                <li {{ Route::is('dashboard') ? 'class=open' : ''}}>
                    <a href="{{ route('dashboard') }}" class="yay-sub-toggle waves-effect waves-blue"> <i
                            class="fa fa-dashboard"></i> Dashboard
                    </a>
                </li>
                <li {{ Route::is('dashboard') ? 'class=open' : ''}}>
                    <a href="widgets.html" class=" waves-effect waves-blue"> <i class="fa fa-magic"></i> Articles </a>
                </li>
                @role('Admin|Moderator')
                <li {{ Route::is('dashboard') ? 'class=open' : ''}}>
                    <a href="layouts.html" class=" waves-effect waves-blue"> <i class="mdi mdi-image-timer-auto"></i>
                        Reports - Test Amaçlı / Admin-Moderator Kısıtlaması
                    </a>
                </li>
                @endrole

                @role('Admin')
                <li {{ Route::is('dashboard') ? 'class=open' : ''}}>
                    <a href="layouts.html" class=" waves-effect waves-blue"> <i class="mdi mdi-image-timer-auto"></i>
                        Users - Test Amaçlı / Admin Kısıtlaması
                    </a>
                </li>
                @endrole
            </ul>
        </div>
    </div>
</aside>
<section class="content-wrap">
    @yield('content')
</section>
<footer>&copy; {{ date('Y') }}
    <strong>Sercan Özen</strong>. All rights reserved.
</footer>

<script type="text/javascript" src="{{ asset('bower_components/jquery/dist/jquery.min.js') }}"></script>
<script type="text/javascript"
        src="{{ asset('bower_components/jquery-requestAnimationFrame/dist/jquery.requestAnimationFrame.min.js') }}"></script>
<script type="text/javascript"
        src="{{ asset('bower_components/nanoscroller/bin/javascripts/jquery.nanoscroller.min.js') }}"></script>
{{--<script type="text/javascript" src="{{ asset('bower_components/materialize/bin/materialize.js') }}"></script>--}}
<script type="text/javascript" src="{{ asset('bower_components/Sortable/Sortable.min.js') }}"></script>
<script type="text/javascript" src="{{ asset('assets/_con/js/_con.js') }}"></script>
<script type="text/javascript" src="{{ asset('bower_components/code-prettify/src/prettify.js') }}"></script>
<script src="{{ asset('assets/sweetalert2/sweetalert2.all.js') }}"></script>
@include('sweetalert::alert')
<script>
    $.ajaxSetup({
        headers: {
            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
        }
    });
</script>
@yield('js')

</body>
</html>
