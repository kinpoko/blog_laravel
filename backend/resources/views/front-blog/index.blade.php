@extends('front-blog.app')
@section('title', 'kinpoko BLOG')

@section('main')
    <div class="col-md-8 col-md-offset-1">
        {{--forelse ディレクティブを使うと、データがあるときはループし、無いときは @empty 以下を実行する--}}
        @forelse($list as $article)
            <div class="card" style="margin-bottom: 20px">  
            {{--post_date はモデルクラスで $dates プロパティに指定してあるので、自動的に Carbon インスタンスにキャストされる--}}
            <div class="card-body" style="margin-left: 2px">
                <h4 class="card-title">{{ $article->title }}</h4>
                    <div class="card-text">
                        {{--nl2br 関数で改行文字を <br> に変換する。これをエスケープせずに表示させるため {!! !!} で囲む--}}
                        {{--ただし、このまま出力するととても危険なので e メソッドで htmlspecialchars 関数を通しておく--}}
                        {!! nl2br(e($article->body)) !!}
                    </div>
            </div>
                <div class="card-footer text-right" style="height: 30px">
                    <a href="{{ route('front_index', ['category_id' => $article->category->category_id]) }}">
                        {{ $article->category->name }}
                    </a>
                    &nbsp;&nbsp;
                    {{--updated_at も同様に自動的に Carbon インスタンスにキャストされる--}}
                    {{ $article->updated_at->format('Y/m/d H:i:s') }}
                </div>
            </div>
        @empty
            <p>記事がありません</p>
        @endforelse

        {{ $list->links('pagination::bootstrap-4') }}
    </div>
@endsection