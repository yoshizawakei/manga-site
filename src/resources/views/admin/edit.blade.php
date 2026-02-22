@extends('layouts.app')

@section('title', 'ログ編集：' . $content->title)

@section("css")
    <style>
        /* 管理画面：超高コントラスト・エディター */
        :root {
            --admin-bg: #f1f5f9;
            --admin-card: #ffffff;
            --admin-primary: #059669;
            /* ボーダーを常に濃いグレーに設定 */
            --input-border: #334155;
            --text-main: #1e293b;
        }

        body {
            background-color: var(--admin-bg) !important;
        }

        .editor-card {
            background-color: var(--admin-card);
            border-radius: 1.5rem;
            border: 1px solid #cbd5e1;
            box-shadow: 0 10px 25px rgba(0, 0, 0, 0.05);
            overflow: hidden;
        }

        .editor-header {
            background-color: #f0fdf4;
            padding: 2rem;
            border-bottom: 1px solid #cbd5e1;
            text-align: center;
        }

        .contents-h1 {
            color: var(--text-main);
            font-weight: 800;
            margin-bottom: 0;
            font-size: 1.5rem;
        }

        /* 全ての入力タグに常時2pxのボーダーを表示 */
        input.form-control,
        textarea.form-control {
            background-color: #ffffff !important;
            border: 2px solid var(--input-border) !important;
            padding: 1rem !important;
            border-radius: 8px !important;
            display: block;
            width: 100%;
            color: #000 !important;
        }

        /* フォーカス時は緑色に強調 */
        input.form-control:focus,
        textarea.form-control:focus {
            border-color: #10b981 !important;
            box-shadow: 0 0 0 4px rgba(16, 185, 129, 0.2) !important;
            outline: none !important;
        }

        .body-textarea {
            min-height: 450px;
            line-height: 1.8;
        }

        /* ★更新ボタン：埋もれない立体設計★ */
        .btn-update-save {
            display: block !important;
            width: 100% !important;
            background: linear-gradient(135deg, #10b981 0%, #059669 100%) !important;
            border: 2px solid #047857 !important;
            padding: 1.25rem !important;
            border-radius: 1rem !important;
            font-weight: 900 !important;
            font-size: 1.2rem !important;
            color: #ffffff !important;
            box-shadow: 0 8px 0 #047857 !important;
            transition: 0.2s;
            text-align: center;
            text-decoration: none;
            cursor: pointer;
        }

        .btn-update-save:hover {
            transform: translateY(-2px);
            box-shadow: 0 10px 15px rgba(5, 150, 105, 0.4) !important;
            color: #fff !important;
        }

        .btn-update-save:active {
            transform: translateY(4px);
            box-shadow: 0 2px 0 #047857 !important;
        }

        .form-label {
            font-weight: 800;
            color: var(--text-main);
            margin-bottom: 0.5rem;
            display: block;
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
    <div class="container py-5" style="max-width: 900px;">
        <div class="mb-4">
            <a href="{{ route('admin.dashboard') }}" class="text-decoration-none"
                style="color: #64748b; font-weight: bold;">
                <i class="fas fa-arrow-left me-2"></i>ダッシュボードへ戻る
            </a>
        </div>

        <div class="editor-card">
            <div class="editor-header">
                <h1 class="contents-h1"><i class="fas fa-edit me-2 text-primary"></i>記事の編集</h1>
                <p class="text-secondary small mb-0 mt-1">「{{ $content->title }}」をブラッシュアップしましょう</p>
            </div>

            @if ($errors->any())
                <div class="alert alert-danger mx-4 mt-4 border-0 shadow-sm" style="background-color: #fef2f2; color: #991b1b;">
                    <ul class="mb-0 fw-bold small">
                        @foreach ($errors->all() as $error)
                            <li><i class="fas fa-exclamation-triangle me-2"></i>{{ $error }}</li>
                        @endforeach
                    </ul>
                </div>
            @endif

            {{-- ★ enctypeを追加 ★ --}}
            <form action="{{ route('admin.contents.update', ['content' => $content->id]) }}" method="POST"
                enctype="multipart/form-data" class="p-4 p-md-5">
                @csrf
                @method('PUT')

                {{-- タイトル --}}
                <div class="mb-4">
                    <label for="title" class="form-label">記事タイトル</label>
                    <input type="text" id="title" name="title" class="form-control @error('title') is-invalid @enderror"
                        value="{{ old('title', $content->title) }}" required>
                </div>

                {{-- リード文 --}}
                <div class="mb-4">
                    <label for="description" class="form-label">リード文（導入文）</label>
                    <textarea id="description" name="description" class="form-control"
                        rows="3">{{ old('description', $content->description) }}</textarea>
                </div>

                {{-- 本文入力とプレビューを並べる構造 --}}
                <div class="row">
                    {{-- 入力エリア --}}
                    <div class="col-md-6 mb-4">
                        <label for="body" class="form-label">記事本文（Markdown対応）</label>
                        <textarea id="body" name="body" class="form-control body-textarea"
                            style="height: 600px;">{{ old('body', $content->body) }}</textarea>
                    </div>

                    {{-- プレビューエリア --}}
                    <div class="col-md-6 mb-4">
                        <label class="form-label text-primary">リアルタイムプレビュー</label>
                        <div id="preview-area" class="markdown-body border rounded p-3 bg-white"
                            style="height: 600px; overflow-y: auto;">
                            {{-- ここに変換後のHTMLがリアルタイムで入ります --}}
                        </div>
                    </div>
                </div>

                <div class="row">
                    {{-- ★ 画像URL指定からアップロードに変更 ★ --}}
                    <div class="col-md-6 mb-4">
                        <label for="image" class="form-label">アイキャッチ画像の変更</label>
                        @if($content->image_url)
                            <div class="mb-2">
                                <img src="{{ $content->image_url }}" alt="現在の画像" class="img-fluid rounded border"
                                    style="max-height: 120px;">
                                <p class="small text-secondary mt-1">現在の画像</p>
                            </div>
                        @endif
                        <input type="file" id="image" name="image" class="form-control" accept="image/*">
                    </div>

                    {{-- アフィリエイトURL --}}
                    <div class="col-md-6 mb-4">
                        <label for="content_url" class="form-label">アフィリエイトURL</label>
                        <input type="text" id="content_url" name="content_url" class="form-control"
                            value="{{ old('content_url', $content->content_url) }}">
                    </div>
                </div>

                {{-- タグ --}}
                <div class="mb-5">
                    <label for="tag" class="form-label">カテゴリータグ</label>
                    <input type="text" id="tag" name="tag" class="form-control" value="{{ old('tag', $tags) }}">
                    <div class="small text-secondary mt-1">カンマ区切りで入力</div>
                </div>

                <div class="d-grid gap-3">
                    <button type="submit" class="btn-update-save">
                        <i class="fas fa-save me-2"></i>更新内容を保存する
                    </button>
                    <a href="{{ route('admin.dashboard') }}"
                        class="btn btn-link text-secondary text-decoration-none small text-center">
                        変更を破棄して戻る
                    </a>
                </div>
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

            // マークダウンをHTMLに変換してプレビューに反映する関数
            function updatePreview() {
                const rawValue = bodyTextarea.value;
                // marked.jsを使用して変換
                previewArea.innerHTML = marked.parse(rawValue);
            }

            // 入力時に実行（inputイベント）
            bodyTextarea.addEventListener('input', updatePreview);

            // 初回読み込み時にも実行
            updatePreview();
        });
    </script>
@endsection