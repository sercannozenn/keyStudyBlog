@extends('layouts.admin')
@section('title')
@endsection
@section('css')
    <style>
        /*input[type='checkbox'] {*/
        /*    left: unset !important;*/
        /*    position: relative !important;*/
        /*    display: block !important;*/
        /*    visibility: visible !important;*/
        /*}*/
        .calendar-time select {
            display: unset;
        }
    </style>
    <link rel="stylesheet" type="text/css" href="{{ asset('assets/daterangepicker-master/daterangepicker.css') }}">

@endsection
@section('content')
    <div class="card-panel">

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
            <div class="col-md-12">

                <form action="" method="POST" class="mb-10">
                    @csrf
                    <div class="input-field">
                        <input id="input_text" type="text" class="validate" name="title" placeholder="Title"
                               value="{{ old('title', $article->title ?? '') }}">
                    </div>
                    <div class="input-field">
                        <label for="publish_date">Publish Date</label>
                        <br>
                        <input id="publish_date" name="publish_date" type="text" value=""
                            {{ isset($article) && \Carbon\Carbon::parse($article->publish_date) < now() ? 'disabled' : '' }}>
                    </div>
                    <div class="input-field">
                        <input type="checkbox" id="publish_now" name="publish_now"
                            {{ isset($article) && \Carbon\Carbon::parse($article->publish_date) < now() ? 'disabled' : '' }}/>
                        <label for="publish_now">Publish Now</label>
                    </div>
                    <div class="input-field">
                        <textarea name="body" id="body" cols="30" rows="5" placeholder="Article Contents">{!! $article->body ?? '' !!}</textarea>
                    </div>

                    <div class="input-field">
                        <input type="checkbox" id="status" name="status" {{ isset($article) && $article->status ? 'checked' : '' }}/>
                        <label for="status">Status</label>
                    </div>
                    <hr>

                    <button class="waves-effect waves-dark btn light-blue" type="submit">{{ isset($article) ? 'Edit' : 'Create' }}</button>
                </form>
            </div>
        </div>
    </div>
@endsection
@section('js')
    <script src="{{ asset('assets/ckeditor/ckeditor.js') }}" charset="utf-8"></script>
    <script src="{{ asset('assets/front/js/moment-with-locales.min.js') }}"></script>
    <script src="{{ asset('assets/daterangepicker-master/daterangepicker.js') }}"></script>
    <script>
        var options = {
            filebrowserImageBrowseUrl: '/laravel-filemanager?type=Images',
            filebrowserImageUploadUrl: '/laravel-filemanager/upload?type=Images&_token=',
            filebrowserBrowseUrl: '/laravel-filemanager?type=Files',
            filebrowserUploadUrl: '/laravel-filemanager/upload?type=Files&_token=',
            entities_latin: false
        };
        CKEDITOR.replace('body', options);
        $('#publish_date').daterangepicker(
            {
                locale: {
                    format: 'DD/MM/YYYY hh:mm:ss'
                },
                singleDatePicker: true,
                timePicker: true,
                minDate: moment(),
                timePicker24Hour: true,
                startDate : "{{ old('publish_date', isset($article) ? \Carbon\Carbon::parse($article->publish_date)->format('d-m-Y H:i:s') : now()->format('d-m-Y H:i:s')) }}"
            }
        );

    </script>


@endsection
