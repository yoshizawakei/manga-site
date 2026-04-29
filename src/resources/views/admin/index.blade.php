@extends('layouts.app')

@section('title', '新規ログ作成')

@section("css")
    <style>
        /* 1. 編集画面の全体レイアウト */
        body {
            background-color: #f1f5f9 !important;
        }

        .editor-card {
            background-color: #ffffff !important;
            border: 1px solid #cbd5e1 !important;
            padding: 40px;
            border-radius: 20px;
            box-shadow: 0 10px 25px rgba(0, 0, 0, 0.05);
        }

        /* 2. 入力フィールドのデザイン */
        input[type="text"],
        input[type="file"],
        textarea {
            display: block !important;
            width: 100% !important;
            border: 2px solid #334155 !important;
            background-color: #ffffff !important;
            padding: 15px !important;
            margin-bottom: 20px !important;
            border-radius: 8px !important;
            font-size: 1rem !important;
            color: #000000 !important;
        }

        input:focus,
        textarea:focus {
            border-color: #10b981 !important;
            outline: none !important;
            box-shadow: 0 0 0 4px rgba(16, 185, 129, 0.2) !important;
        }

        .label-text {
            font-weight: 800;
            display: block;
            margin-bottom: 10px;
            font-size: 1.1rem;
            color: #1e293b;
        }

        /* 3. 【最重要】プレビュー内のデザインを本番(show.blade.php)と完全同期 */
        .markdown-body {
            font-size: 1.05rem;
            line-height: 2;
            color: #333;
        }

        .markdown-body h2 {
            font-size: 1.6rem;
            font-weight: 900;
            margin-top: 2rem;
            /* プレビュー用に少し調整 */
            margin-bottom: 1.5rem;
            padding-bottom: 10px;
            border-bottom: 2px solid #111;
            /* 本番と同じ黒の下線 */
            color: #111;
        }

        .markdown-body h3 {
            font-size: 1.3rem;
            font-weight: 900;
            margin-top: 1.5rem;
            margin-bottom: 1.2rem;
            color: #111;
        }

        .markdown-body p {
            margin-bottom: 1.5rem;
        }

        .markdown-body ul,
        .markdown-body ol {
            margin-bottom: 1.5rem;
        }

        .markdown-body img {
            max-width: 100%;
            height: auto;
            border-radius: 2px;
            margin: 1rem 0;
        }

        /* 4. 送信ボタン */
        .btn-submit-action {
            display: block !important;
            width: 100% !important;
            background-color: #059669 !important;
            color: #ffffff !important;
            font-weight: 800 !important;
            font-size: 1.25rem !important;
            padding: 20px !important;
            border: none !important;
            border-radius: 12px !important;
            cursor: pointer !important;
            box-shadow: 0 8px 0 #047857 !important;
            text-align: center !important;
            margin-top: 30px !important;
            text-decoration: none;
        }

        .btn-submit-action:active {
            transform: translateY(4px) !important;
            box-shadow: 0 4px 0 #047857 !important;
        }
    </style>
@endsection

@section("content")
    <div class="container" style="max-width: 1200px; padding-top: 50px; padding-bottom: 100px;">
        <div class="mb-4">
            <a href="{{ route('admin.dashboard') }}" style="text-decoration: none; color: #64748b; font-weight: bold;">
                ← ダッシュボードへ戻る
            </a>
        </div>

        <div class="editor-card">
            <h2 class="fw-bold mb-4">📝 記事投稿フォーム</h2>

            <form action="{{ route('admin.contents.store') }}" method="POST" enctype="multipart/form-data">
                @csrf
                <div class="mb-4">
                    <label for="title" class="label-text">記事タイトル</label>
                    <input type="text" name="title" id="title" placeholder="タイトルを入力" required value="{{ old('title') }}">
                </div>

                <div class="mb-4">
                    <label for="description" class="label-text">リード文（導入文）</label>
                    <textarea name="description" id="description" rows="2">{{ old('description') }}</textarea>
                </div>

                <div class="row">
                    <div class="col-md-6 mb-4">
                        <label for="body" class="label-text">記事本文（Markdown対応）</label>
                        <textarea name="body" id="body" rows="25" placeholder="## 見出しを書く">{{ old('body') }}</textarea>
                    </div>
                    <div class="col-md-6 mb-4">
                        <label class="label-text text-primary">リアルタイムプレビュー</label>
                        <div id="preview-area" class="markdown-body border rounded p-4 bg-white"
                            style="height: 635px; overflow-y: auto; border: 2px solid #334155 !important;">
                        </div>
                    </div>
                </div>

                <div class="row">
                    <div class="col-md-6 mb-4">
                        <label for="image" class="label-text">アイキャッチ画像</label>
                        <input type="file" name="image" id="image" accept="image/*">
                    </div>
                    <div class="col-md-6 mb-4">
                        <label for="content_url" class="label-text">アフィリエイトURL</label>
                        <input type="text" name="content_url" id="content_url" placeholder="https://..."
                            value="{{ old('content_url') }}">
                    </div>
                </div>

                <div class="mb-4">
                    <label for="tag" class="label-text">タグ（カンマ区切り）</label>
                    <input type="text" name="tag" id="tag" placeholder="Laravel, 副業" value="{{ old('tag') }}">
                </div>

                <button type="submit" class="btn-submit-action">🚀 この内容で公開する</button>
            </form>
        </div>
    </div>

    {{-- 前回の成功パターンを維持 --}}
    <script src="https://cdnjs.cloudflare.com/ajax/libs/marked/4.3.0/marked.min.js"></script>
    <script>
        window.addEventListener('load', function () {
            const textarea = document.getElementById('body');
            const preview = document.getElementById('preview-area');

            if (!textarea || !preview) return;

            function updatePreview() {
                if (typeof marked !== 'undefined') {
                    const rawValue = textarea.value;
                    preview.innerHTML = rawValue ? marked.parse(rawValue) : '<p class="text-secondary small">ここにプレビューが表示されます</p>';
                }
            }

            textarea.addEventListener('input', updatePreview);
            updatePreview();
        });
    </script>
@endsection

@section('script')
@endsection