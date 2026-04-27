<?php

namespace App\Http\Controllers;

use App\Models\Content;
use App\Models\Tag;
use Illuminate\Http\Request;

class TagController extends Controller
{
    public function index()
    {
        // 全てのタグを取得
        $tags = Tag::withCount('contents')->orderBy('contents_count', 'desc')->get();

        // ★サイドバー用のデータを取得（これを追加）
        $contents_latest = Content::latest()->take(5)->get();
        // ★サイドバー用のタグリスト（必要に応じて）
        $sidebar_tags = Tag::withCount('contents')->orderBy('contents_count', 'desc')->take(30)->get();

        return view("tags", compact('tags', 'contents_latest', 'sidebar_tags'));
    }

    public function show(Request $request, $tagName = null)
    {
        $query = Content::query();
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
            $query->whereHas('tags', function ($q) use ($tag) {
                $q->where('tags.id', $tag->id);
            });
            $title = $tag->name; // 「タグ：」を外すとスッキリします
        }

        $contents = $query->latest()->paginate(12);

        // ★サイドバー用のデータを取得
        $contents_latest = Content::latest()->take(5)->get();

        $tags = Tag::withCount('contents')->orderBy('contents_count', 'desc')->take(30)->get();

        return view('tags-show', compact('contents', 'title', 'contents_latest', 'tags'));
    }
}