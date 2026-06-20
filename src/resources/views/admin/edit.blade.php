@extends('layouts.admin')

@section('title', 'ログ編集：' . $content->title)

{{--
受け口に合わせて @push('css') に変更し、
Bootstrapと競合していた !important まみれの独自フォームスタイルを最適化しました。
--}}
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

        /* 【重要修正】!importantを排除し、Bootstrapのグリッド幅に素直に従わせます */
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

        /* 本文とプレビューの高さを統一し、横並びの美しさを確保 */
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

        /* 本番(show.blade.php)と同期したプレビューデザイン */
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

        /* 【重要修正】Bootstrapのボタンモデルと喧嘩しないようにカスタムクラス化 */
        .btn-admin-update {
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
            transition: all 0.1s ease-in-out;
        }

        .btn-admin-update:hover {
            filter: brightness(1.05);
        }

        .btn-admin-update:active {
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
                <h2 class="fw-bold h4 mb-0"><i class="fas fa-pen-nib me-2 text-success"></i>記事を編集する</h2>
                <p class="text-secondary small mb-0 mt-1">現在の記事：「{{ $content->title }}」</p>
            </div>

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

            <form action="{{ route('admin.contents.update', $content->id) }}" method="POST" enctype="multipart/form-data"
                class="p-4 p-md-5">
                @csrf
                @method('PUT')

                <div class="row">
                    <div class="col-12 col-md-6 mb-4">
                        <label for="title" class="label-text">記事タイトル</label>
                        <input type="text" name="title" id="title" class="form-control" required
                            value="{{ old('title', $content->title) }}">
                    </div>
                    <div class="col-12 col-md-3 mb-4">
                        <label for="slug" class="label-text">URLスラッグ</label>
                        <input type="text" name="slug" id="slug" class="form-control"
                            placeholder="例: laravel-tips" value="{{ old('slug', $content->slug) }}">
                        <div class="form-text text-secondary" style="font-size:0.75rem;">半角英数字とハイフンのみ。空欄で現在値を維持。</div>
                    </div>
                    <div class="col-12 col-md-3 mb-4">
                        <label for="status" class="label-text">公開設定</label>
                        <select name="status" id="status" class="form-select" required>
                            <option value="published" {{ old('status', $content->status) == 'published' ? 'selected' : '' }}>
                                公開</option>
                            <option value="draft" {{ old('status', $content->status) == 'draft' ? 'selected' : '' }}>非公開（下書き）
                            </option>
                        </select>
                    </div>
                </div>

                <div class="mb-4">
                    <label for="description" class="label-text">リード文</label>
                    <textarea name="description" id="description" class="form-control"
                        rows="2">{{ old('description', $content->description) }}</textarea>
                </div>

                <div class="row">
                    {{-- 入力エリア --}}
                    <div class="col-12 col-lg-6 mb-4">
                        <label for="body" class="label-text">記事本文（Markdown対応）</label>
                        <textarea name="body" id="body" class="form-control body-textarea"
                            rows="25">{{ old('body', $content->body) }}</textarea>
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
                        <label for="image" class="label-text">アイキャッチ画像（変更する場合のみ）</label>
                        <input type="file" name="image" id="image" class="form-control" accept="image/*">
                    </div>
                    <div class="col-12 col-md-6 mb-4">
                        <label for="content_url" class="label-text">アフィリエイトURL</label>
                        <input type="text" name="content_url" id="content_url" class="form-control"
                            value="{{ old('content_url', $content->content_url) }}">
                    </div>
                </div>

                <div class="mb-5">
                    <label for="tag" class="label-text">タグ（カンマ区切り）</label>
                    <input type="text" name="tag" id="tag" class="form-control" value="{{ old('tag', $tags) }}">
                </div>

                <button type="submit" class="btn-admin-update">🚀 更新内容を保存する</button>
            </form>
        </div>
    </div>

    {{-- プレビュー＆目次生成スクリプト（既存のロジックを完全維持） --}}
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
                    previewArea.innerHTML = marked.parse(rawValue || '');

                    const headings = previewArea.querySelectorAll('h2, h3');
                    tocList.innerHTML = '';

                    if (headings.length > 0) {
                        tocArea.style.display = 'block';
                        headings.forEach((heading, index) => {
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