@extends('layouts.app')

@section("css")
    <link rel="stylesheet" href="{{ asset('css/index.css') }}">
@endsection

@section('content')
    <section class="other-manga-section">
        <h2 class="section-title">漫画一覧</h2>
        <div class="manga-grid">
            {{-- 新着・おすすめ以外の漫画のデータを表示するループ --}}
            @if(isset($contents_all))
                @forelse($contents_all as $manga_all)
                    <div class="manga-card">
                        <a href="{{ $manga_all->content_url }}" target="_blank" rel="noopener noreferrer">
                            <img src="{{ $manga->image_url }}" alt="{{ $manga->title }}">
                            <h3>{{ $manga->title }}</h3>
                        </a>
                    </div>
                @empty
                    <p class="no-results">新着・おすすめ以外の漫画が見つかりませんでした。</p>
                @endforelse
            @else
                {{-- APIテストができない場合のダミーデータ --}}
                @for ($i = 0; $i < 12; $i++)
                    <div class="manga-card">
                        <a href="#" target="_blank" rel="noopener noreferrer">
                            <img src="https://via.placeholder.com/180x250.png?text=Manga+Cover+{{ $i + 1 }}"
                                alt="ダミー漫画タイトル{{ $i + 1 }}">
                            <h3>ダミー漫画タイトル{{ $i + 1 }}</h3>
                        </a>
                    </div>
                @endfor
            @endif
        </div>
    </section>
@endsection
