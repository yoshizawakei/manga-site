<?php

namespace App\Http\Controllers;

use App\Models\Content;
use App\Models\Tag;
use App\Models\Inquiry;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Validation\ValidationException;

class AdminController extends Controller
{
    // ... 既存のメソッド (login, logout, authenticate) はそのまま

    /**
     * コンテンツ登録フォームを表示
     * メソッド名を create に変更
     *
     * @return \Illuminate\View\View
     */
    public function create()
    {
        return view('admin.create'); // ビューファイル名も admin.create に変更することを推奨
    }

    /**
     * 新しいコンテンツを保存し、タグを紐づける
     * バリデーションとタグ処理を改善
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\RedirectResponse
     */
    public function store(Request $request)
    {
        $validatedData = $this->validateContentData($request);

        // バリデーション済みのデータでコンテンツを作成
        $content = Content::create($validatedData);

        // タグを紐づける
        $this->syncTags($content, $validatedData['tag']);

        return redirect()->route('admin.dashboard')->with('success', 'コンテンツが正常に作成されました。');
    }

    /**
     * ダッシュボード画面を表示 (コンテンツ一覧を含む)
     * コンテンツ一覧にページネーションを適用
     *
     * @return \Illuminate\View\View
     */
    public function dashboard()
    {
        // ページネーションを適用してコンテンツを取得
        $contents = Content::latest()->with('tags')->paginate(10); // 1ページあたり10件

        $inquiries_count = Inquiry::where('is_read', false)->count();
        $inquiries = Inquiry::latest()->limit(10)->get();

        return view('admin.dashboard', compact('contents', 'inquiries', 'inquiries_count'));
    }

    /**
     * コンテンツの編集フォームを表示
     *
     * @param  \App\Models\Content  $content
     * @return \Illuminate\View\View
     */
    public function edit(Content $content)
    {
        $tags = $content->tags->pluck('name')->implode(', ');
        return view('admin.edit', compact('content', 'tags'));
    }

    /**
     * コンテンツを更新
     * バリデーションとタグ処理を改善
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Content  $content
     * @return \Illuminate\Http\RedirectResponse
     */
    public function update(Request $request, Content $content)
    {
        $validatedData = $this->validateContentData($request);

        // コンテンツを更新
        $content->update($validatedData);

        // タグを同期
        $this->syncTags($content, $validatedData['tag']);

        return redirect()->route('admin.dashboard')->with('success', 'コンテンツが正常に更新されました。');
    }

    /**
     * コンテンツを削除
     *
     * @param  \App\Models\Content  $content
     * @return \Illuminate\Http\RedirectResponse
     */
    public function destroy(Content $content)
    {
        $content->delete();
        return redirect()->route('admin.dashboard')->with('success', 'コンテンツが正常に削除されました。');
    }

    /**
     * お問い合わせ詳細を表示
     *
     * @param  \App\Models\Inquiry  $inquiry
     * @return \Illuminate\View\View
     */
    public function showInquiry(Inquiry $inquiry)
    {
        // 問い合わせを既読にする
        $inquiry->is_read = true;
        $inquiry->save();

        // 問い合わせ詳細ビューにデータを渡す
        return view('admin.inquiries.show', compact('inquiry'));
    }

    /**
     * コンテンツデータのバリデーションを行うプライベートメソッド
     *
     * @param  \Illuminate\Http\Request  $request
     * @return array
     */
    private function validateContentData(Request $request)
    {
        return $request->validate([
            'title' => 'required|string|max:255',
            'description' => 'nullable|string',
            'image_url' => 'nullable|string|url',
            'content_url' => 'nullable|string|url',
            'tag' => 'nullable|string',
        ]);
    }

    /**
     * タグをコンテンツに同期するプライベートメソッド
     *
     * @param  \App\Models\Content  $content
     * @param  string|null  $tagString
     * @return void
     */
    private function syncTags(Content $content, $tagString)
    {
        $tagIds = [];
        if (!empty($tagString)) {
            $tagNames = explode(',', $tagString);
            $tagNames = array_map('trim', $tagNames);

            foreach ($tagNames as $tagName) {
                if (!empty($tagName)) {
                    $tag = Tag::firstOrCreate(['name' => $tagName]);
                    $tagIds[] = $tag->id;
                }
            }
        }
        $content->tags()->sync($tagIds);
    }
}