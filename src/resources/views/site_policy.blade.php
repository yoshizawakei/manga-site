@extends('layouts.app')

@section('title', ' | サイトポリシー・利用規約')

@section('css')
    <style>
        /* ポリシーコンテナ：パディングは内側のラッパーで制御 */
        .policy-container {
            background-color: var(--card-bg);
            border: 1px solid var(--border-color);
            border-radius: 1rem;
            box-shadow: 0 4px 6px -1px rgba(0, 0, 0, 0.05);
            overflow: hidden;
        }

        /* メインタイトル */
        .policy-container h2 {
            color: var(--primary-color);
            font-weight: 800;
            border-left: 6px solid var(--primary-color);
            padding-left: 1.25rem;
            margin-bottom: 2rem;
            letter-spacing: -0.02em;
        }

        /* 中見出し */
        .policy-container h3 {
            color: var(--text-main);
            font-size: 1.5rem;
            font-weight: 700;
            margin-top: 3rem;
            margin-bottom: 1.25rem;
            display: flex;
            align-items: center;
        }
        .policy-container h3::before {
            content: "";
            display: inline-block;
            width: 20px;
            height: 3px;
            background-color: var(--primary-color);
            margin-right: 12px;
            border-radius: 2px;
        }

        /* 条項タイトル */
        .policy-container h4 {
            color: var(--primary-color);
            font-size: 1.1rem;
            font-weight: 700;
            margin-top: 1.5rem;
        }

        /* 本文・リスト */
        .policy-container p, .policy-container li {
            color: var(--text-secondary);
            line-height: 1.8;
            font-weight: 500;
        }

        /* 警告枠（18禁など）：ライトモード用に視認性向上 */
        .alert-policy {
            background-color: #fef2f2; /* 薄い赤 */
            border: 2px solid #ef4444; /* はっきりとした赤 */
            color: #991b1b; /* 濃い赤で文字を読みやすく */
            padding: 1.5rem;
            border-radius: 0.75rem;
            margin: 2rem 0;
        }

        /* 情報枠 */
        .alert-info-custom {
            background-color: #f0fdf4; /* 薄いエメラルド */
            border: 1px solid var(--primary-color);
            color: var(--text-main);
            padding: 1.25rem;
            border-radius: 0.5rem;
            margin-top: 1rem;
        }

        /* パンくずリスト */
        .breadcrumb-item a {
            color: var(--primary-color) !important;
            text-decoration: none;
            font-weight: 600;
        }
    </style>
@endsection

@section('content')
<div class="row justify-content-center">
    <div class="col-12 col-lg-10 col-xl-9">
        <div class="policy-container shadow-sm">
            {{-- パディング確保用のラッパー --}}
            <div class="p-4 p-md-5">
                {{-- パンくずリスト --}}
                <nav aria-label="breadcrumb" class="mb-4 small">
                    <ol class="breadcrumb mb-0">
                        <li class="breadcrumb-item"><a href="{{ route('top.index') }}">ホーム</a></li>
                        <li class="breadcrumb-item active" aria-current="page">サイトポリシー</li>
                    </ol>
                </nav>

                <h2>サイトポリシー・利用規約</h2>
                
                <p class="lead fw-bold" style="color: var(--text-main);">
                    当サイトは、無料漫画を合法的に紹介・ナビゲートすることを目的としたアフィリエイトメディアです。
                    ユーザーの皆様に安全な閲覧環境を提供するため、以下の規約を定めます。
                </p>

                <hr class="my-5" style="border-color: var(--border-color); opacity: 1;">

                <section>
                    <h3>1. 著作権について</h3>
                    <p>
                        当サイトに掲載されている作品の著作権は、各著者、出版社、またはコンテンツ提供者に帰属します。
                        当サイトは、DMM.com、FANZA、DLsite等の公式アフィリエイトプログラムに基づき、適切なライセンスの範囲内で情報を掲載しております。
                    </p>
                    <div class="alert-info-custom shadow-sm">
                        <i class="fas fa-info-circle me-2 text-primary"></i>
                        当サイト独自の文章、デザイン、ソースコードの無断転載・複製は固く禁じます。
                    </div>
                </section>

                <section>
                    <h3>2. 閲覧年齢制限について</h3>
                    <div class="alert-policy shadow-sm">
                        <h4 class="text-danger mt-0" style="color: #b91c1c !important;"><i class="fas fa-exclamation-triangle me-2"></i>重要：年齢制限</h4>
                        当サイトは一部にアダルトコンテンツを含むため、<strong>18歳未満の方のご利用を固くお断りいたします。</strong>
                        サイトを利用された時点で、ユーザーは18歳以上であるとみなします。
                    </div>
                </section>

                <section>
                    <h3>3. 広告と免責事項</h3>
                    <p>
                        当サイトでは、DMM.com、FANZA、DLsite、忍者AdMax等の広告を利用しています。
                        広告のリンク先でのトラブルや購入に関するお問い合わせは、各販売元に直接ご連絡ください。
                        当サイトの利用により生じた損害について、当サイトは一切の責任を負いかねます。
                    </p>
                </section>

                <section>
                    <h3>4. 利用規約</h3>
                    
                    <h4>第1条（規約の同意）</h4>
                    <p>本規約は、当サイトの利用に関する一切に適用されます。ユーザーは、閲覧を開始した時点で本規約に同意したものとみなします。</p>

                    <h4>第2条（禁止事項）</h4>
                    <p>以下の行為を固く禁じます。</p>
                    <ul class="list-unstyled ms-3">
                        <li class="mb-3 d-flex align-items-start">
                            <i class="fas fa-times-circle text-danger me-2 mt-1"></i>
                            <span>公序良俗に反する行為、または違法行為</span>
                        </li>
                        <li class="mb-3 d-flex align-items-start">
                            <i class="fas fa-times-circle text-danger me-2 mt-1"></i>
                            <span>当サイトの運営を妨害するスクレイピングや攻撃行為</span>
                        </li>
                        <li class="mb-3 d-flex align-items-start">
                            <i class="fas fa-times-circle text-danger me-2 mt-1"></i>
                            <span>第三者への誹謗中傷や知的財産権の侵害</span>
                        </li>
                    </ul>
                </section>
                
                <footer class="mt-5 pt-4 border-top text-center">
                    <p class="small text-secondary mb-3">改定：{{ date('Y年m月d日') }}</p>
                    <a href="{{ route('top.index') }}" class="btn btn-outline-primary px-5 rounded-pill fw-bold">
                        <i class="fas fa-home me-2"></i>トップページへ戻る
                    </a>
                </footer>
            </div>
        </div>
    </div>
</div>
@endsection