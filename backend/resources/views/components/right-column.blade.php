<div class="col-md-4">
    <div class="card" style="margin-bottom: 20px">
        <div class="card-header">
            <h5>最近の投稿</h5>
        </div>
        <ul class="list-group-flush" style="padding-inline-start: 0px">
            @forelse($recent_list as $recentpost)
                <li class="list-group-item">
                    <a href="{{ route('single_show', ['article_id' => $recentpost->article_id]) }}">{{ $recentpost->title }}
                    </a>
                </li>
            @empty
                <p>記事がありません</p>
            @endforelse
        </ul>
    </div>
    <div class="card" style="margin-bottom: 20px">
        <div class="card-header">
            <h5 id="category">カテゴリー</h5>
        </div>
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
        <div class="card-header">
            <h5 id="archive">月別アーカイブ</h5>
        </div>
        <ul class="list-group-flush" style="padding-inline-start: 0px">

            @forelse($month_list as $value)
                <li class="list-group-item">
                    <a href="{{ route('front_index', ['year' => $value->year, 'month' => $value->month]) }}"
                        class="card-link">
                        {{ $value->year_month }}
                    </a>
                </li>
            @empty
                <p>記事がありません</p>
            @endforelse
        </ul>
    </div>
</div>
