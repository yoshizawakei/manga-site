@extends('layouts.admin')

@section("css")
    <link rel="stylesheet" href="{{ asset('css/admin/index.css') }}">
@endsection

@section("content")
    <div class="container">
        <h1>コンテンツ編集</h1>
        <form action="{{ route('admin.contents.update', ['content' => $content->id]) }}" method="POST"
            enctype="multipart/form-data">
            @csrf
            @method('PUT')
            <div class="form-group">
                <label for="title">タイトル</label>
                <input type="text" id="title" name="title" class="form-control" value="{{ old('title', $content->title) }}"
                    required>
            </div>
            <div class="form-group">
                <label for="description">説明</label>
                <textarea id="description" name="description" class="form-control"
                    rows="4">{{ old('description', $content->description) }}</textarea>
            </div>
            <div class="form-group">
                <label for="image_url">画像URL</label>
                <input type="text" id="image_url" name="image_url" class="form-control"
                    value="{{ old('image_url', $content->image_url) }}">
            </div>
            <div class="form-group">
                <label for="content_url">コンテンツURL</label>
                <input type="text" id="content_url" name="content_url" class="form-control"
                    value="{{ old('content_url', $content->content_url) }}">
            </div>
            <div class="form-group">
                <label for="tag">タグ</label>
                <input type="text" id="tag" name="tag" class="form-control" value="{{ old('tag', $tags) }}">
            </div>
            <button type="submit" class="btn btn-primary">更新</button>
        </form>

        <a href="{{ route('admin.dashboard') }}">ダッシュボードへ</a>
    </div>
@endsection