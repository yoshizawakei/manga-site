<?php

namespace App\Http\Controllers;

use App\Models\Content;
use App\Models\Tag;
use Illuminate\Http\Response;

class SitemapController extends Controller
{
    public function index(): Response
    {
        $xml = [];

        $xml[] = '<?xml version="1.0" encoding="UTF-8"?>';
        $xml[] = '<urlset xmlns="http://www.sitemaps.org/schemas/sitemap/0.9">';

        $xml[] = '
        <url>
            <loc>' . url('/') . '</loc>
            <lastmod>' . now()->toAtomString() . '</lastmod>
            <changefreq>daily</changefreq>
            <priority>1.0</priority>
        </url>';

        $staticPages = [
            ['route' => 'top.profile',      'priority' => '0.8'],
            ['route' => 'tags.index',        'priority' => '0.8'],
            ['route' => 'top.contact',       'priority' => '0.5'],
            ['route' => 'top.sitePolicy',    'priority' => '0.3'],
            ['route' => 'top.privacyPolicy', 'priority' => '0.3'],
            ['route' => 'top.disclaimer',    'priority' => '0.3'],
        ];

        foreach ($staticPages as $page) {
            $xml[] = '
            <url>
                <loc>' . route($page['route']) . '</loc>
                <lastmod>' . now()->subMonth()->toAtomString() . '</lastmod>
                <changefreq>monthly</changefreq>
                <priority>' . $page['priority'] . '</priority>
            </url>';
        }

        Content::select('slug', 'updated_at')
            ->published()
            ->orderByDesc('updated_at')
            ->chunk(500, function ($contents) use (&$xml) {
                foreach ($contents as $content) {
                    $xml[] = '
                    <url>
                        <loc>' . route('post.show', $content->slug) . '</loc>
                        <lastmod>' . $content->updated_at->toAtomString() . '</lastmod>
                        <changefreq>monthly</changefreq>
                        <priority>0.7</priority>
                    </url>';
                }
            });

        $tags = Tag::has('contents')->get();
        foreach ($tags as $tag) {
            $xml[] = '
            <url>
                <loc>' . route('tags.show', $tag->name) . '</loc>
                <lastmod>' . now()->subWeek()->toAtomString() . '</lastmod>
                <changefreq>weekly</changefreq>
                <priority>0.6</priority>
            </url>';
        }

        $xml[] = '</urlset>';

        return response(
            implode("\n", $xml),
            200
        )->header('Content-Type', 'application/xml');
    }
}
