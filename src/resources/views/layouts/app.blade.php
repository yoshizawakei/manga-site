<!DOCTYPE html>
<html lang="ja">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="{{ asset("css/sanitize.css") }}">
    <link rel="stylesheet" href="{{ asset("css/common.css") }}">
    @yield("css")
    <title>漫画manga</title>
</head>

<body>
    <header>
        <h1>漫画manga</h1>
        <nav>
            <ul>
                <li><a href="#">ホーム</a></li>
                <li><a href="#">漫画一覧</a></li>
                <li><a href="#">漫画を追加</a></li>
            </ul>
        </nav>
    </header>

    <div class="main-wrapper">
        <section class="hero-section">
            <div class="hero-content">
                <h2>話題の漫画から懐かしの名作まで</h2>
                <p>あなたにぴったりの一冊を見つけよう</p>
                <form action="#" method="GET" class="search-form-inline">
                    <input type="text" name="keyword" placeholder="キーワードを入力して検索" value="{{ request('keyword') }}">
                    <button type="submit">検索</button>
                </form>
            </div>
        </section>

        <section class="ad-section top-ad-section">
            <div class="ad-grid">
                <div class="ad-item">広告コード1</div>
                <div class="ad-item">広告コード2</div>
                <div class="ad-item">広告コード3</div>
                <div class="ad-item">広告コード4</div>
                <div class="ad-item">広告コード1</div>
                <div class="ad-item">広告コード2</div>
                <div class="ad-item">広告コード3</div>
                <div class="ad-item">広告コード4</div>
            </div>
        </section>

        <div class="content-container">
            <main>
                <section class="new-releases">
                    <h2 class="section-title">新着・おすすめ作品</h2>
                    <div class="manga-grid">
                        {{-- 新着・おすすめの漫画のデータを表示するループ --}}
                        @if(isset($newReleases))
                            @forelse($newReleases as $manga)
                                <div class="manga-card">
                                    <a href="{{ $manga->affiliateURL }}" target="_blank" rel="noopener noreferrer">
                                        <img src="{{ $manga->imageURL->large }}" alt="{{ $manga->title }}">
                                        <h3>{{ $manga->title }}</h3>
                                    </a>
                                </div>
                            @empty
                                <p class="no-results">新着・おすすめ作品が見つかりませんでした。</p>
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

                @yield('content')
            </main>

            <!-- <aside>
                <div class="ad-section sidebar-ad-section">
                    <div class="ad-grid">
                        <div class="ad-item">広告コード1</div>
                        <div class="ad-item">広告コード2</div>
                        <div class="ad-item">広告コード3</div>
                        <div class="ad-item">広告コード4</div>
                    </div>
                </div>
            </aside> -->
        </div>

        <section class="ad-section bottom-ad-section">
            <div class="ad-grid">
                <div class="ad-item">広告コード1</div>
                <div class="ad-item">広告コード2</div>
                <div class="ad-item">広告コード3</div>
                <div class="ad-item">広告コード4</div>
                <div class="ad-item">広告コード1</div>
                <div class="ad-item">広告コード2</div>
                <div class="ad-item">広告コード3</div>
                <div class="ad-item">広告コード4</div>
            </div>
        </section>
    </div>

    <footer>
        <p>&copy; {{ date('Y') }} 漫画manga</p>
    </footer>

    @yield('scripts')

</body>

</html>