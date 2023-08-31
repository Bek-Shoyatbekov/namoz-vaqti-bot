<?php echo '<?xml version="1.0" encoding="UTF-8"?>'; ?>
<urlset xmlns="http://www.sitemaps.org/schemas/sitemap/0.9">
        @foreach ($shahars as $s)
            <url>
                <loc>{{route("index")}}/ramazon/{{$s->slug}}</loc>
                <lastmod>{{ $s->created_at->tz('UTC')->toAtomString() }}</lastmod>
                <changefreq>daily</changefreq>
                <priority>0.9</priority>
            </url>
        @endforeach
    @foreach (["en", "oz", "ru"] as $item)
        @foreach ($shahars as $s)
            <url>
                <loc>{{route("index")}}/{{$item}}/ramazon/{{$s->slug}}</loc>
                <lastmod>{{ $s->created_at->tz('UTC')->toAtomString() }}</lastmod>
                <changefreq>daily</changefreq>
                <priority>0.9</priority>
            </url>
        @endforeach
    @endforeach
</urlset>