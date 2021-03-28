
<div class="col-md-4">
    <div class="card" style="margin-bottom: 20px">
        <div class="card-header"><h5>kinpokoのTwitter</h5></div>
        <div class="card-body">
        <a class="twitter-timeline" data-height="400" data-theme="light" data-chrome="nofooter noheader" href="https://twitter.com/aaaabbbbbbcc?ref_src=twsrc%5Etfw">Tweets by aaaabbbbbbcc</a> <script async src="https://platform.twitter.com/widgets.js" charset="utf-8"></script>
    </div>
    </div>
    <div class="card" style="margin-bottom: 20px">
        <div class="card-header"><h5>カテゴリー</h5></div>
        <ul class="list-group-flush" style="padding-inline-start: 0px">
                @forelse($category_list as $category)
                    <li class="list-group-item">
                        <a href="{{ route('front_index', ['category_id' => $category->category_id]) }}">
                            {{ $category->name }}
                        </a>
                    </li>
                @empty
                    <p>カテゴリーがありません</p>
                @endforelse
        </ul>
    </div>
    <div class="card" style="margin-bottom: 20px">
        <div class="card-header"><h5>月別アーカイブ</h5></div>
            <ul class="list-group-flush" style="padding-inline-start: 0px">
               
                @forelse($month_list as $value)
                <li class="list-group-item">
                <a href="{{ route('front_index', ['year' => $value->year, 'month' => $value->month]) }}" class="card-link">
                    {{ $value->year_month }}
                </a>
                </li>
                @empty
                    <p>記事がありません</p>
                @endforelse
            </ul>
    </div>
</div>