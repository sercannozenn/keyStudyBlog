@extends('layouts.front')
@section('title')
@endsection
@section('css')
    <link rel="stylesheet" href="{{ asset('assets/front/css/rate.css') }}">
@endsection
@section('content')
    <div class="container my-3">
        <div class="row">
            @foreach($list as $item)
                <div class="col-md-4 mt-5">
                    <div class="card">
                        <div class="card-header">
                            <h6 class="text-capitalize">
                                {{ $item->title }}
                            </h6>
                        </div>
                        <div class="card-body">
                            {!! strip_tags(substr($item->body, 0, 50)) !!}
                            <hr>
                            <a href="{{ route('front.articleDetail', ['article' => $item->slug]) }}"
                               class="btn btn-primary">Read More</a>
                        </div>

                        <div class="card-footer">
                            <?php
                            $calculateRate = $item->singleCalculate;
                            ?>
                                <fieldset class="ratingResult mr-5 float-left">

                                    <label for="star5" status="{{round($calculateRate) == 5 ? 'true' :'false'  }}"
                                           title="5"></label>

                                    <label for="star4" status="{{ round($calculateRate) >= 4 ? 'true' :'false' }}"
                                           title="4"></label>

                                    <label for="star3" status="{{ round($calculateRate) >= 3 ? 'true' :'false' }}"
                                           title="3"></label>

                                    <label for="star2" status="{{ round($calculateRate) >= 2 ? 'true' :'false' }}"
                                           title="1"></label>

                                    <label for="star1" status="{{ round($calculateRate) >= 1 ? 'true' :'false'  }}"
                                           title="1"></label>
                                </fieldset>

                                <h5 class="ml-5">Rate: {{ $calculateRate }}</h5>

                        </div>
                    </div>
                </div>
            @endforeach
            <div class="col-md-12 mt-4">
                {{ $list->links() }}
            </div>
        </div>
    </div>
@endsection
@section('js')

@endsection
