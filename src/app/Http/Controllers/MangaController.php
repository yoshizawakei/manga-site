<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Content;
use App\Models\Tag;

class MangaController extends Controller
{
    public function index() {
    $contents_all = Content::latest()->paginate(12);
    $contents_latest = Content::latest()->take(5)->get(); // サイドバー用
    $tags = Tag::withCount('contents')->orderBy('contents_count', 'desc')->take(10)->get(); // 人気タグ

    return view('index', compact('contents_all', 'contents_latest', 'tags'));
}

    public function show($id)
    {
        // 指定されたIDの作品を、関連するタグと一緒に取得
        $content = Content::with('tags')->findOrFail($id);

        // サイドバーに表示するための「最新作品」も取得（５件など）
        $contents_latest = Content::orderBy('created_at', 'desc')->take(5)->get();

        return view('show', compact('content', 'contents_latest'));
    }
}