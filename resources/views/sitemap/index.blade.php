<?php echo '<?xml version="1.0" encoding="UTF-8"?>'; ?>
<sitemapindex xmlns="http://www.sitemaps.org/schemas/sitemap/0.9">
    <sitemap>
        <loc>{{route("sitemap.main")}}</loc>
    </sitemap>
    @if($rs)
        <sitemap>
            <loc>{{route("sitemap.ramazon")}}</loc>
            <lastmod>{{$shahar->updated_at->tz("UTC")->toAtomString()}}</lastmod>
        </sitemap>
    @endif
    <sitemap>
        <loc>{{route("sitemap.oylik")}}</loc>
        <lastmod>{{$shahar->updated_at->tz("UTC")->toAtomString()}}</lastmod>
    </sitemap>
    <sitemap>
        <loc>{{route("sitemap.yillik")}}</loc>
        <lastmod>{{$shahar->updated_at->tz("UTC")->toAtomString()}}</lastmod>
    </sitemap>
    <sitemap>
        <loc>{{route("sitemap.index")}}/viloyat</loc>
        <lastmod>{{$viloyat->updated_at->tz("UTC")->toAtomString()}}</lastmod>
    </sitemap>
    <sitemap>
        <loc>{{route("sitemap.index")}}/shahar</loc>
        <lastmod>{{$shahar->updated_at->tz("UTC")->toAtomString()}}</lastmod>
    </sitemap>
</sitemapindex>
