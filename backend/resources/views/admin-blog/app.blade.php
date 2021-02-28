<!DOCTYPE html>
<html lang="ja">
<head>
    <meta charset="UTF-8">
    {{--@yield ディレクティブは指定したセクションの内容を表示するために使用する--}}
    <title>@yield('title')</title>
    <link href="{{ asset('css/app.css') }}" rel="stylesheet">
    <link rel="stylesheet" href="{{ asset('/css/blog.css') }}">
    <script src="{{ asset('js/app.js') }}"></script>
</head>

<body>
@yield('body')
</body>
</html>