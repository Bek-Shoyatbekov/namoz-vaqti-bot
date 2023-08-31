<?php echo '<?xml version="1.0" encoding="UTF-8"?>'; ?>
<urlset xmlns="http://www.sitemaps.org/schemas/sitemap/0.9">
    <url>
        <loc>{{route("index")}}</loc>
        <priority>1.0</priority>
        <changefreq>Daily</changefreq>
    </url>

    @foreach (["en", "oz", "ru"] as $item)
        <url>
            <loc>{{route("index")}}/{{$item}}</loc>
            <priority>1.0</priority>
            <changefreq>Daily</changefreq>
        </url>
    @endforeach

    <url>
        <loc>{{route("qibla")}}</loc>
        <priority>1.0</priority>
    </url>
</urlset>