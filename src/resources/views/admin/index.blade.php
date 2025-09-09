@extends('layouts.admin')

@section("css")
    <link rel="stylesheet" href="{{ asset('css/admin/index.css') }}">
@endsection

@section("content")
    <div class="container">
        <h1 class="contents-h1">コンテンツ作成</h1>
        <form action="" method="POST" enctype="multipart/form-data">
            @csrf
            <div class="form-group">
                <label for="title">タイトル</label>
                <input type="text" id="title" name="title" class="form-control" required>
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
                <label for="tag">タグ</label>
                <input type="text" id="tag" name="tag" class="form-control">
            </div>
            <button type="submit" class="btn btn-primary">作成</button>
        </form>
    </div>
    <a href="{{ route("admin.dashboard") }}">ダッシュボードへ</a>
@endsection