<?php echo '<?xml version="1.0" encoding="UTF-8"?>'; ?>
<rss version="2.0" xmlns:atom="http://www.w3.org/2005/Atom">
    <channel>
        <title>{{ $site_title }}</title>
        <link>{{ $site_url }}</link>
        <atom:link href="{{ $xml_url }}" rel="self" type="application/rss+xml" />
        <description>{{ $site_description }}</description>
        @forelse($list as $article)
        <item>
            <title>{{ $article->title }}</title>
            <link>{{ route('single_show',['article_id' => $article->article_id]) }}</link>
            <guid>{{ route('single_show',['article_id' => $article->article_id]) }}</guid>
            <pubDate>{{ $article->updated_at->format('D, d M Y H:i:s')   }} GMT</pubDate>
        </item>
        @empty
        <item></item>
        @endforelse
    </channel>
</rss>