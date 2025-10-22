@extends('layouts.admin')

@section("css")
    <link rel="stylesheet" href="{{ asset('css/admin/index.css') }}">
    <style>
        /* 管理画面 フォームページ用のダークテーマ補助スタイル */
        .container {
            max-width: 900px;
            padding: 2rem 1rem;
        }

        .container h1 {
            color: var(--primary-color);
            /* 紫のアクセント */
            border-bottom: 3px solid var(--secondary-color);
            padding-bottom: 0.5rem;
            margin-bottom: 2rem;
            font-weight: bold;
        }

        .form-group label {
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

        .back-link {
            display: inline-block;
            margin-top: 2rem;
            color: var(--secondary-color);
            font-weight: bold;
        }
    </style>
@endsection

@section("content")
    <div class="container bg-dark shadow-lg rounded-3">
        <h1 class="fs-3">コンテンツ編集</h1>

        @if ($errors->any())
            <div class="alert alert-danger">
                <ul class="mb-0">
                    @foreach ($errors->all() as $error)
                        <li>{{ $error }}</li>
                    @endforeach
                </ul>
            </div>
        @endif

        <form action="{{ route('admin.contents.update', ['content' => $content->id]) }}" method="POST"
            enctype="multipart/form-data" class="p-4">
            @csrf
            @method('PUT')

            <div class="mb-3">
                <label for="title" class="form-label">タイトル</label>
                <input type="text" id="title" name="title" class="form-control" value="{{ old('title', $content->title) }}"
                    required>
            </div>

            <div class="mb-3">
                <label for="description" class="form-label">説明</label>
                <textarea id="description" name="description" class="form-control"
                    rows="4">{{ old('description', $content->description) }}</textarea>
            </div>

            <div class="mb-3">
                <label for="image_url" class="form-label">画像URL</label>
                <input type="text" id="image_url" name="image_url" class="form-control"
                    value="{{ old('image_url', $content->image_url) }}">
                <div class="form-text text-white-50">外部画像のURLを入力してください。</div>
            </div>

            <div class="mb-3">
                <label for="content_url" class="form-label">コンテンツURL</label>
                <input type="text" id="content_url" name="content_url" class="form-control"
                    value="{{ old('content_url', $content->content_url) }}">
            </div>

            <div class="mb-4">
                <label for="tag" class="form-label">タグ（カンマ区切り）</label>
                <input type="text" id="tag" name="tag" class="form-control" value="{{ old('tag', $tags) }}">
                <div class="form-text text-white-50">例: 異世界,ハーレム,ファンタジー</div>
            </div>

            <button type="submit" class="btn btn-primary btn-lg fw-bold">
                <i class="fas fa-save me-2"></i>更新
            </button>
        </form>

        <a href="{{ route('admin.dashboard') }}" class="back-link">
            <i class="fas fa-arrow-left me-2"></i>ダッシュボードへ戻る
        </a>
    </div>
@endsection