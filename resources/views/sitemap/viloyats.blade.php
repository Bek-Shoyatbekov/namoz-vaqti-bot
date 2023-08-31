<?php echo '<?xml version="1.0" encoding="UTF-8"?>'; ?>
<urlset xmlns="http://www.sitemaps.org/schemas/sitemap/0.9">

    @foreach ($viloyats as $v)
        <url>
            <loc>{{route("index")}}/viloyat/{{$v->slug}}</loc>
            <lastmod>{{ $v->created_at->tz('UTC')->toAtomString() }}</lastmod>
            <changefreq>weekly</changefreq>
            <priority>0.75</priority>
        </url>
    @endforeach
    <url>
        <loc>{{route("index")}}/viloyat</loc>
        <lastmod>{{ $viloyats[0]->created_at->tz('UTC')->toAtomString() }}</lastmod>
        <changefreq>weekly</changefreq>
        <priority>0.75</priority>
    </url>

    @foreach (["en", "oz", "ru"] as $item)

        @foreach ($viloyats as $v)
            <url>
                <loc>{{route("index")}}/{{$item}}/viloyat/{{$v->slug}}</loc>
                <lastmod>{{ $v->created_at->tz('UTC')->toAtomString() }}</lastmod>
                <changefreq>weekly</changefreq>
                <priority>0.75</priority>
            </url>
        @endforeach
        <url>
            <loc>{{route("index")}}/{{$item}}/viloyat</loc>
            <lastmod>{{ $viloyats[0]->created_at->tz('UTC')->toAtomString() }}</lastmod>
            <changefreq>weekly</changefreq>
            <priority>0.75</priority>
        </url>
    @endforeach

</urlset>
