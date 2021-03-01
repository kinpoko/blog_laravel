<!DOCTYPE html>
<html lang="ja">
<head>
    <meta charset="UTF-8">
    {{--@yield ディレクティブは指定したセクションの内容を表示するために使用する--}}
    <link rel="stylesheet" href="{{ asset('/css/bootstrap.css') }}">
    <script src="{{ asset('js/app.js') }}"></script>
    <title>@yield('title')</title>
</head>

<body>
    @include('components.header')
    <div class="container">
        <div class="row">
            <div class="col-md-10 col-md-offset-1">
                
    
                {{--何らかのエラー表示用--}}
                @if ($errors->any())
                    <div class="alert alert-danger">
                        <ul>
                            @foreach ($errors->all() as $error)
                                <li>{{ $error }}</li>
                            @endforeach
                        </ul>
                    </div>
                @endif
            </div>
    
            {{--メインカラム--}}
            @yield('main')
            {{--右サブカラム--}}
            {{--@include ディレクティブで他のテンプレートを読み込むこともできる--}}
            @include('front-blog.right-column')
        </div>
    </div>
</body>
</html>