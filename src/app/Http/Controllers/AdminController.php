<?php

namespace App\Http\Controllers;

use App\Models\Content;
use App\Models\Tag;
use App\Models\Inquiry;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class AdminController extends Controller
{
    // ... 既存のメソッド (login, logout, authenticate, index) はそのまま

    /**
     * コンテンツ登録フォームを表示
     *
     * @return \Illuminate\View\View
     */
    public function index()
    {
        return view('admin.index');
    }

    /**
     * 新しいコンテンツを保存し、タグを紐づける
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\RedirectResponse
     */
    public function store(Request $request)
    {
        // データの検証
        $validatedData = $request->validate([
            'title' => 'required|string|max:255',
            'description' => 'nullable|string',
            'image_url' => 'nullable|string',
            'content_url' => 'nullable|string',
            'tag' => 'nullable|string',
        ]);

        // 新しいContentインスタンスを作成し、基本データを保存
        $content = new Content;
        $content->title = $validatedData['title'];
        $content->description = $validatedData['description'];
        $content->image_url = $validatedData['image_url'];
        $content->content_url = $validatedData['content_url'];
        $content->save();

        // タグの処理
        if (!empty($validatedData['tag'])) {
            $tagNames = explode(',', $validatedData['tag']);
            $tagNames = array_map('trim', $tagNames);

            $tagIds = [];
            foreach ($tagNames as $tagName) {
                if (!empty($tagName)) {
                    $tag = Tag::firstOrCreate(['name' => $tagName]);
                    $tagIds[] = $tag->id;
                }
            }

            $content->tags()->attach($tagIds);
        }

        return redirect()->route('admin.dashboard')->with('success', 'コンテンツが正常に作成されました。');
    }

    /**
     * ダッシュボード画面を表示 (コンテンツ一覧を含む)
     *
     * @return \Illuminate\View\View
     */
    public function dashboard()
    {
        $contents = Content::latest()->with('tags')->get();

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
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Content  $content
     * @return \Illuminate\Http\RedirectResponse
     */
    public function update(Request $request, Content $content)
    {
        $validatedData = $request->validate([
            'title' => 'required|string|max:255',
            'description' => 'nullable|string',
            'image_url' => 'nullable|string',
            'content_url' => 'nullable|string',
            'tag' => 'nullable|string',
        ]);

        $content->update($validatedData);

        $tagIds = [];
        if (!empty($validatedData['tag'])) {
            $tagNames = explode(',', $validatedData['tag']);
            $tagNames = array_map('trim', $tagNames);

            foreach ($tagNames as $tagName) {
                if (!empty($tagName)) {
                    $tag = Tag::firstOrCreate(['name' => $tagName]);
                    $tagIds[] = $tag->id;
                }
            }
        }
        $content->tags()->sync($tagIds);

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

    public function showInquiry(Inquiry $inquiry)
    {
        // 問い合わせを既読にする
        if (!$inquiry->is_read) {
            $inquiry->is_read = true;
            $inquiry->save();
        }

        // 問い合わせ詳細ビューにデータを渡す
        return view('admin.inquiries.show', compact('inquiry'));
    }
}