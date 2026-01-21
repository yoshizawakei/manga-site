@extends('layouts.admin')

@section("css")
    <link rel="stylesheet" href="{{ asset('css/admin/index.css') }}">
    <style>
        /* 管理画面 フォームページ用のダークテーマ補助スタイル */
        .container {
            max-width: 900px;
            padding: 2rem 1rem;
        }

        .contents-h1 {
            color: var(--primary-color);
            /* 紫のアクセント */
            border-bottom: 3px solid var(--secondary-color);
            padding-bottom: 0.5rem;
            margin-bottom: 2rem;
            font-weight: bold;
        }

        .form-label {
            font-weight: bold;
            color: var(--secondary-color);
            /* シアンの強調色 */
            margin-bottom: 0.5rem;
        }

        .form-control {
            background-color: #242424;
            /* 入力フィールドの背景を少し濃く */
            border: 1px solid var(--border-color);
            color: var(--text-color);
        }

        .form-control:focus {
            background-color: #242424;
            border-color: var(--primary-color);
            /* フォーカス時に紫 */
            box-shadow: 0 0 0 0.25rem rgba(187, 134, 252, 0.25);
        }

        .btn-primary {
            background-color: var(--primary-color);
            border-color: var(--primary-color);
            transition: background-color 0.3s, border-color 0.3s;
        }

        .btn-primary:hover {
            background-color: #A064FF;
            /* 少し明るい紫 */
            border-color: #A064FF;
        }

        .back-link-container {
            margin-top: 2rem;
        }

        .back-link {
            color: var(--secondary-color);
            font-weight: bold;
            text-decoration: none;
        }
        
        .back-link:hover {
            color: var(--primary-color);
        }
    </style>
@endsection

@section("content")
    <div class="container bg-dark shadow-lg rounded-3">
        <h1 class="contents-h1 fs-3">新規コンテンツ作成</h1>

        @if ($errors->any())
            <div class="alert alert-danger shadow-sm">
                <ul class="mb-0">
                    @foreach ($errors->all() as $error)
                        <li>{{ $error }}</li>
                    @endforeach
                </ul>
            </div>
        @endif

        <form action="{{ route("admin.contents.store") }}" method="POST" class="p-4">
            @csrf

            {{-- タイトル --}}
            <div class="mb-3">
                <label for="title" class="form-label">タイトル</label>
                <input type="text" id="title" name="title" class="form-control @error('title') is-invalid @enderror"
                    value="{{ old('title') }}" placeholder="漫画のタイトルを入力" required>
                @error('title')
                    <div class="invalid-feedback">{{ $message }}</div>
                @enderror
            </div>

            {{-- 説明（短い紹介文） --}}
            <div class="mb-3">
                <label for="description" class="form-label">説明（一覧に表示される短い紹介文）</label>
                <textarea id="description" name="description" class="form-control @error('description') is-invalid @enderror"
                    rows="3" placeholder="作品の簡単なあらすじなど">{{ old('description') }}</textarea>
                @error('description')
                    <div class="invalid-feedback">{{ $message }}</div>
                @enderror
            </div>

            {{-- ★レビュー本文（ここがブログのメインになります）★ --}}
            <div class="mb-3">
                <label for="body" class="form-label text-info">レビュー・感想（ブログ本文）</label>
                <textarea id="body" name="body" class="form-control @error('body') is-invalid @enderror"
                    rows="15" placeholder="読者が読みたくなるような、あなた独自の感想やレビューを詳しく書いてください。">{{ old('body') }}</textarea>
                @error('body')
                    <div class="invalid-feedback">{{ $message }}</div>
                @enderror
                <div class="form-text text-white-50 small">
                    <i class="fas fa-info-circle me-1"></i>
                    詳細ページでメインの文章として表示されます。改行は自動で反映されます。
                </div>
            </div>

            {{-- 画像URL --}}
            <div class="mb-3">
                <label for="image_url" class="form-label">画像URL</label>
                <input type="text" id="image_url" name="image_url" class="form-control" 
                    value="{{ old('image_url') }}" placeholder="https://example.com/image.jpg">
                <div class="form-text text-white-50">外部画像のURLを入力してください。</div>
            </div>

            {{-- コンテンツURL --}}
            <div class="mb-3">
                <label for="content_url" class="form-label">コンテンツURL（アフィリエイトリンク）</label>
                <input type="text" id="content_url" name="content_url" class="form-control"
                    value="{{ old('content_url') }}" placeholder="https://al.dmm.co.jp/...">
            </div>

            {{-- タグ --}}
            <div class="mb-4">
                <label for="tag" class="form-label">タグ（カンマ区切り）</label>
                <textarea id="tag" name="tag" class="form-control" rows="2"
                    placeholder="例: 異世界,ハーレム,ファンタジー">{{ old('tag') }}</textarea>
                <div class="form-text text-white-50">複数のタグを登録する場合は「,」で区切ってください。</div>
            </div>

            {{-- 送信ボタン --}}
            <div class="d-grid gap-2">
                <button type="submit" class="btn btn-primary btn-lg fw-bold">
                    <i class="fas fa-plus-circle me-2"></i>この内容でコンテンツを作成する
                </button>
            </div>
        </form>
    </div>

    <div class="back-link-container container">
        <a href="{{ route("admin.dashboard") }}" class="back-link">
            <i class="fas fa-arrow-left me-2"></i>ダッシュボードへ戻る
        </a>
    </div>
@endsection