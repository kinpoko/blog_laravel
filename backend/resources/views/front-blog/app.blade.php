<!DOCTYPE html>
<html lang="ja">
<head>
    <meta charset="UTF-8">
    <link rel="stylesheet" href="{{ asset('/css/bootstrap.css') }}">
    <link rel="stylesheet" href="{{ asset('/css/blog.css') }}">
    <link rel="stylesheet" href="{{ asset('/css/blog-show.css') }}">
    <meta name="viewport" content="width=device-width">
    <meta name="description" content="@yield('description')">
    <title>@yield('title')</title>
</head>

<body>
    @include('components.header')
    <div class="container">
        <div class="row">
            <div class="col-md-10 col-md-offset-1">
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
            @yield('main')
            @include('front-blog.right-column')
        </div>
    </div>
</body>
</html>