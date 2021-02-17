@extends('layouts.admin')
@section('title')
@endsection
@section('css')

@endsection
@section('content')
    <div class="card-panel">
        <div class="row">
            <div class="col-md-12">
                <div class="row">
                    <div class="col m4">
                        <h4>Articles</h4>

                    </div>
                    <div class="col m8">
                        <a href="{{ route('article.create') }}" class="btn btn-success btn-medium">New Article</a>
                    </div>
                </div>
                <hr>
                <table class="table table-hover">
                    <thead>
                    <tr>
                        <th>#</th>
                        <th>Process</th>
                        <th>Title</th>
                        <th>Slug</th>
                        <th>Content</th>
                        <th>Username</th>
                        <th>Publish Date</th>
                        <th>Created At</th>
                        <th>Updated At</th>
                    </tr>
                    </thead>
                    <tbody>
                    @foreach($list as $item)
                        <tr id="row-{{ $item->id }}">
                            <th>{{ $item->id }}</th>
                            <th>
                                <a href="{{ route('article.show', ['id' => $item->id]) }}"> <i class="fa fa-eye "></i></a>
                                <a href="{{ route('article.edit', ['id' => $item->id]) }}"> <i class="fa fa-edit "></i></a>
                                <a href="javascript:void(0)" class="deleteArticle" data-id="{{ $item->id }}"> <i
                                        class="fa fa-trash"></i></a>
                            </th>
                            <th>{{ $item->title }}</th>
                            <th>{{ $item->slug }}</th>
                            <th>{{ strip_tags(substr($item->body,0,100)) }}</th>
                            <th>{{ $item->user->name }}</th>
                            <th>{{ \Carbon\Carbon::parse($item->publish_date)->format('d-m-Y H:i:s')}}</th>
                            <th>{{ \Carbon\Carbon::parse($item->created_at)->format('d-m-Y H:i:s')}}</th>
                            <th>{{ \Carbon\Carbon::parse($item->updated_at)->format('d-m-Y H:i:s')}}</th>
                        </tr>
                    @endforeach
                    </tbody>
                </table>

            </div>
        </div>
    </div>
@endsection
@section('js')
    <script>
        $(document).ready(function ()
        {
            $('.deleteArticle').click(function ()
            {
                let id = $(this).data('id');

                Swal.fire({
                    title: 'Are you sure?',
                    text: "Are you sure you want to delete the article with ID:" + id,
                    icon: 'warning',
                    showCancelButton: true,
                    confirmButtonColor: '#3085d6',
                    cancelButtonColor: '#d33',
                    confirmButtonText: 'Yes, delete it!'
                }).then((result) => {
                    if (result.isConfirmed) {
                        $.ajax({
                            method: 'POST',
                            url: '{{ route('article.delete') }}',
                            data: {
                                id: id
                            },
                            success: function (response)
                            {
                                $('#row-' + id).remove();
                                Swal.fire({
                                    icon: 'success',
                                    title: 'Success Delete',
                                    showConfirmButton: true,
                                });
                            },
                            error: function ()
                            {

                            }
                        })
                    }
                });

            });
        });
    </script>
@endsection
