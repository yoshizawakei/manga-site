@extends('layouts.admin')

@section("css")
    <link rel="stylesheet" href="{{ asset('css/tags.css') }}">
@endsection

@section('content')
    <div class="main-content-container">
        <h2>タグ一覧</h2>
        @if(isset($tags))
            <ul class="tag-list">
                @forelse($tags as $tag)
                    <li><a href="{{ route('tags.show', ['tagName' => $tag->name]) }}" class="tag-link">{{ $tag->name }}</a></li>
                @empty
                    <p class="no-results">タグが見つかりませんでした。</p>
                @endforelse
            </ul>
        @else
            <p class="no-results">タグ情報を取得できませんでした。</p>
        @endif
    </div>
@endsection