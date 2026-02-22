<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Content;
use App\Models\Tag;

class MangaController extends Controller
{
    /**
     * ホーム画面：記事一覧を表示
     */
    public function index()
    {
        // 記事を新しい順に取得（12件でページネーション）
        $contents_all = Content::latest()->paginate(12);

        // サイドバー用：最新記事5件
        $contents_latest = Content::latest()->take(5)->get();

        // サイドバー用：カテゴリー一覧（記事数が多い順に30個程度まで表示）
        $tags = Tag::withCount('contents')->orderBy('contents_count', 'desc')->take(30)->get();

        return view('index', compact('contents_all', 'contents_latest', 'tags'));
    }

    /**
     * 記事詳細画面
     */
    public function show($id)
    {
        // 指定されたIDのコンテンツをタグと一緒に取得
        $content = Content::with('tags')->findOrFail($id);

        // サイドバー用：最新記事5件
        $contents_latest = Content::latest()->take(5)->get();

        // サイドバー用：カテゴリー一覧
        $tags = Tag::withCount('contents')->orderBy('contents_count', 'desc')->take(30)->get();

        return view('show', compact('content', 'contents_latest', 'tags'));
    }
}