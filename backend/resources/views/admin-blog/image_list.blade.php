@extends('admin-blog.app')
@section('title', '画像リスト')
@section('body')
<a href="{{ route('upload_form') }}">Upload</a>
<hr/>

@foreach($images as $image)
<div style="width: 18rem; float:left; margin: 16px;">
	<img src="{{ Storage::url($image->file_path) }}" style="width:100%;" class="img-fluid"/>
	<p>{{ $image->file_name }}</p>  
    <p>{{ Storage::url($image->file_path) }}</p>
</div>
@endforeach
@endsection