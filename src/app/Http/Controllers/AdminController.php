<?php

namespace App\Http\Controllers;

use App\Models\Content;
use App\Models\Tag;
use App\Models\Inquiry;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage; // 画像保存に必須

class AdminController extends Controller
{
    // バリデーションの共通化
    private function validateContentData(Request $request, $id = null)
    {
        return $request->validate([
            'title' => 'required|string|max:255|unique:contents,title,' . $id,
            'description' => 'required|string',
            'body' => 'nullable|string',
            'image' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048', // ファイルバリデーション
            'image_url' => 'nullable|string',
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
        if (Auth::attempt($credentials, true)) {
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

        if ($request->hasFile('image')) {
            $path = $request->file('image')->store('contents', 'public');
            $validatedData['image_url'] = \Storage::url($path);
        }

        // bodyが確実に含まれるように明示的に配列を作成
        $content = Content::create([
            'title' => $validatedData['title'],
            'description' => $validatedData['description'],
            'body' => $request->input('body'), // 確実に入力値を取得
            'image_url' => $validatedData['image_url'] ?? null,
            'content_url' => $validatedData['content_url'],
        ]);

        $tagsArray = $this->parseTags($validatedData['tag'] ?? '');
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

        if ($request->hasFile('image')) {
            $path = $request->file('image')->store('contents', 'public');
            $validatedData['image_url'] = \Storage::url($path);
        }

        // 更新時も明示的に指定
        $content->update([
            'title' => $validatedData['title'],
            'description' => $validatedData['description'],
            'body' => $request->input('body'),
            'image_url' => $validatedData['image_url'] ?? $content->image_url,
            'content_url' => $validatedData['content_url'],
        ]);

        $tagsArray = $this->parseTags($validatedData['tag'] ?? '');
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
        \Log::info("X投稿試行: " . $content->title);
    }
}