@extends('layouts.admin')

@section('title', '新規ログ作成')

@push('css')
    <style>
        /* クリーン・エメラルド・エディターカスタム */
        :root {
            --editor-card: #ffffff;
            --editor-primary: #10b981;
            --editor-border: #cbd5e1;
            --editor-text: #1e293b;
            --editor-secondary: #64748b;
        }

        .editor-container {
            max-width: 1200px;
            margin: 0 auto;
            width: 100%;
        }

        .editor-card {
            background-color: var(--editor-card);
            border: 1px solid var(--editor-border);
            border-radius: 1.5rem;
            box-shadow: 0 10px 25px rgba(0, 0, 0, 0.05);
            overflow: hidden;
        }

        .editor-header {
            background-color: #f0fdf4;
            /* 薄いエメラルド */
            padding: 2rem;
            border-bottom: 1px solid var(--editor-border);
        }

        .label-text {
            font-weight: 700;
            display: flex;
            align-items: center;
            margin-bottom: 0.5rem;
            font-size: 0.95rem;
            color: var(--editor-text);
        }

        .form-control,
        .form-select {
            background-color: #ffffff;
            border: 1.5px solid #334155;
            color: #000000;
            padding: 0.75rem 1rem;
            border-radius: 0.5rem;
            transition: all 0.2s;
        }

        .form-control:focus,
        .form-select:focus {
            background-color: #ffffff;
            border-color: var(--editor-primary);
            box-shadow: 0 0 0 4px rgba(16, 185, 129, 0.2);
            color: #000000;
        }

        /* 本文とプレビューの高さを統一し、レイアウトを安定化 */
        .body-textarea {
            font-size: 1rem;
            line-height: 1.8;
            height: 600px;
            resize: vertical;
        }

        .preview-box {
            height: 600px;
            overflow-y: auto;
            border: 1.5px solid #334155;
            background-color: #ffffff;
            border-radius: 0.5rem;
        }

        /* 本番サイトと同期したプレビューデザイン */
        .markdown-body {
            font-size: 1.05rem;
            line-height: 2;
            color: #333;
        }

        .markdown-body h2 {
            font-size: 1.5rem;
            font-weight: 900;
            margin-top: 2rem;
            margin-bottom: 1rem;
            padding-bottom: 8px;
            border-bottom: 2px solid #111;
            color: #111;
        }

        .markdown-body h3 {
            font-size: 1.25rem;
            font-weight: 900;
            margin-top: 1.5rem;
            margin-bottom: 0.8rem;
            color: #111;
        }

        /* 目次(TOC)のプレビューデザイン */
        .toc-preview {
            background: #f8fafc;
            padding: 1.25rem;
            border-radius: 0.5rem;
            margin-bottom: 1.5rem;
            border: 1px solid var(--editor-border);
        }

        .toc-title {
            font-weight: 900;
            font-size: 0.8rem;
            margin-bottom: 0.75rem;
            text-transform: uppercase;
            letter-spacing: 0.1em;
            border-bottom: 1px solid #ddd;
            padding-bottom: 5px;
            color: var(--editor-text);
        }

        .toc-list {
            list-style: none;
            padding: 0;
            margin: 0;
        }

        .toc-list li {
            margin-bottom: 0.4rem;
            font-size: 0.875rem;
            color: #475569;
        }

        .toc-list .toc-h3 {
            padding-left: 1.2rem;
            font-size: 0.825rem;
        }

        /* 立体的な登録ボタン */
        .btn-admin-submit-action {
            display: block;
            width: 100%;
            background: linear-gradient(135deg, #10b981 0%, #059669 100%);
            color: #ffffff !important;
            font-weight: 800;
            font-size: 1.2rem;
            padding: 1.1rem;
            border: none;
            border-radius: 0.75rem;
            box-shadow: 0 6px 0 #047857;
            text-align: center;
            text-decoration: none;
            cursor: pointer;
            margin-top: 1.5rem;
            transition: all 0.1s ease-in-out;
        }

        .btn-admin-submit-action:hover {
            filter: brightness(1.05);
        }

        .btn-admin-submit-action:active {
            transform: translateY(4px);
            box-shadow: 0 2px 0 #047857;
        }

        .back-link {
            color: var(--editor-secondary);
            font-weight: 600;
            text-decoration: none;
            transition: 0.2s;
            display: inline-flex;
            align-items: center;
        }

        .back-link:hover {
            color: var(--editor-primary);
        }
    </style>
@endpush

@section("content")
    <div class="editor-container">
        <div class="mb-4">
            <a href="{{ route('admin.dashboard') }}" class="back-link">
                <i class="fas fa-arrow-left me-2"></i>ダッシュボードへ戻る
            </a>
        </div>

        <div class="editor-card">
            <div class="editor-header">
                <h2 class="fw-bold h4 mb-0"><i class="fas fa-edit me-2 text-success"></i>新規記事投稿</h2>
                <p class="text-secondary small mb-0 mt-1">新しい副業実践記やレビューを執筆・公開しましょう</p>
            </div>

            {{-- バリデーションエラー表示エリア --}}
            @if ($errors->any())
                <div class="alert alert-danger mx-4 mt-4 border-0 shadow-sm"
                    style="background-color: #fef2f2; color: #991b1b; padding: 15px; border-radius: 8px;">
                    <ul class="mb-0 fw-bold small" style="list-style: none; padding-left: 0;">
                        @foreach ($errors->all() as $error)
                            <li><i class="fas fa-exclamation-triangle me-2"></i>{{ $error }}</li>
                        @endforeach
                    </ul>
                </div>
            @endif

            <form action="{{ route('admin.contents.store') }}" method="POST" enctype="multipart/form-data"
                class="p-4 p-md-5">
                @csrf

                {{-- ★【追加】ステータスを隠しデータとして送信。初期値はモデルの定数に合わせて 'published' (公開) に設定 --}}
                <input type="hidden" name="status" id="content-status" value="{{ \App\Models\Content::STATUS_PUBLISHED }}">

                <div class="mb-4">
                    <label for="title" class="label-text">記事タイトル</label>
                    <input type="text" name="title" id="title" class="form-control" placeholder="タイトルを入力" required
                        value="{{ old('title') }}">
                </div>

                <div class="mb-4">
                    <label for="description" class="label-text">リード文</label>
                    <textarea name="description" id="description" class="form-control" rows="2"
                        placeholder="記事の一覧などに表示される簡単な概要説明を入力してください。">{{ old('description') }}</textarea>
                </div>

                <div class="row">
                    {{-- 入力エリア --}}
                    <div class="col-12 col-lg-6 mb-4">
                        <label for="body" class="label-text">記事本文（Markdown対応）</label>
                        <textarea name="body" id="body" class="form-control body-textarea" rows="25"
                            placeholder="## 見出しを書く">{{ old('body') }}</textarea>
                    </div>

                    {{-- プレビューエリア --}}
                    <div class="col-12 col-lg-6 mb-4">
                        <label class="label-text text-success">リアルタイムプレビュー（目次自動生成）</label>
                        <div id="preview-container" class="preview-box p-4">
                            <div id="toc-preview-area" class="toc-preview" style="display:none;">
                                <div class="toc-title">Index</div>
                                <ul id="toc-preview-list" class="toc-list"></ul>
                            </div>
                            <div id="preview-area" class="markdown-body"></div>
                        </div>
                    </div>
                </div>

                <div class="row">
                    <div class="col-12 col-md-6 mb-4">
                        <label for="image" class="label-text">アイキャッチ画像</label>
                        <input type="file" name="image" id="image" class="form-control" accept="image/*">
                    </div>
                    <div class="col-12 col-md-6 mb-4">
                        <label for="content_url" class="label-text">アフィリエイトURL</label>
                        <input type="text" name="content_url" id="content_url" class="form-control"
                            placeholder="https://..." value="{{ old('content_url') }}">
                    </div>
                </div>

                <div class="mb-4">
                    <label for="tag" class="label-text">タグ（カンマ区切り）</label>
                    <input type="text" name="tag" id="tag" class="form-control" placeholder="Laravel, 副業"
                        value="{{ old('tag') }}">
                </div>

                <button type="submit" class="btn-admin-submit-action">🚀 この内容で公開する</button>
            </form>
        </div>
    </div>
@endsection

@push('scripts')
    <script src="https://cdnjs.cloudflare.com/ajax/libs/marked/4.3.0/marked.min.js"></script>
    <script>
        window.addEventListener('load', function () {
            const textarea = document.getElementById('body');
            const previewArea = document.getElementById('preview-area');
            const tocArea = document.getElementById('toc-preview-area');
            const tocList = document.getElementById('toc-preview-list');

            if (!textarea || !previewArea) return;

            if (typeof marked !== 'undefined') {
                marked.setOptions({
                    mangle: false,
                    headerIds: false
                });
            }

            function updatePreview() {
                if (typeof marked !== 'undefined') {
                    const rawValue = textarea.value;

                    previewArea.innerHTML = rawValue ? marked.parse(rawValue) : '<p class="text-secondary small">ここにプレビューが表示されます</p>';

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
@endpush