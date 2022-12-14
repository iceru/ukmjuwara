<?xml version="1.0" encoding="UTF-8"?>
<urlset xmlns="http://www.sitemaps.org/schemas/sitemap/0.9">
    <url>
        <loc>https://ukmjagowan.id/</loc>
    </url>
    <url>
        <loc>https://ukmjagowan.id/tentang-kami</loc>
    </url>
    <url>
        <loc>https://ukmjagowan.id/kemitraan</loc>
    </url>
    @foreach ($posts as $post)
        <url>
            <loc>https://ukmjagowan.id/berita/{{ $post->slug }}</loc>
        </url>
    @endforeach
    @foreach ($catalogs as $catalog)
        <url>
            <loc>https://ukmjagowan.id/katalog/{{ $catalog->slug }}</loc>
        </url>
    @endforeach
    @foreach ($ukms as $ukm)
        <url>
            <loc>https://ukmjagowan.id/ukm/{{ $ukm->slug }}</loc>
        </url>
    @endforeach
</urlset>
