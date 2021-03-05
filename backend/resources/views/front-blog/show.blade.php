@extends('front-blog.app')
@section('title', $article->title)
@section('main')
    <div class="col-md-8 col-md-offset-1">
        @empty($article)
            <p>記事がありません</p>
        @else    
        <div class="card" style="margin-bottom: 20px">  
            <div class="card-body" >
                <div class="card-title">
                    <h1 style="font-size: 2rem ;font-weight:bold">{{$article->title }}</h1>
                    <p style="margin-bottom: 60px">{{ $article->post_date->format('Y/m/d(D)') }}</p> 
                </div>    
                        <p class="card-text">{!!$article->body!!}</p>
            </div>
            <div class="card-footer text-right" >
                <a href="{{ route('front_index', ['category_id' => $article->category->category_id]) }}">
                    {{ $article->category->name }}
                </a>
                &nbsp;&nbsp;
                最終更新日{{ $article->updated_at->addHours(9)->format('Y/m/d H:i:s') }}
            </div>
        @endempty
        </div>
    </div>
@endsection