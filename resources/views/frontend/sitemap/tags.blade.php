<?php echo '<?xml version="1.0" encoding="UTF-8"?>'; ?>
<urlset xmlns="http://www.sitemaps.org/schemas/sitemap/0.9">
    @foreach ($tags as $tag)
    <url>
        <loc>{{config('services.app.base_url')}}/tag/{{ $tag->slug }}</loc>
        <lastmod>{{ $tag->updated_at }}</lastmod>
        <changefreq>weekly</changefreq>
        <priority>0.9</priority>
    </url>
    @endforeach
</urlset>