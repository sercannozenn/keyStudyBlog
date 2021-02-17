@extends('layouts.admin')
@section('title')
    Dashboard
@endsection
@section('css')
@endsection
@section('content')
    <div class="page-title">
        <div class="row">
            <div class="col s12 m9 l10">
                <h1>Dashboard</h1>

                <ul>
                    <li>
                        <a href="#"><i class="fa fa-home"></i> Home</a> /
                    </li>

                </ul>
            </div>
        </div>
    </div>

    <div class="card-panel">
        <div class="row">
            <div class="col-md-12">
                <h3>Welcome To Dashboard</h3>
            </div>
        </div>
    </div>
@endsection
@section('js')
    <script type="text/javascript" src="{{ asset('bower_components/materialize/bin/materialize.js') }}"></script>
@endsection
