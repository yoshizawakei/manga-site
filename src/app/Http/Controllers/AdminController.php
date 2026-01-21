<?php

namespace App\Http\Controllers;

use App\Models\Content;
use App\Models\Tag;
use App\Models\Inquiry;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class AdminController extends Controller
{
    // バリデーションの共通化（$idがある場合は更新時に自分を除外）
    private function validateContentData(Request $request, $id = null)
    {
        return $request->validate([
            'title' => 'required|string|max:255|unique:contents,title,' . $id,
            'description' => 'required|string',
            'body' => 'nullable|string', // ★追加：レビュー本文
            'image_url' => 'nullable',
            'content_url' => 'required',
            'tag' => 'nullable|string',
        ]);
    }

    public function login()
    {
        return view('admin.login');
    }

    public function authenticate(Request $request)
    {
        $credentials = $request->validate([
            'email' => ['required', 'email'],
            'password' => ['required'],
        ]);
        if (Auth::attempt($credentials)) {
            $request->session()->regenerate();
            return redirect()->intended(route('admin.dashboard'));
        }
        return back()->withErrors(['email' => '認証情報が一致しません。'])->onlyInput('email');
    }

    public function logout(Request $request)
    {
        Auth::logout();
        $request->session()->invalidate();
        $request->session()->regenerateToken();
        return redirect()->route('admin.login');
    }

    public function create()
    {
        return view('admin.index');
    }

    public function store(Request $request)
    {
        $validatedData = $this->validateContentData($request);
        $tagsArray = $this->parseTags($validatedData['tag'] ?? '');
        unset($validatedData['tag']);

        $content = Content::create($validatedData);
        $this->syncTags($content, $tagsArray);
        $this->postToX($content);

        return redirect()->route('admin.dashboard')->with('success', 'コンテンツを新規作成しました。');
    }

    public function dashboard()
    {
        $contents = Content::latest()->with('tags')->paginate(10);
        $inquiries_count = Inquiry::where('is_read', false)->count();
        $inquiries = Inquiry::latest()->limit(10)->get();
        return view('admin.dashboard', compact('contents', 'inquiries', 'inquiries_count'));
    }

    public function edit(Content $content)
    {
        $tags = $content->tags->pluck('name')->implode(', ');
        return view('admin.edit', compact('content', 'tags'));
    }

    public function update(Request $request, Content $content)
    {
        $validatedData = $this->validateContentData($request, $content->id);
        $tagsArray = $this->parseTags($validatedData['tag'] ?? '');
        unset($validatedData['tag']);

        $content->update($validatedData);
        $this->syncTags($content, $tagsArray);

        return redirect()->route('admin.dashboard')->with('success', 'コンテンツを更新しました。');
    }

    public function destroy(Content $content)
    {
        $content->delete();
        return redirect()->route('admin.dashboard')->with('success', 'コンテンツを削除しました。');
    }

    public function showInquiry(Inquiry $inquiry)
    {
        $inquiry->is_read = true;
        $inquiry->save();
        return view('admin.show', compact('inquiry'));
    }

    private function parseTags($tagString)
    {
        return collect(explode(',', $tagString))->map(fn($t) => trim($t))->filter()->all();
    }

    private function syncTags(Content $content, array $tagsArray)
    {
        $tagIds = [];
        foreach ($tagsArray as $tagName) {
            $tag = Tag::firstOrCreate(['name' => $tagName]);
            $tagIds[] = $tag->id;
        }
        $content->tags()->sync($tagIds);
    }

    private function postToX(Content $content)
    {
        $tags = $content->tags->pluck('name')->map(fn($t) => "#" . $t)->implode(' ');
        $message = "【新着レビュー】\n「{$content->title}」を追加しました！\n\n{$content->content_url}\n\n{$tags}";
        \Log::info("X投稿試行: " . $content->title);
    }
}