<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Tag;
use App\Models\Content; // ★これを追加：Contentモデルを使えるようにする

class PageController extends Controller
{
    /**
     * サイトポリシー
     */
    public function sitePolicy()
    {
        $contents_latest = Content::orderBy('created_at', 'desc')->take(5)->get();
        return view("site_policy", compact('contents_latest'));
    }

    /**
     * 免責事項
     */
    public function disclaimer()
    {
        $contents_latest = Content::orderBy('created_at', 'desc')->take(5)->get();
        return view("disclaimer", compact('contents_latest'));
    }

    /**
     * プライバシーポリシー
     */
    public function privacyPolicy()
    {
        $contents_latest = Content::orderBy('created_at', 'desc')->take(5)->get();
        return view("privacy_policy", compact('contents_latest'));
    }

    /**
     * プロフィール
     */
    public function profile()
    {
        // サイドバーに表示する最新記事を5件取得
        $contents_latest = Content::orderBy('created_at', 'desc')->take(5)->get();

        $tags = Tag::withCount('contents')->orderBy('contents_count', 'desc')->take(30)->get(); // ★追加

        return view('profile', compact('contents_latest', 'tags'));

    }

}