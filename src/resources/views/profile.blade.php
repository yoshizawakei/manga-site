@extends('layouts.app')

@section('title', 'プロフィール')

@section('css')
    <style>
        /* ページ全体の余白 */
        .profile-page-wrapper {
            padding-top: 4rem;
            padding-bottom: 5rem;
        }

        .profile-header {
            /* グラデーションを再設定し、角を丸く調整 */
            border-radius: 5px;
            padding: 5rem 2rem;
            /* 上下の余白を確保 */
            margin-bottom: 4rem;
        }

        .profile-avatar {
            width: 150px;
            height: 150px;
            background-color: white;
            border: 5px solid white;
            box-shadow: 0 10px 25px rgba(0, 0, 0, 0.1);
            display: flex;
            align-items: center;
            justify-content: center;
            margin: 0 auto;
        }

        /* 各セクションの余白設定 */
        .profile-section {
            padding-top: 2.5rem;
            padding-bottom: 2.5rem;
            border-bottom: 1px solid #f1f5f9;
        }

        .profile-section:last-child {
            border-bottom: none;
        }

        .timeline {
            border-left: 3px solid #e2e8f0;
            padding-left: 2rem;
            position: relative;
        }

        .timeline-item {
            position: relative;
            margin-bottom: 3rem;
        }

        .timeline-item::before {
            content: "";
            position: absolute;
            left: calc(-2rem - 8px);
            top: 6px;
            width: 13px;
            height: 13px;
            background-color: #10b981;
            border-radius: 50%;
            border: 2px solid white;
            box-shadow: 0 0 0 2px #10b981;
        }
    </style>
@endsection

@section('content')
    <div class="container-xxl profile-page-wrapper">
        {{-- ヘッダー --}}
        <div class="profile-header text-center shadow-lg">
            <h1 class="display-5 fw-bold mb-3">About Kei</h1>
            <p class="opacity-90">元公務員エンジニアが挑む、ゼロからの副業実践記</p>
        </div>

        <div class="row g-4">
            {{-- 左側：メインコンテンツ --}}
            <main class="col-lg-8">
                <div class="main-content-container shadow-sm border bg-white p-4 p-md-5 rounded-4">

                    {{-- 基本情報 --}}
                    <div class="text-center pb-5">
                        <div class="profile-avatar rounded-circle mb-4">
                            <i class="fas fa-user-tie fa-5x text-primary"></i>
                        </div>
                        <h2 class="h3 fw-bold">Kei</h2>
                        <p class="text-secondary">Webエンジニア / 合同会社kaisena 代表</p>
                        <div class="d-flex justify-content-center gap-2 mt-3">
                            <span
                                class="badge bg-light text-primary border border-primary-subtle px-3 py-2 rounded-pill small">Laravel</span>
                            <span
                                class="badge bg-light text-primary border border-primary-subtle px-3 py-2 rounded-pill small">Freelance</span>
                            <span
                                class="badge bg-light text-primary border border-primary-subtle px-3 py-2 rounded-pill small">PHP</span>
                        </div>
                    </div>

                    {{-- ご挨拶：fs-5を削除して標準サイズに --}}
                    <section class="profile-section">
                        <h3 class="h4 fw-bold mb-4 d-flex align-items-center">
                            <i class="fas fa-hand-holding-heart me-3 text-primary"></i>ご挨拶
                        </h3>
                        <p class="leading-relaxed text-main">
                            はじめまして、Keiです。数あるブログの中から「Keiの副業ログ」を訪れていただき、ありがとうございます。<br><br>
                            私は現在、フリーランスのWebエンジニアとして活動しながら、このブログを通じて「未経験からアフィリエイトで収益を上げるまでのプロセス」を公開しています。
                        </p>
                    </section>

                    {{-- 歩み：タイトルのサイズをh5に下げて調整 --}}
                    <section class="profile-section">
                        <h3 class="h4 fw-bold mb-5 d-flex align-items-center">
                            <i class="fas fa-history me-3 text-primary"></i>これまでの歩み
                        </h3>
                        <div class="timeline ms-3">
                            <div class="timeline-item">
                                <h4 class="h6 fw-bold mb-2">2016年 - 2025年：地方公務員として10年間勤務</h4>
                                <p class="text-secondary small">
                                    生活保護ケースワーカーや国際交流、施設管理など多岐にわたる業務を経験。安定した環境でしたが、「自分の力で稼ぐスキル」を求めて退職を決意。</p>
                            </div>
                            <div class="timeline-item">
                                <h4 class="h6 fw-bold mb-2">2025年：Webエンジニアへの転身</h4>
                                <p class="text-secondary small">
                                    プログラミングスクールでプログラミングを学び、フリーランスエンジニアとして独立。「合同会社kaisena」を設立し、実務経験を積み始めます。</p>
                            </div>
                            <div class="timeline-item">
                                <h4 class="h6 fw-bold mb-2 text-primary">2026年 - 現在：副業ブログの運営開始</h4>
                                <p class="text-secondary small">
                                    エンジニアとしての知識を活かしつつ、全くの未経験だったアフィリエイトに挑戦。「足跡」を刻むように、一歩ずつ収益化を目指しています。</p>
                            </div>
                        </div>
                    </section>

                    {{-- お伝えしたいこと --}}
                    <section class="profile-section border-0">
                        <div class="p-4 bg-light rounded-4 border-start border-primary border-5 shadow-sm">
                            <h3 class="h5 fw-bold mb-3 d-flex align-items-center">
                                <i class="fas fa-bullseye me-2 text-primary"></i>ブログでお伝えしたいこと
                            </h3>
                            <ul class="list-unstyled mb-0 small">
                                <li class="mb-2 d-flex align-items-start">
                                    <i class="fas fa-check-circle text-primary mt-1 me-2"></i>
                                    <span>スキルゼロから収益化するまでの具体的な手順</span>
                                </li>
                                <li class="mb-2 d-flex align-items-start">
                                    <i class="fas fa-check-circle text-primary mt-1 me-2"></i>
                                    <span>エンジニア視点での効率的なブログ運営・ツール紹介</span>
                                </li>
                                <li class="d-flex align-items-start">
                                    <i class="fas fa-check-circle text-primary mt-1 me-2"></i>
                                    <span>会社に頼らず自立を目指すマインドセット</span>
                                </li>
                            </ul>
                        </div>
                    </section>

                    <div class="text-center py-5">
                        <a href="{{ route('top.index') }}" class="btn btn-primary rounded-pill px-5 py-2 shadow">
                            実践ログ一覧を見てみる
                        </a>
                    </div>
                </div>
            </main>

            {{-- サイドバー --}}
            @include('partials.sidebar')
        </div>
    </div>
@endsection