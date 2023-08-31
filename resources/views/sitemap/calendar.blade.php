<?php echo '<?xml version="1.0" encoding="UTF-8"?>'; ?>
<urlset xmlns="http://www.sitemaps.org/schemas/sitemap/0.9">
    
    @foreach ($shahars as $s)
        @for($i = 1; $i < 13; $i++)
            <url>
                
                <loc>{{route("index")}}/oylik/{{$i}}/{{$s->slug}}</loc>

                <lastmod>{{ $s->created_at->tz('UTC')->toAtomString() }}</lastmod>
                <changefreq>daily</changefreq>
                <priority>0.9</priority>
            </url>
        @endfor
    @endforeach

    @foreach (["en", "oz", "ru"] as $item)
        @foreach ($shahars as $s)
            @for($i = 1; $i < 13; $i++)
                <url>
                    
                    <loc>{{route("index")}}/{{$item}}/oylik/{{$i}}/{{$s->slug}}</loc>

                    <lastmod>{{ $s->created_at->tz('UTC')->toAtomString() }}</lastmod>
                    <changefreq>daily</changefreq>
                    <priority>0.9</priority>
                </url>
            @endfor
        @endforeach
    @endforeach
</urlset>
