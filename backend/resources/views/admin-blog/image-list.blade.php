@extends('admin-blog.app')

@section('title', '画像リスト')

@section('body')
    <div class="container">
        <div class="row">
            <div class="col-md-8 col-md-offset-2">
                <h2>アップロード画像一覧</h2>
                @if (session('message'))
                    <div class="alert alert-success">

                        {{ session('message') }}
                    </div>
                    <br>
                @endif
                <br>
                @if (count($errors) > 0)
                    <div class="alert alert-danger">
                        <ul>
                            @foreach ($errors->all() as $error)
                                <li>{{ $error }}</li>
                            @endforeach
                        </ul>
                    </div>

                @endif
                <form method="post" action="{{ route('upload_image') }}" enctype="multipart/form-data">
                    @csrf
                    <input type="file" name="image" accept="image/png, image/jpeg">
                    <input type="submit" value="Upload">
                </form>
                <br>
                <table class="table table-striped">
                    <tr>
                        <th width="120px">名前</th>
                        <th width="120px">PATH</th>
                        <th></th>
                    </tr>
                    @foreach ($images as $image)
                        <tr>
                            <td><a href="{{ $image->file_path }}">{{ $image->file_name }}</a></td>
                            <td>{{ $image->file_path }}</td>
                            <td>
                                <form action="{{ route('delete_image') }}" method="POST">
                                    <input type="submit" class="btn btn-primary btn-sm" value="削除">
                                    <input type="hidden" name="image_id" value="{{ $image->id }}">
                                    @csrf
                                </form>
                            </td>
                        </tr>
                    @endforeach

            </div>
        </div>
    </div>
@endsection
