<?php

namespace App\Http\Controllers;

use App\Models\Content;
use App\Models\Tag;
use Illuminate\Http\Request;

class TagController extends Controller
{
    public function index()
    {
        // 【最適化】ステータスを Content::STATUS_PUBLISHED ('published') に合わせて修正
        // 公開中の記事を1件以上持つタグだけを取得し、公開記事のみの件数をカウント
        $tags = Tag::whereHas('contents', function ($q) {
            $q->where('status', Content::STATUS_PUBLISHED);
        })->withCount([
                    'contents' => function ($q) {
                        $q->where('status', Content::STATUS_PUBLISHED);
                    }
                ])->orderBy('contents_count', 'desc')->get();

        // サイドバー用：最新の「公開記事」だけを5件取得
        $contents_latest = Content::where('status', Content::STATUS_PUBLISHED)->latest()->take(5)->get();

        // サイドバー用：公開記事を持つタグリスト（最大30件）
        $sidebar_tags = Tag::whereHas('contents', function ($q) {
            $q->where('status', Content::STATUS_PUBLISHED);
        })->withCount([
                    'contents' => function ($q) {
                        $q->where('status', Content::STATUS_PUBLISHED);
                    }
                ])->orderBy('contents_count', 'desc')->take(30)->get();

        return view("tags", compact('tags', 'contents_latest', 'sidebar_tags'));
    }

    public function show(Request $request, $tagName = null)
    {
        // 【最適化】ベースとなるクエリに「公開中（published）」をセット
        $query = Content::where('status', Content::STATUS_PUBLISHED);
        $title = '検索結果';

        // 検索キーワードがあるかチェック
        if ($request->filled('keyword')) {
            $keyword = $request->input('keyword');
            $query->where(function ($q) use ($keyword) {
                $q->where('title', 'like', '%' . $keyword . '%')
                    ->orWhere('description', 'like', '%' . $keyword . '%');
            });
            $title = '検索結果：' . $keyword;
        }
        // タグ名があるかチェック
        elseif ($tagName) {
            $tag = Tag::where('name', $tagName)->firstOrFail();

            // 紐づく記事が「公開中（published）」であるものに限定して絞り込み
            $query->whereHas('tags', function ($q) use ($tag) {
                $q->where('tags.id', $tag->id);
            });
            $title = $tag->name;
        }

        $contents = $query->latest()->paginate(12);

        // サイドバー用：最新の「公開記事」だけを5件取得
        $contents_latest = Content::where('status', Content::STATUS_PUBLISHED)->latest()->take(5)->get();

        // サイドバー用：公開記事の件数だけをカウントしたタグリスト（最大30件）
        $tags = Tag::whereHas('contents', function ($q) {
            $q->where('status', Content::STATUS_PUBLISHED);
        })->withCount([
                    'contents' => function ($q) {
                        $q->where('status', Content::STATUS_PUBLISHED);
                    }
                ])->orderBy('contents_count', 'desc')->take(30)->get();

        return view('tags-show', compact('contents', 'title', 'contents_latest', 'tags'));
    }
}