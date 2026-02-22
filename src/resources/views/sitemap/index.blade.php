<?xml version="1.0" encoding="UTF-8"?>
<urlset xmlns="http://www.sitemaps.org/schemas/sitemap/0.9">
@foreach ($urls as $url)
    <url>
        {{-- URLの末尾のスラッシュやエスケープ処理を確実にする --}}
        <loc>{{ url($url['loc']) }}</loc>
        
        {{-- CarbonのtoAtomString()は W3C Datetime 形式に準拠しているため最適です --}}
        <lastmod>{{ \Carbon\Carbon::parse($url['lastmod'])->toAtomString() }}</lastmod>
        
        <changefreq>{{ $url['changefreq'] ?? 'weekly' }}</changefreq>
        
        {{-- 優先度は0.0から1.0の間で数値として出力 --}}
        <priority>{{ number_format($url['priority'] ?? 0.5, 1) }}</priority>
    </url>
@endforeach
</urlset>