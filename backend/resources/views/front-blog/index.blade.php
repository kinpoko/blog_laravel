@extends('front-blog.app')
@section('title', 'kinpoko BLOG')

@section('main')
    <div class="col-md-8 col-md-offset-1">
        @forelse($list as $article)
            <div class="card" style="margin-bottom: 20px">  
            <div class="card-body">
                <div class="card-title">
                    <h4><a href="{{ route('single_show',['article_id' => $article->article_id]) }}" style="color: black; font-weight:bold">{{$article->title }}</a></h4>　
                    <p>{{ $article->post_date->format('Y/m/d(D)') }}<p>
                </div>
            </div>
                <div class="card-footer text-right" >
                    <a href="{{ route('front_index', ['category_id' => $article->category->category_id]) }}">
                        {{ $article->category->name }}
                    </a>
                    &nbsp;&nbsp;
                    最終更新日{{ $article->updated_at->format('Y/m/d H:i:s') }}
                </div>
            </div>
        @empty
            <p>記事がありません</p>
        @endforelse

        {{ $list->links('pagination::bootstrap-4') }}
    </div>
@endsection