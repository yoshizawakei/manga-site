<?php

namespace App\Http\Controllers;

use App\Models\Content;
use App\Models\Tag;
use Illuminate\Http\Response;
use Illuminate\Support\Facades\Crypt;

class SitemapController extends Controller
{
    public function index(): Response
    {
        $xml = [];

        // XML開始
        $xml[] = '<?xml version="1.0" encoding="UTF-8"?>';
        $xml[] = '<urlset xmlns="http://www.sitemaps.org/schemas/sitemap/0.9">';

        /*
        |--------------------------------------------------------------------------
        | TOPページ
        |--------------------------------------------------------------------------
        */

        $xml[] = '
        <url>
            <loc>' . url('/') . '</loc>
            <lastmod>' . now()->toAtomString() . '</lastmod>
        </url>';

        /*
        |--------------------------------------------------------------------------
        | 固定ページ
        |--------------------------------------------------------------------------
        */

        $staticPages = [
            'top.profile',
            'top.contact',
            'top.sitePolicy',
            'top.privacyPolicy',
            'top.disclaimer',
        ];

        foreach ($staticPages as $routeName) {

            $xml[] = '
            <url>
                <loc>' . route($routeName) . '</loc>
                <lastmod>' . now()->subMonth()->toAtomString() . '</lastmod>
            </url>';
        }

        /*
        |--------------------------------------------------------------------------
        | 記事ページ
        |--------------------------------------------------------------------------
        */

        Content::select('id', 'updated_at')
            ->orderByDesc('updated_at')
            ->chunk(500, function ($contents) use (&$xml) {

                foreach ($contents as $content) {

                    $encryptedId = Crypt::encryptString($content->id);

                    $xml[] = '
                    <url>
                        <loc>' . route('post.show', $encryptedId) . '</loc>
                        <lastmod>' . $content->updated_at->toAtomString() . '</lastmod>
                    </url>';
                }
            });

        /*
        |--------------------------------------------------------------------------
        | タグページ
        |--------------------------------------------------------------------------
        */

        $tags = Tag::all();

        foreach ($tags as $tag) {

            $xml[] = '
            <url>
                <loc>' . route('tags.show', $tag->name) . '</loc>
                <lastmod>' . now()->subWeek()->toAtomString() . '</lastmod>
            </url>';
        }

        // XML終了
        $xml[] = '</urlset>';

        return response(
            implode("\n", $xml),
            200
        )->header('Content-Type', 'application/xml');
    }
}