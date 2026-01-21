@extends('layouts.app')

@section('title', ' | 免責事項')

@section('css')
    <style>
        /* 免責事項ページ専用コンテナ：パディングの直接指定は廃止しラッパーで行う */
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

        /* セクション見出し */
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

        /* 本文テキスト */
        .policy-container p {
            color: var(--text-secondary);
            line-height: 1.8;
            margin-bottom: 1.5rem;
            font-weight: 500;
        }

        /* 警告・重要事項の強調枠：ライトモードで見やすいアンバーに調整 */
        .policy-alert {
            background-color: #fffbeb; /* 非常に薄いアンバー */
            border: 2px solid #f59e0b; /* アンバーの境界線 */
            color: #b45309; /* 濃い茶色に近いアンバーで文字を読みやすく */
            padding: 1.5rem;
            border-radius: 0.75rem;
            margin: 2.5rem 0;
            font-weight: 700;
        }

        .policy-footer {
            margin-top: 4rem;
            padding-top: 2rem;
            border-top: 1px solid var(--border-color);
            text-align: center;
        }

        /* パンくずリストの色固定 */
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
            {{-- 内側にしっかりパディングを確保 --}}
            <div class="p-4 p-md-5">
                {{-- パンくずリスト --}}
                <nav aria-label="breadcrumb" class="mb-4 small">
                    <ol class="breadcrumb mb-0">
                        <li class="breadcrumb-item"><a href="{{ route('top.index') }}">ホーム</a></li>
                        <li class="breadcrumb-item active" aria-current="page">免責事項</li>
                    </ol>
                </nav>

                <h2>免責事項</h2>
                <p class="lead fw-bold" style="color: var(--text-main);">
                    当サイトは、DMM.com、FANZA、DLsite、忍者AdMax等のアフィリエイトサービスを利用して運営されています。
                </p>

                <hr class="my-5" style="border-color: var(--border-color); opacity: 1;">

                <section>
                    <h3>1. コンテンツの正確性・完全性について</h3>
                    <p>
                        当サイトで紹介している作品情報、価格、在庫状況などは、提携先サイトの情報を元に作成していますが、これらは常に変動する可能性があります。
                        最新の情報は、必ずリンク先の公式サイト（FANZA、DLsite等）にてご確認ください。
                    </p>
                    <div class="policy-alert shadow-sm">
                        <i class="fas fa-exclamation-triangle me-2"></i>
                        当サイトのご利用によって生じた、いかなる損害につきましても、当サイトでは一切の責任を負いかねます。
                    </div>
                    <p>当サイトのコンテンツの正確性、完全性、有用性については一切保証いたしません。</p>
                </section>

                <section>
                    <h3>2. 外部サイトへのリンクについて</h3>
                    <p>
                        当サイトから外部サイトへ移動した場合、移動先サイトで提供される情報やサービス、個人情報の取り扱い等について、当サイトは一切の責任を負いません。
                        広告リンク先の利用については、各提携サイトの規約を遵守してください。
                    </p>
                </section>

                <section>
                    <h3>3. 広告の表示について</h3>
                    <p>
                        当サイトに掲載されている広告は、当サイト運営者が選択したものですが、すべての内容がユーザーのニーズに合致することを保証するものではありません。
                        広告の表示内容や表現に関する責任は、各広告主に帰属します。
                    </p>
                </section>

                <div class="policy-footer">
                    <p class="small text-secondary mb-3">最終改訂：{{ date('Y年m月d日') }}</p>
                    <a href="{{ route('top.index') }}" class="btn btn-outline-primary px-5 rounded-pill fw-bold">
                        <i class="fas fa-arrow-left me-2"></i>ホームへ戻る
                    </a>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection