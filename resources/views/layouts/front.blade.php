<!doctype html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport"
          content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>@yield('title')</title>
    <link rel="stylesheet" href="{{ asset('assets/front/css/bootstrap.min.css') }}">
    <style>
        footer{
            height: 50px;
            background-color: #0a6aa1;
            color: #fff;
            text-align: center;
            font-size: 14px;
            letter-spacing: 0.14em;
            font-weight: bold;
            line-height: 50px;
            vertical-align: center;
        }
       body :nth-child(2) .container{
            min-height: 50vh;
        }
    </style>
    @yield('css')
</head>
<body>
<nav class="navbar navbar-expand-lg navbar-dark bg-dark">
    <div class="container">
        <a class="navbar-brand text-primary mr-0 mr-md-5" href="{{ route('index') }}">Sercan Özen | Key Study</a>
        <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent"
                aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
            <span class="navbar-toggler-icon"></span>
        </button>

        <div class="navbar-collapse collapse ml-0 ml-md-5" id="navbarSupportedContent">
            <ul class="navbar-nav ">
                <li class="nav-item active">
                    <a class="nav-link" href="{{ route('index') }}">Home <span class="sr-only">(current)</span></a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="#">Link</a>
                </li>

            </ul>
            <ul class="navbar-nav ml-auto">
                @auth
                    <li class="nav-item dropdown">
                        <a class="nav-link dropdown-toggle" href="#" id="navbarDropdown" role="button"
                           data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                            Welcome {{ auth()->user()->name }}
                        </a>
                        <div class="dropdown-menu" aria-labelledby="navbarDropdown">
                            <a class="dropdown-item" href="#">Profile</a>
                            <div class="dropdown-divider"></div>
                            <a class="dropdown-item" onclick="event.preventDefault(); document.getElementById('logout-form').submit();"
                               href="#">Logout</a>
                            <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
                                @csrf
                            </form>
                        </div>
                    </li>
                @else
                    <li class="nav-item">
                        <a class="nav-link" href="{{ route('login') }}">Login</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="{{ route('register') }}">Sign Up</a>
                    </li>
                @endauth
            </ul>
        </div>
    </div>
</nav>

@yield('content')

<footer>
    &copy; {{ date('Y') }} Sercan Özen
</footer>
<script src="{{ asset('assets/front/js/jquery-3.5.1.js') }}"></script>
<script src="{{ asset('assets/front/js/bootstrap.js') }}"></script>
<script src="{{ asset('assets/front/js/bootstrap.bundle.js') }}"></script>
@include('sweetalert::alert')
<script src="{{ asset('assets/sweetalert2/sweetalert2.all.js') }}"></script>
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
