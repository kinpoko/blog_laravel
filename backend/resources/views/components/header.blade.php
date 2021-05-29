<div class="container">
    <div class="row">
        <div class="col-md-12 col-md-offset-1">
            <nav class="navbar navbar-expand-lg navbar-light bg-light" style="margin-bottom: 20px">
                <div class="container-fluid">
                    <a class="navbar-brand" href="{{ route('front_index') }}">
                        <h2>kinpoko BLOG</h2>
                    </a>
                    <button class="navbar-toggler" type="button" data-toggle="collapse"
                        data-target="#navbarSupportedContent" aria-controls="navbarSupportedContent"
                        aria-expanded="false" aria-label="Toggle navigation">
                        <span class="navbar-toggler-icon"></span>
                    </button>

                    <div class="collapse navbar-collapse" id="navbarSupportedContent">
                        <ul class="navbar-nav mr-auto">
                            <li class="nav-item active">
                                <a class="nav-link" href="{{ route('front_index') }}">Home <span
                                        class="sr-only">(current)</span></a>
                            </li>
                            <li class="nav-item">
                                <a class="nav-link" href="https://kinpoko.github.io/react-profile">About</a>
                            </li>
                            <li class="nav-item">
                                <a class="nav-link" href="https://github.com/kinpoko">GitHub</a>
                            </li>
                            <li class="nav-item">
                                <a class="nav-link" href="{{ route('rss') }}">RSS</a>
                            </li>
                        </ul>
                    </div>
            </nav>
        </div>
    </div>
</div>
