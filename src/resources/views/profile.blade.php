@extends('layouts.app')

@section('content')
    <div class="container py-4 py-lg-5 mt-lg-5">
        <div class="row g-4 g-lg-5">
            {{-- メインコンテンツ --}}
            <main class="col-lg-8">
                <h1 class="fw-black mb-4 mb-lg-5">ABOUT ME</h1>

                <div class="text-center mb-5">
                    <i class="fas fa-user-circle mb-3" style="font-size: 60px; color: #111;"></i>
                    <h2 class="h5 fw-bold">KEI</h2>
                    <p class="text-secondary small">Webエンジニア</p>
                </div>

                <section class="mb-5">
                    <h3 class="profile-section-title">GREETING</h3>
                    <p class="profile-text">
                        はじめまして、Keiです。元地方公務員、現在はフリーランスのWebエンジニアとして活動しながら、このブログを運営しています。
                    </p>
                </section>

                <section class="mb-5">
                    <h3 class="profile-section-title">STORY</h3>
                    <div class="ps-3 border-start border-2 border-dark">
                        <p class="mb-2">2016-2025: 地方公務員。安定を捨ててエンジニアへ。</p>
                        <p class="mb-0">2025-: フリーランスとしてWEB制作に携わりながら自分のサイトを運営。</p>
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
    </style>
@endsection