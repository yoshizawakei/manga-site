@extends('layouts.app')

@section('title', '新規ログ作成')

@section("css")
    <style>
        /* 1. 背景をグレーにして、入力カード（白）を際立たせる */
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

        /* 2. インプットタグ自体に「常に」境界線を引く */
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

        /* 入力中の色変更 */
        input:focus,
        textarea:focus {
            border-color: #10b981 !important;
            outline: none !important;
            box-shadow: 0 0 0 4px rgba(16, 185, 129, 0.2) !important;
        }

        /* 3. ボタンを絶対に見えるように（強い色と立体感） */
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
        }

        .btn-submit-action:active {
            transform: translateY(4px) !important;
            box-shadow: 0 4px 0 #047857 !important;
        }

        .label-text {
            font-weight: 800;
            display: block;
            margin-bottom: 10px;
            font-size: 1.1rem;
            color: #1e293b;
        }

        /* Markdown本文内の見出し装飾 */
        .markdown-body h2 {
            font-size: 1.5rem;
            border-left: 5px solid #10b981;
            padding: 0.5rem 1rem;
            margin-top: 3rem;
            margin-bottom: 1.5rem;
            background: #f0fdf4;
            font-weight: 800;
        }

        .markdown-body h3 {
            font-size: 1.25rem;
            border-bottom: 2px solid #e2e8f0;
            padding-bottom: 0.5rem;
            margin-top: 2.5rem;
            margin-bottom: 1rem;
            font-weight: 700;
        }

        /* リストの装飾 */
        .markdown-body ul, .markdown-body ol {
            margin-bottom: 1.5rem;
            padding-left: 1.5rem;
        }

        /* 画像のレスポンシブ対応 */
        .markdown-body img {
            max-width: 100%;
            height: auto;
            border-radius: 0.75rem;
            margin: 1.5rem 0;
            box-shadow: 0 4px 12px rgba(0,0,0,0.05);
        }
    </style>
@endsection

@section("content")
    <div class="container" style="max-width: 800px; padding-top: 50px; padding-bottom: 100px;">

        <div class="mb-4">
            <a href="{{ route('admin.dashboard') }}" style="text-decoration: none; color: #64748b; font-weight: bold;">
                ← ダッシュボードへ戻る
            </a>
        </div>

        <div class="editor-card">
            <h2 class="fw-bold mb-4">📝 記事投稿フォーム</h2>

            {{-- ★ enctypeを追加してファイルを送れるように修正 ★ --}}
            <form action="{{ route('admin.contents.store') }}" method="POST" enctype="multipart/form-data">
                @csrf

                {{-- タイトル --}}
                <div class="mb-4">
                    <label for="title" class="label-text">記事タイトル</label>
                    <input type="text" name="title" id="title" placeholder="ここにタイトルを入力してください" required
                        value="{{ old('title') }}">
                </div>

                {{-- リード文 --}}
                <div class="mb-4">
                    <label for="description" class="label-text">リード文（導入文）</label>
                    <textarea name="description" id="description" rows="3"
                        placeholder="（例）この記事では...">{{ old('description') }}</textarea>
                </div>

                {{-- 本文入力とプレビューを並べる構造 --}}
                <div class="row">
                    {{-- 入力エリア --}}
                    <div class="col-md-6 mb-4">
                        <label for="body" class="label-text">記事本文（Markdown対応）</label>
                        <textarea name="body" id="body" rows="20" placeholder="## 見出し（スペースを忘れずに！）">{{ old('body') }}</textarea>
                    </div>

                    {{-- プレビューエリア --}}
                    <div class="col-md-6 mb-4">
                        <label class="label-text text-primary">リアルタイムプレビュー</label>
                        {{-- 以前作成した markdown-body クラスを付与してスタイルを統一します --}}
                        <div id="preview-area" class="markdown-body border rounded p-3 bg-white"
                            style="height: 520px; overflow-y: auto; border: 2px solid #334155 !important;">
                        </div>
                    </div>
                </div>

                <div class="row">
                    {{-- ★ 画像URL指定からファイルアップロードに変更 ★ --}}
                    <div class="col-md-6 mb-4">
                        <label for="image" class="label-text">アイキャッチ画像</label>
                        <input type="file" name="image" id="image" accept="image/*">
                        <small class="text-secondary">※PC・スマホから画像を選択してください</small>
                    </div>
                    <div class="col-md-6 mb-4">
                        <label for="content_url" class="label-text">アフィリエイトURL</label>
                        <input type="text" name="content_url" id="content_url" placeholder="https://..."
                            value="{{ old('content_url') }}">
                    </div>
                </div>

                <div class="mb-4">
                    <label for="tag" class="label-text">タグ</label>
                    <input type="text" name="tag" id="tag" placeholder="Laravel, 副業" value="{{ old('tag') }}">
                </div>

                {{-- 送信ボタン --}}
                <button type="submit" class="btn-submit-action">
                    🚀 この内容で公開する
                </button>

            </form>
        </div>
    </div>
@endsection

@section('script')
    <script src="https://cdn.jsdelivr.net/npm/marked/marked.min.js"></script>
    <script>
        document.addEventListener('DOMContentLoaded', function () {
            const bodyTextarea = document.getElementById('body');
            const previewArea = document.getElementById('preview-area');

            function updatePreview() {
                // 入力値をHTMLに変換。空の場合はメッセージを表示
                const rawValue = bodyTextarea.value;
                previewArea.innerHTML = rawValue ? marked.parse(rawValue) : '<p class="text-secondary">ここにプレビューが表示されます</p>';
            }

            bodyTextarea.addEventListener('input', updatePreview);
            updatePreview(); // 初期表示
        });
    </script>
@endsection