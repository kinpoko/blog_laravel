{{--右カラム--}}
<div class="col-md-3">
    <div class="card" style="margin-bottom: 20px">
        <div class="card-header"><h4>カテゴリー</h4></div>
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
        <div class="card-header"><h4>月別アーカイブ</h4></div>
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