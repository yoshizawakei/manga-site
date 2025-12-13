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
    private function validateContentData(Request $request)
    {
        return $request->validate([
            'title' => 'required|string|max:255|unique:contents',
            'description' => 'required|string',
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

        return back()->withErrors([
            'email' => '提供された資格情報は記録と一致しません。',
        ])->onlyInput('email');
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

        $tagsArray = [];
        if (!empty($validatedData['tag'])) {
            $tagsArray = collect(explode(',', $validatedData['tag']))->map(function ($tag) {
                return trim($tag);
            })->filter()->all();
        }

        unset($validatedData['tag']);

        $content = Content::create($validatedData);
        $this->syncTags($content, $tagsArray);

        $this->postToX($content);

        return redirect()->route('admin.dashboard')->with('success', 'コンテンツが正常に作成されました。');
    }

    private function postToX(Content $content)
    {
        // 投稿メッセージの作成 (文字数制限: 280文字に注意)
        $tags = $content->tags->pluck('name')->map(fn($t) => "#" . $t)->implode(' ');

        // 投稿文の例
        $message = "【新着コンテンツ】\n「{$content->title}」が追加されました！\n\n{$content->content_url}\n\n{$tags}";

        try {
            // ここで実際に X API に投稿リクエストを送ります

            // 例: thujohn/twitter パッケージを使用する場合の v1.1 API (現在の v2 APIとは異なる)
            // Twitter::postTweet(['status' => $message, 'format' => 'json']);

            // 例: Guzzleで v2 API の /2/tweets を叩く場合
            // $client = new \GuzzleHttp\Client(['base_uri' => 'https://api.twitter.com/']);
            // $response = $client->post('2/tweets', [
            //     'auth' => 'oauth', // OAuth 1.0a 認証設定
            //     'json' => ['text' => $message],
            // ]);

            \Log::info("X (旧Twitter) にコンテンツ投稿を試行: " . $content->title);

        } catch (\Exception $e) {
            // エラーログを記録
            \Log::error("X (旧Twitter) への投稿に失敗しました: " . $e->getMessage());
        }
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
        $validatedData = $this->validateContentData($request);

        $tagsArray = [];
        if (!empty($validatedData['tag'])) {
            $tagsArray = collect(explode(',', $validatedData['tag']))->map(function ($tag) {
                return trim($tag);
            })->filter()->all();
        }

        unset($validatedData['tag']);
        $content->update($validatedData);
        $this->syncTags($content, $tagsArray);

        return redirect()->route('admin.dashboard')->with('success', 'コンテンツが正常に更新されました。');
    }

    public function destroy(Content $content)
    {
        $content->delete();
        return redirect()->route('admin.dashboard')->with('success', 'コンテンツが正常に削除されました。');
    }

    public function showInquiry(Inquiry $inquiry)
    {
        $inquiry->is_read = true;
        $inquiry->save();
        return view('admin.show', compact('inquiry'));
    }

    private function syncTags(Content $content, array $tagsArray)
    {
        $tagIds = [];
        foreach ($tagsArray as $tagName) {
            if (!empty($tagName)) {
                $tag = Tag::firstOrCreate(['name' => $tagName]);
                $tagIds[] = $tag->id;
            }
        }
        $content->tags()->sync($tagIds);
    }
}