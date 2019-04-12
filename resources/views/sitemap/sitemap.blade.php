<?xml version="1.0" encoding="UTF-8"?>
<urlset xmlns="http://www.sitemaps.org/schemas/sitemap/0.9">
    @foreach($sitemap as $url => $params )
    <url>
        <loc>{{$url}}</loc>
        @if(isset($params['lastmod']))
            <lastmod>{{$params['lastmod']}}</lastmod>
        @endif
        <changefreq>{{$params['changefreq']}}</changefreq>
        <priority>{{$params['priority']}}</priority>
    </url>
    @endforeach
</urlset>