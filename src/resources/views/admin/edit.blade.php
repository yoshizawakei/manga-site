@extends('layouts.admin')

@section("css")
    <link rel="stylesheet" href="{{ asset('css/admin/index.css') }}">
    <style>
        .container { max-width: 900px; padding: 2rem 1rem; }
        .contents-h1 { color: var(--primary-color); border-bottom: 3px solid var(--secondary-color); padding-bottom: 0.5rem; margin-bottom: 2rem; font-weight: bold; }
        .form-label { font-weight: bold; color: var(--secondary-color); margin-bottom: 0.5rem; }
        .form-control { background-color: #242424; border: 1px solid var(--border-color); color: var(--text-color); }
        .form-control:focus { background-color: #242424; border-color: var(--primary-color); box-shadow: 0 0 0 0.25rem rgba(187, 134, 252, 0.25); }
        .btn-primary { background-color: var(--primary-color); border-color: var(--primary-color); transition: 0.3s; }
    </style>
@endsection

@section("content")
    <div class="container bg-dark shadow-lg rounded-3">
        <h1 class="contents-h1 fs-3">コンテンツ編集</h1>

        <form action="{{ route('admin.contents.update', ['content' => $content->id]) }}" method="POST" class="p-4">
            @csrf
            @method('PUT')

            <div class="mb-3">
                <label for="title" class="form-label">タイトル</label>
                <input type="text" id="title" name="title" class="form-control" value="{{ old('title', $content->title) }}" required>
            </div>

            <div class="mb-3">
                <label for="description" class="form-label">説明（短い紹介文）</label>
                <textarea id="description" name="description" class="form-control" rows="3">{{ old('description', $content->description) }}</textarea>
            </div>

            <div class="mb-3">
                <label for="body" class="form-label text-info">レビュー・感想（ブログ本文）</label>
                <textarea id="body" name="body" class="form-control" rows="15" placeholder="熱いレビューを記入してください">{{ old('body', $content->body) }}</textarea>
                <div class="form-text text-white-50 small">詳細ページで改行が反映されます。</div>
            </div>

            <div class="mb-3">
                <label for="image_url" class="form-label">画像URL</label>
                <input type="text" id="image_url" name="image_url" class="form-control" value="{{ old('image_url', $content->image_url) }}">
            </div>

            <div class="mb-3">
                <label for="content_url" class="form-label">コンテンツURL（アフィリンク）</label>
                <input type="text" id="content_url" name="content_url" class="form-control" value="{{ old('content_url', $content->content_url) }}">
            </div>

            <div class="mb-4">
                <label for="tag" class="form-label">タグ（カンマ区切り）</label>
                <input type="text" id="tag" name="tag" class="form-control" value="{{ old('tag', $tags) }}">
            </div>

            <button type="submit" class="btn btn-primary btn-lg fw-bold w-100">
                <i class="fas fa-save me-2"></i>更新する
            </button>
        </form>

        <div class="p-4 text-center">
            <a href="{{ route('admin.dashboard') }}" class="text-secondary"><i class="fas fa-arrow-left me-1"></i>戻る</a>
        </div>
    </div>
@endsection