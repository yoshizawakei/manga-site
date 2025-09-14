@extends('layouts.admin')

@section("css")
    <link rel="stylesheet" href="{{ asset('css/admin/index.css') }}">
@endsection

@section("content")
    <div class="container">
        <h1 class="contents-h1">コンテンツ作成</h1>
        <form action="{{ route("admin.contents.store") }}" method="post">
            @csrf
            <div class="form-group">
                <label for="title">タイトル</label>
                <input type="text" id="title" name="title" class="form-control" value="{{ old('title') }}" required>
                @error('title')
                    <div class="text-danger">{{ $message }}</div>
                @enderror
            </div>
            <div class="form-group">
                <label for="description">説明</label>
                <textarea id="description" name="description" class="form-control" rows="4"></textarea>
            </div>
            <div class="form-group">
                <label for="image_url">画像URL</label>
                <input type="text" id="image_url" name="image_url" class="form-control">
            </div>
            <div class="form-group">
                <label for="content_url">コンテンツURL</label>
                <input type="text" id="content_url" name="content_url" class="form-control">
            </div>
            <div class="form-group">
                <label for="tag">タグ（カンマ区切りで入力）</label>
                <textarea id="tag" name="tag" class="form-control" rows="2" placeholder="例: PHP, Laravel, Web開発"></textarea>
            </div>
            <button type="submit" class="btn btn-primary">作成</button>
        </form>
    </div>
    <a href="{{ route("admin.dashboard") }}">ダッシュボードへ</a>
@endsection