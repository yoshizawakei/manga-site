@extends('layouts.app')

@section('title', '新規ログ作成')

@section("css")
    <style>
        /* 1. 全体レイアウト */
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

        /* 2. 入力フィールド */
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

        /* 3. 本番(show.blade.php)と同期したプレビューデザイン */
        .markdown-body {
            font-size: 1.05rem;
            line-height: 2;
            color: #333;
        }

        .markdown-body h2 {
            font-size: 1.6rem;
            font-weight: 900;
            margin-top: 2.5rem;
            margin-bottom: 1.5rem;
            padding-bottom: 10px;
            border-bottom: 2px solid #111;
            color: #111;
        }

        .markdown-body h3 {
            font-size: 1.3rem;
            font-weight: 900;
            margin-top: 2rem;
            margin-bottom: 1.2rem;
            color: #111;
        }

        /* 4. 目次(TOC)のプレビューデザイン */
        .toc-preview {
            background: #f9f9f9;
            padding: 1.5rem;
            border-radius: 2px;
            margin-bottom: 2rem;
            border: 1px solid #eee;
        }

        .toc-title {
            font-weight: 900;
            font-size: 0.8rem;
            margin-bottom: 1rem;
            text-transform: uppercase;
            letter-spacing: 0.1em;
            border-bottom: 1px solid #ddd;
            padding-bottom: 5px;
        }

        .toc-list {
            list-style: none;
            padding: 0;
            margin: 0;
        }

        .toc-list li {
            margin-bottom: 0.5rem;
            font-size: 0.9rem;
            color: #666;
        }

        .toc-list .toc-h3 {
            padding-left: 1.2rem;
            font-size: 0.85rem;
        }

        /* 5. 送信ボタン */
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
            text-align: center;
            margin-top: 30px;
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
            <h2 class="fw-bold mb-4">📝 新規記事投稿</h2>

            <form action="{{ route('admin.contents.store') }}" method="POST" enctype="multipart/form-data">
                @csrf
                <div class="mb-4">
                    <label for="title" class="label-text">記事タイトル</label>
                    <input type="text" name="title" id="title" placeholder="タイトルを入力" required value="{{ old('title') }}">
                </div>

                <div class="mb-4">
                    <label for="description" class="label-text">リード文</label>
                    <textarea name="description" id="description" rows="2">{{ old('description') }}</textarea>
                </div>

                <div class="row">
                    {{-- 入力エリア --}}
                    <div class="col-md-6 mb-4">
                        <label for="body" class="label-text">記事本文（Markdown対応）</label>
                        <textarea name="body" id="body" rows="25" placeholder="## 見出しを書く">{{ old('body') }}</textarea>
                    </div>

                    {{-- プレビューエリア：ここに見出し用の「箱」を追加しました --}}
                    <div class="col-md-6 mb-4">
                        <label class="label-text text-primary">リアルタイムプレビュー（目次自動生成）</label>
                        <div id="preview-container" class="border rounded p-4 bg-white"
                            style="height: 635px; overflow-y: auto; border: 2px solid #334155 !important;">
                            <div id="toc-preview-area" class="toc-preview" style="display:none;">
                                <div class="toc-title">Index</div>
                                <ul id="toc-preview-list" class="toc-list"></ul>
                            </div>
                            <div id="preview-area" class="markdown-body"></div>
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

    <script src="https://cdnjs.cloudflare.com/ajax/libs/marked/4.3.0/marked.min.js"></script>
    <script>
        window.addEventListener('load', function () {
            const textarea = document.getElementById('body');
            const previewArea = document.getElementById('preview-area');
            const tocArea = document.getElementById('toc-preview-area');
            const tocList = document.getElementById('toc-preview-list');

            if (!textarea || !previewArea) return;

            function updatePreview() {
                if (typeof marked !== 'undefined') {
                    const rawValue = textarea.value;

                    // 1. 本文のレンダリング
                    previewArea.innerHTML = rawValue ? marked.parse(rawValue) : '<p class="text-secondary small">ここにプレビューが表示されます</p>';

                    // 2. 目次の自動生成
                    const headings = previewArea.querySelectorAll('h2, h3');
                    tocList.innerHTML = '';

                    if (headings.length > 0) {
                        tocArea.style.display = 'block';
                        headings.forEach((heading) => {
                            const li = document.createElement('li');
                            if (heading.tagName === 'H3') li.className = 'toc-h3';
                            li.textContent = heading.textContent;
                            tocList.appendChild(li);
                        });
                    } else {
                        tocArea.style.display = 'none';
                    }
                }
            }

            textarea.addEventListener('input', updatePreview);
            updatePreview();
        });
    </script>
@endsection