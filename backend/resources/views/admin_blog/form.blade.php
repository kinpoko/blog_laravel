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
                    <input class="form-control" name="post_date" size="20" value="" placeholder="日付を入力して下さい。">
                </div>

                <div class="form-group">
                    <label>タイトル</label>
                    <input class="form-control" name="title" value="" placeholder="タイトルを入力して下さい。">
                </div>

                <div class="form-group">
                    <label>本文</label>
                    <textarea class="form-control" rows="15" name="body" placeholder="本文を入力してください。"></textarea>
                </div>

                <input type="submit" class="btn btn-primary btn-sm" value="送信">
                {{ csrf_field() }}
            </form>
        </div>
    </div>
</div>

</body>

</body>
</html>