@extends('front-blog.app')
@section('description', $description)
@section('ogp')
<meta name="twitter:card" content="summary_large_image" />
<meta name="twitter:site" content="@aaaabbbbbbcc" />
<meta name="twitter:creator" content="@aaaabbbbbbcc" />
<meta property="og:url" content="{{ route('single_show', ['article_id' => $article->article_id]) }}" />
<meta property="og:title" content="{{ $article->title }}" />
<meta property="og:description" content="{{ $description }}" />
<meta property="og:image" content="https://vercel-generating-og-images.vercel.app/{{ rawurlencode($article->title) }}.png?template=kinpokoblog" />
@endsection
@section('title', $article->title)
@section('main')
    <div class="col-md-8 col-md-offset-1">
        @empty($article)
            <p>記事がありません</p>
        @else
            <div class="card" style="margin-bottom: 20px">
                <div class="card-body">
                    <div class="card-title">
                        <h1 style="font-size: 2rem ; font-weight: bold ;">{{ $article->title }}</h1>
                        <a href="https://twitter.com/share?ref_src=twsrc%5Etfw" class="twitter-share-button"
                            data-show-count="false" data-size="large">Tweet</a>
                        <script async src="https://platform.twitter.com/widgets.js" charset="utf-8"></script>
                        <p style="margin-bottom: 60px">{{ $article->post_date->format('Y/m/d(D)') }}</p>
                    </div>
                    <p class="card-text">{!! $article->body !!}</p>
                </div>
                <div class="card-footer text-right">
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
