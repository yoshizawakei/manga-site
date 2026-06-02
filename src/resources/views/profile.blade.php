@extends('layouts.app')

@section('content')
    <div class="container py-4 py-lg-5 mt-lg-5">
        <div class="row g-4 g-lg-5">
            {{-- メインコンテンツ --}}
            <main class="col-lg-8">
                <h1 class="fw-black mb-4 mb-lg-5">ABOUT ME</h1>

                <div class="text-center mb-5">
                    <img class="profile-icon-img" src="{{ asset('img/profile.png') }}" alt="icon">
                    <h2 class="h5 fw-bold">KEI</h2>
                    <p class="text-secondary small mb-0">Webエンジニア / フリーランス</p>
                    <p class="text-secondary small">元地方公務員 → エンジニア転身</p>
                </div>

                {{-- GREETING --}}
                <section class="mb-5">
                    <h3 class="profile-section-title">GREETING</h3>
                    <p class="profile-text">
                        はじめまして、Keiです。<br>
                        元地方公務員、現在はフリーランスのWebエンジニアとして活動しながら、このブログを運営しています。
                    </p>
                    <p class="profile-text">
                        「安定」を手放してエンジニアに転身した経緯、日々の開発の中で得た学び、そしてフリーランスとして働く上でのリアルな話を、できるだけ正直に書いていこうと思っています。<br>
                        同じようなキャリアチェンジを考えている方や、独学でエンジニアを目指している方の参考に少しでもなれたら嬉しいです。
                    </p>
                </section>

                {{-- STORY --}}
                <section class="mb-5">
                    <h3 class="profile-section-title">STORY</h3>
                    <div class="mt-3">
                        <div class="timeline-item">
                            <p class="mb-0 fw-semibold" style="font-size: 0.9rem;">2016年 — 地方公務員に</p>
                            <p class="text-secondary small mb-0">行政窓口や内部事務を担当。安定した環境で働く中、「このまま定年まで？」という漠然とした不安を感じ始める。</p>
                        </div>
                        <div class="timeline-item">
                            <p class="mb-0 fw-semibold" style="font-size: 0.9rem;">2023年 — プログラミング独学スタート</p>
                            <p class="text-secondary small mb-0">仕事の合間にHTML/CSS、JavaScriptを独学。最初の「動いた！」体験が忘れられず、どんどんのめり込む。
                            </p>
                        </div>
                        <div class="timeline-item">
                            <p class="mb-0 fw-semibold" style="font-size: 0.9rem;">2024年 — プログラミングスクールに入校</p>
                            <p class="text-secondary small mb-0">独学での勉強に限界を感じ、プログラミングスクールに入校。HTML/CSS、JavaScriptを学び直すとともに、Laravelを学びWEBアプリ制作の基礎を学ぶ。
                            </p>
                        </div>
                        <div class="timeline-item">
                            <p class="mb-0 fw-semibold" style="font-size: 0.9rem;">2025年 — 退職 → フリーランスへ</p>
                            <p class="text-secondary small mb-0">9年間勤めた公務員を退職。フリーランスとしてWeb制作・開発の仕事を受けながら、このブログも本格始動。</p>
                        </div>
                        <div class="timeline-item">
                            <p class="mb-0 fw-semibold" style="font-size: 0.9rem;">現在</p>
                            <p class="text-secondary small mb-0">Laravel / React を中心に案件をこなしつつ、ブログで発信を続けています。</p>
                        </div>
                    </div>
                </section>

                {{-- SKILLS --}}
                <section class="mb-5">
                    <h3 class="profile-section-title">SKILLS</h3>
                    <p class="profile-text mb-3">現在メインで使っている技術スタックです。フロントからバックまでひとりでこなすことが多いので、幅広くやっています。</p>
                    <div class="mb-3">
                        <p class="small fw-bold text-secondary mb-2">FRONTEND</p>
                        <span class="skill-badge">HTML / CSS</span>
                        <span class="skill-badge">JavaScript</span>
                        <span class="skill-badge">React</span>
                        <span class="skill-badge">Bootstrap</span>
                        <span class="skill-badge">Tailwind CSS</span>
                    </div>
                    <div class="mb-3">
                        <p class="small fw-bold text-secondary mb-2">BACKEND</p>
                        <span class="skill-badge">PHP</span>
                        <span class="skill-badge">Laravel</span>
                        <span class="skill-badge">MySQL</span>
                    </div>
                    <div>
                        <p class="small fw-bold text-secondary mb-2">TOOLS / OTHER</p>
                        <span class="skill-badge">Git / GitHub</span>
                        <span class="skill-badge">Docker</span>
                    </div>
                </section>

                {{-- HOBBIES --}}
                <section class="mb-5">
                    <h3 class="profile-section-title">HOBBIES</h3>
                    <p class="profile-text mb-3">コードを書いていない時間はこんな感じで過ごしています。</p>
                    <div class="row g-3">
                        <div class="col-4 col-sm-3">
                            <div class="hobby-card">
                                <i class="fas fa-solid fa-soccer-ball"></i>
                                <span>サッカー</span>
                            </div>
                        </div>
                        <div class="col-4 col-sm-3">
                            <div class="hobby-card">
                                <i class="fas fa-book"></i>
                                <span>漫画</span>
                            </div>
                        </div>
                        <div class="col-4 col-sm-3">
                            <div class="hobby-card">
                                <i class="fas fa-coffee"></i>
                                <span>カフェ巡り</span>
                            </div>
                        </div>
                        <div class="col-4 col-sm-3">
                            <div class="hobby-card">
                                <i class="fas fa-hot-tub"></i>
                                <span>サウナ</span>
                            </div>
                        </div>
                    </div>
                    <p class="profile-text mt-3">
                        休日はサッカーをしているか子供と遊んでいることが多いです。コードを書くことに疲れた時やブログの記事が浮かんでこない時はサウナで瞑想しています（笑）
                    </p>
                </section>

                {{-- ABOUT THIS BLOG --}}
                <section class="mb-5">
                    <h3 class="profile-section-title">ABOUT THIS BLOG</h3>
                    <p class="profile-text">
                        このブログでは主に以下のテーマで発信しています。
                    </p>
                    <ul class="profile-text ps-3" style="line-height: 2;">
                        <li>生成AI（ChatGPT,Gemini,Claude Code）などの技術ネタ・実装メモ</li>
                        <li>公務員からフリーランスエンジニアへの転身記</li>
                        <li>独学・キャリアチェンジに関する話</li>
                        <li>フリーランスの仕事・お金まわりのリアル</li>
                    </ul>
                    <p class="profile-text">
                        「ちゃんとした記事」よりも「自分が詰まったこと・気づいたこと」をそのまま書くスタイルです。SEOとかあまり意識せず、まず自分が読みたいと思える記事を書くことを大事にしています。<br>
                        よかったら気軽に読んでいってください。
                    </p>
                </section>

                {{-- CONTACT --}}
                <section class="mb-5">
                    <h3 class="profile-section-title">CONTACT</h3>
                    <p class="profile-text">
                        お仕事のご依頼やご相談はお気軽にどうぞ。TwitterのDMかお問い合わせフォームからご連絡ください。
                    </p>
                    <div class="d-flex gap-3">
                        <a href="{{ route('top.contact') }}" class="btn btn-dark btn-sm px-4"
                            style="border-radius: 2px; font-size: 0.8rem; letter-spacing: 0.05em;">CONTACT FORM</a>
                    </div>
                </section>
            </main>

            {{-- サイドバー --}}
            <aside class="col-lg-4">
                <div class="sidebar-wrapper">
                    @include('partials.sidebar')
                </div>
            </aside>
        </div>
    </div>
@endsection

@section('css')
    <style>
        /* 共通設定 */
        .fw-black {
            font-weight: 900 !important;
            letter-spacing: 0.05em;
        }

        .profile-section-title {
            font-size: 0.8rem;
            font-weight: 900;
            letter-spacing: 0.2em;
            border-bottom: 1px solid #111;
            padding-bottom: 10px;
            margin-bottom: 1.5rem;
        }

        .profile-text {
            font-size: 0.95rem;
            line-height: 2;
            color: #333;
        }

        /* サイドバーの基本デザイン（トップページと同期） */
        .sidebar-section {
            margin-bottom: 3.5rem;
        }

        .sidebar-title {
            font-size: 0.75rem;
            font-weight: 900;
            letter-spacing: 0.15em;
            border-bottom: 1px solid #111;
            padding-bottom: 8px;
            margin-bottom: 1.5rem;
            color: #111;
        }

        .sidebar-name {
            font-size: 1.1rem;
            font-weight: 900;
            margin-bottom: 1rem;
        }

        .sidebar-text {
            font-size: 0.85rem;
            color: #666;
            line-height: 1.7;
            margin-bottom: 1rem;
        }

        .sidebar-link {
            font-size: 0.8rem;
            font-weight: bold;
            color: #111;
            text-decoration: none;
            border-bottom: 1px solid #111;
        }

        .sidebar-list {
            list-style: none;
            padding: 0;
        }

        .sidebar-list li {
            margin-bottom: 10px;
        }

        .sidebar-list li a {
            font-size: 0.9rem;
            color: #444;
            text-decoration: none;
        }

        .profile-icon-img {
            width: 80px;
            height: 80px;
            border-radius: 50%;
            object-fit: cover;
            margin-bottom: 1.2rem;
        }

        .latest-item {
            display: flex;
            align-items: center;
            text-decoration: none;
            margin-bottom: 15px;
        }

        .latest-item img {
            width: 45px;
            height: 45px;
            object-fit: cover;
            margin-right: 12px;
            border-radius: 2px;
        }

        .latest-title {
            font-size: 0.85rem;
            font-weight: bold;
            color: #333;
            line-height: 1.4;
        }

        /* PCのみ適用するスタイル */
        @media (min-width: 992px) {
            .sidebar-wrapper {
                position: sticky;
                top: 100px;
                padding-left: 3rem;
                /* ここでPC時の余白を確保 */
            }
        }

        /* スマホのみ適用（崩れ防止） */
        @media (max-width: 991px) {
            .sidebar-wrapper {
                margin-top: 4rem;
                padding-left: 0;
            }

            .fw-black {
                font-size: 1.8rem;
            }

            /* スマホではタイトルを少し小さく */
        }

        /* Timeline */
        .timeline-item {
            position: relative;
            padding-left: 1.5rem;
            margin-bottom: 1.2rem;
        }
        .timeline-item::before {
            content: '';
            position: absolute;
            left: 0; top: 8px;
            width: 8px; height: 8px;
            background: #111;
            border-radius: 50%;
        }
        .timeline-item::after {
            content: '';
            position: absolute;
            left: 3px; top: 18px;
            width: 2px; height: calc(100% + 4px);
            background: #ddd;
        }
        .timeline-item:last-child::after { display: none; }

        /* Skill Badge */
        .skill-badge {
            display: inline-block;
            background: #111;
            color: #fff;
            font-size: 0.75rem;
            font-weight: 600;
            padding: 4px 12px;
            border-radius: 2px;
            margin: 3px;
            letter-spacing: 0.05em;
        }

        /* Hobby Card */
        .hobby-card {
            border: 1px solid #e5e5e5;
            border-radius: 4px;
            padding: 1rem;
            text-align: center;
            background: #fff;
        }
        .hobby-card i {
            font-size: 1.5rem;
            color: #111;
            margin-bottom: 0.5rem;
            display: block;
        }
        .hobby-card span {
            font-size: 0.8rem;
            font-weight: 600;
            color: #333;
        }
    </style>
@endsection