<?php

namespace App\Http\Controllers;

use App\Models\Content;
use App\Models\Tag;
use Illuminate\Http\Response;

class SitemapController extends Controller
{
    public function index(): Response
    {
        $urls = [];

        // 1. トップページ
        $urls[] = [
            'loc' => '/', // Blade側の url() ヘルパで絶対パス化するため相対パスで保持
            'lastmod' => now(), // Carbonオブジェクトのまま渡す
            'changefreq' => 'daily',
            'priority' => 1.0,
        ];

        // 2. 固定ページ
        $staticPages = [
            'top.profile' => 0.5,
            'top.contact' => 0.5,
            'top.sitePolicy' => 0.3, // プライバシーポリシーなどは少し優先度を下げるのが一般的
            'top.privacyPolicy' => 0.3,
            'top.disclaimer' => 0.3,
        ];
        foreach ($staticPages as $routeName => $priority) {
            $urls[] = [
                'loc' => route($routeName, [], false), // 相対パスで取得しBladeで加工
                'lastmod' => now(),
                'changefreq' => 'monthly',
                'priority' => $priority,
            ];
        }

        // 3. 全ての記事（実践記）
        // メモリ節約のため、全カラムではなく必要なものだけ取得するのがベター
        $contents = Content::select('id', 'updated_at')->orderBy('updated_at', 'desc')->get();
        foreach ($contents as $content) {
            $urls[] = [
                'loc' => route('manga.show', $content->id, false),
                'lastmod' => $content->updated_at,
                'changefreq' => 'weekly',
                'priority' => 0.8,
            ];
        }

        // 4. 全てのカテゴリー（タグ）
        $tags = Tag::all();
        foreach ($tags as $tag) {
            $urls[] = [
                'loc' => route('tags.show', $tag->name, false),
                'lastmod' => now(),
                'changefreq' => 'weekly',
                'priority' => 0.4,
            ];
        }

        return response()
            ->view('sitemap.index', compact('urls'))
            ->header('Content-Type', 'text/xml; charset=UTF-8'); // application/xmlよりtext/xmlが一般的です
    }
}