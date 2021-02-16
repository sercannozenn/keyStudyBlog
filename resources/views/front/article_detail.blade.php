@extends('layouts.front')
@section('title')
@endsection
@section('css')
    <link rel="stylesheet" href="{{ asset('assets/front/css/rate.css') }}">
@endsection
@section('content')
    <div class="container mt-5">
        <div class="row">
            <div class="col-md-12">
                <div class="card">
                    <div class="card-header">
                        <h5 class="text-capitalize">
                            {{ $article->title }}
                        </h5>
                    </div>
                    <div class="card-body">
                        {!! $article->body !!}
                        <hr>
                    </div>
                    <div class="card-footer">
                        <h6>Your Rate</h6>
                        <?php
                        $calculateRate = $item->singleCalculate();
                        ?>
                        <fieldset class="rating mr-5">
                            <input type="radio" id="star5" name="rating"
                                   value="5" {{ round($calculateRate) == 5 ? 'checked' :'' }}/>
                            <label class="full" for="star5" title="5"></label>
                            <input type="radio" id="star4" name="rating" value="4"
                                {{ round($calculateRate) == 4 ? 'checked' :'' }}/>
                            <label class="full" for="star4" title="4"></label>
                            <input type="radio" id="star3" name="rating"
                                   value="3" {{ round($calculateRate) == 3 ? 'checked' :'' }}/>
                            <label class="full" for="star3" title="3"></label>
                            <input type="radio" id="star2" name="rating" value="2"
                                {{ round($calculateRate) == 2 ? 'checked' :'' }}/>
                            <label class="full" for="star2" title="1"></label>
                            <input type="radio" id="star1" name="rating"
                                   value="1" {{ round($calculateRate) == 1 ? 'checked' :'' }}/>
                            <label class="full" for="star1" title="1"></label>
                            </label>
                        </fieldset>
                        <h5 class="ml-5">Rate: {{ $article->singleCalculate() }}</h5>
                    </div>
                </div>
                @if ($article->previous())
                    <a href="{{ route('front.articleDetail', ['article' => $article->previous()->slug]) }}"> < Previous Article</a>
                @endif
                 -
                @if ($article->next())
                    <a href="{{ route('front.articleDetail', ['article' => $article->next()->slug]) }}">Next Article ></a>
                @endif

            </div>
        </div>
    </div>
@endsection
@section('js')
    <script>
        $('input[name=rating]').change(function ()
        {
            let rate = $(this).val();
            let id = '{{ $article->id }}';
            let self=$(this);
            $.ajax({
                method: 'POST',
                url: '{{ route('front.articleRate', ['article' => request('article')->slug]) }}',
                data: {
                    rate: rate,
                    id: id
                },
                success: function (response)
                {
                    Swal.fire({
                        icon: 'success',
                        title: 'You used your vote.',
                        showConfirmButton: true,
                    });
                },
                error: function (jqXHR, exception)
                {
                    Swal.fire({
                        icon: 'error',
                        title: jqXHR.statusText,
                        text:'Please login and vote.',
                        showConfirmButton: true,
                    });
                    self.prop('checked', false);
                }
            })
        })
    </script>
@endsection
