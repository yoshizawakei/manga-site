@extends('layouts.app')

@section('content')
    <section class="other-manga-section">
        <h2 class="section-title">{{ $title }}</h2>

        <div class="manga-grid">
            @if ($contents->count() > 0)
                @foreach ($contents as $content)
                    <div class="manga-card">
                        <a href="{{ $content->content_url }}" target="_blank" rel="noopener noreferrer">
                            <img src="{{ $content->image_url }}" alt="{{ $content->title }}">
                            <h3>{{ Str::limit($content->title, 30) }}</h3>
                            <div class="manga-description">{{ Str::limit($content->description, 70) }}</div>
                            <div class="manga-tag">
                                @foreach ($content->tags as $tag)
                                    <a href="{{ route('tags.show', ['tagName' => $tag->name]) }}">#{{ $tag->name }}</a>
                                @endforeach
                            </div>
                        </a>
                    </div>
                @endforeach
            @else
                <p class="no-results">該当するコンテンツは見つかりませんでした。</p>
            @endif
        </div>

        <div class="pagination-links">
            {{ $contents->links() }}
        </div>
    </section>
@endsection