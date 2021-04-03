<!DOCTYPE html>
<html lang="ja">
<head>
    <meta charset="UTF-8">
    <title>@yield('title')</title>
    <link rel="stylesheet" href="{{ asset('/css/bootstrap.css') }}">
    <link rel="stylesheet" href="{{ asset('/css/blog-show.css') }}">
    <script src="{{ asset('js/app.js') }}"></script>
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <meta  name="viewport" content="width=device-width">
    @yield('head')
</head>

<body>
@yield('body')
</body>
</html>