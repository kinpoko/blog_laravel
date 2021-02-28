<!DOCTYPE html>
<html lang="ja">
<head>
    <meta charset="UTF-8">
    <title>ブログ記事投稿フォーム</title>
    
    <link href="{{ asset('css/app.css') }}" rel="stylesheet">
    <link rel="stylesheet" href="{{ asset('/css/blog.css') }}">
    <script src="{{ asset('js/app.js') }}"></script>
</head>

<body>

<div class="container">
    <div class="row">
        <div class="col-md-8 col-md-offset-2">
            <h2>ブログ記事投稿・編集</h2>
            
            @if (session('message'))
                <div class="alert alert-success">
                     
                    {{ session('message') }}
                </div>
                <br>
            @endif

            @if ($errors->any())
                <div class="alert alert-danger">
                    <ul>
                        
                        @foreach ($errors->all() as $error)
                            <li>{{ $error }}</li>
                        @endforeach
                    </ul>
                </div>
            @endif
            
            <form method="POST" action="{{ route('admin_post') }}">
                <div class="form-group">
                    <label>日付</label>
                    {{--{{$variable or 'Default'}} は {{isset($variable) ? $variable : 'Default'}} と同じ意味で、変数があるかどうかわからないときに便利です--}}
                    <input class="form-control" name="post_date" size="20" value="{{ isset($input['post_date']) ? $input['post_date'] : null }}" placeholder="日付を入力して下さい。">
                </div>

                <div class="form-group">
                    <label>タイトル</label>
                    <input class="form-control" name="title" value="{{ isset($input['title']) ? $input['title'] : null }}" placeholder="タイトルを入力して下さい。">
                </div>

                <div class="form-group">
                    <label>本文</label>
                    <textarea class="form-control" rows="15" name="body" placeholder="本文を入力してください。">{{ isset($input['body']) ? $input['body'] : null }}</textarea>
                </div>

                <input type="submit" class="btn btn-primary btn-sm" value="送信">
                {{--article_id があるか無いかで新規作成か既存編集かを区別する--}}
                <input type="hidden" name="article_id" value="{{ $article_id }}">
                {{--CSRFトークンが生成される--}}
                {{ csrf_field() }}
            </form>
            @if ($article_id)
            <br>
            <form action="{{ route('admin_delete') }}" method="POST">
                <input type="submit" class="btn btn-primary btn-sm" value="削除">
                <input type="hidden" name="article_id" value="{{ $article_id }}">
                {{ csrf_field() }}
            </form>
        @endif
        </div>
    </div>
</div>

</body>

</body>
</html>