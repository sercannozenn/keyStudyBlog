@extends('layouts.front')
@section('title')
@endsection
@section('css')
    <link rel="stylesheet" href="{{ asset('assets/front/css/rate.css') }}">
@endsection
@section('content')
    <div class="container mt-5">
        <div class="row">
            @foreach($list as $item)
                <div class="col-md-4">
                    <div class="card">
                        <div class="card-header">
                            <h5 class="text-capitalize">
                                {{ $item->title }}
                            </h5>
                        </div>
                        <div class="card-body">
                            {!! $item->body !!}
                            <hr>
                            <a href="{{ route('front.articleDetail', ['article' => $item->slug]) }}"
                               class="btn btn-primary">Read More</a>
                        </div>

                        <div class="card-footer">
                            <h6>Your Rate</h6>
                            <?php
                            $calculateRate = $item->singleCalculate();
                            ?>
                            <fieldset class="rating mr-5">
                                <input type="radio" id="star5" name="rating-{{ $item->id }}"
                                       value="5" {{ round($calculateRate) == 5 ? 'checked' :'' }}/>
                                <label class="full" for="star5" title="5"></label>
                                <input type="radio" id="star4" name="rating-{{ $item->id }}" value="4"
                                    {{ round($calculateRate) == 4 ? 'checked' :'' }}/>
                                <label class="full" for="star4" title="4"></label>
                                <input type="radio" id="star3" name="rating-{{ $item->id }}"
                                       value="3" {{ round($calculateRate) == 3 ? 'checked' :'' }}/>
                                <label class="full" for="star3" title="3"></label>
                                <input type="radio" id="star2" name="rating-{{ $item->id }}" value="2"
                                    {{ round($calculateRate) == 2 ? 'checked' :'' }}/>
                                <label class="full" for="star2" title="1"></label>
                                <input type="radio" id="star1" name="rating-{{ $item->id }}"
                                       value="1" {{ round($calculateRate) == 1 ? 'checked' :'' }}/>
                                <label class="full" for="star1" title="1"></label>
                                </label>
                            </fieldset>
                            <h5 class="ml-5">Rate: {{ $calculateRate }}</h5>
                        </div>
                    </div>
                </div>
            @endforeach
        </div>
    </div>
@endsection
@section('js')
    <script>

    </script>
@endsection
