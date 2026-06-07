<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Tag;
use App\Models\Inquiry;
use App\Models\Content;

class ContactController extends Controller
{
    public function showForm()
    {
        // サイドバー用のデータを一括取得
        $tags = Tag::has('contents')->withCount('contents')->orderBy('contents_count', 'desc')->limit(30)->get();
        $contents_latest = Content::latest()->take(5)->get(); // orderByの代わりにlatest()を使用

        return view("contact", compact('tags', 'contents_latest'));
    }

    public function submitForm(Request $request)
    {
        $validated = $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|email|max:255',
            'subject' => 'nullable|string|max:255',
            'message' => 'required|string',
        ]);

        // バリデーション済みのデータのみを使用して保存
        Inquiry::create($validated);

        // メッセージを表示させたいページへリダイレクト
        return redirect()->route('top.contact')->with('success', 'お問い合わせありがとうございます。2~3営業日以内にご入力いただいたメールアドレスへご連絡いたします。');
    }

    /**
     * 管理画面用：問い合わせ詳細表示
     */
    public function showInquiry(Inquiry $inquiry)
    {
        // 問い合わせを既読にする
        $inquiry->update(['is_read' => true]);

        return view('admin.detail', compact('inquiry'));
    }

    /**
     * お問い合わせの削除処理
     */
    public function destroyInquiry(Inquiry $inquiry)
    {
        $inquiry->delete();

        // ダッシュボードへ戻り、成功メッセージを表示
        return redirect()->route('admin.dashboard')->with('success', 'お問い合わせを削除しました。');
    }
}