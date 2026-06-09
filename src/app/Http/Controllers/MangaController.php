<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Content;
use App\Models\Tag;
use Illuminate\Support\Facades\Crypt; // ← これを追加
use Illuminate\Contracts\Encryption\DecryptException; // ← エラーハンドリング用


class MangaController extends Controller
{
    /**
     * ホーム画面：記事一覧を表示
     */
    public function index()
    {
        // 記事を新しい順に取得（公開中のみ、12件でページネーション）
        $contents_all = Content::where('status', Content::STATUS_PUBLISHED)
            ->latest()
            ->paginate(12);

        // サイドバー用：最新記事5件（公開中のみ）
        $contents_latest = Content::where('status', Content::STATUS_PUBLISHED)
            ->latest()
            ->take(5)
            ->get();

        // サイドバー用：カテゴリー一覧（記事数が多い順に30個程度まで表示）
        $tags = Tag::has('contents')->withCount('contents')->orderBy('contents_count', 'desc')->take(30)->get();

        return view('index', compact('contents_all', 'contents_latest', 'tags'));
    }

    /**
     * 記事詳細画面
     */
    public function show($encryptedId)
    {
        try {
            // 1. 暗号を復号して元のIDに戻す
            $id = Crypt::decryptString($encryptedId);

            // 2. IDを使ってデータベースから取得（公開中のみ）
            $content = Content::where('status', Content::STATUS_PUBLISHED)
                ->with('tags')
                ->findOrFail($id);

        } catch (DecryptException $e) {
            // URLが改ざんされていたり、不正な文字列の場合は404エラーを出す
            abort(404);
        }

        // サイドバー用：最新記事5件（公開中のみ）
        $contents_latest = Content::where('status', Content::STATUS_PUBLISHED)
            ->latest()
            ->take(5)
            ->get();

        // サイドバー用：カテゴリー一覧
        $tags = Tag::has('contents')->withCount('contents')->orderBy('contents_count', 'desc')->take(30)->get();

        return view('show', compact('content', 'contents_latest', 'tags'));
    }
}