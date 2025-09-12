<?php

namespace App\Http\Controllers;

use App\Models\Content;
use App\Models\Tag;
use Illuminate\Http\Request;

class TagController extends Controller
{
    public function index()
    {
        // 全てのタグをコンテンツ数が多い順に取得
        $tags = Tag::withCount('contents')->orderBy('contents_count', 'desc')->get();

        return view("tags", compact('tags'));
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
            $title = 'タグ：' . $tag->name;
        }

        $contents = $query->latest()->paginate(12);

        return view('tags-show', compact('contents', 'title'));
    }
}