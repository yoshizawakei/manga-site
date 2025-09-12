@extends('layouts.app')

@section("css")
    <link rel="stylesheet" href="{{ asset('css/index.css') }}">
@endsection

@section('content')
    <section class="other-manga-section">
        <h2 class="section-title">漫画一覧</h2>
        <div class="manga-grid">
            @if(isset($contents_all))
                @foreach($contents_all as $manga_all)
                    <div class="manga-card">
                        <a href="{{ $manga_all->content_url }}" target="_blank" rel="noopener noreferrer">
                            <img src="{{ $manga_all->image_url }}" alt="{{ $manga_all->title }}">
                            <!-- <h3>{{ $manga_all->title }}</h3> -->
                            <div class="manga-description">{{ $manga_all->description }}</div>
                            <!-- <div class="manga-tag">
                                @foreach ($manga_all->tags as $tag)
                                    <a href="{{ route('tags.show', ['tagName' => $tag->name]) }}">#{{ $tag->name }}</a>
                                @endforeach
                            </div> -->
                        </a>
                    </div>
                @endforeach
            @endif
        </div>

        <div class="pagination-links">
            @if(isset($contents_all))
                {{ $contents_all->links() }}
            @endif
        </div>
    </section>
@endsection