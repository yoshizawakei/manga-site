@extends('layouts.app')

@section('title', ' | 個人情報保護方針（プライバシーポリシー）')

@section('css')
    <style>
        /* ポリシーコンテナ：枠組みを定義（パディングは内側のラッパーで制御） */
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

        /* 本文とリスト */
        .policy-container p, .policy-container li {
            color: var(--text-secondary);
            line-height: 1.8;
            margin-bottom: 1rem;
            font-weight: 500;
        }

        /* アイコン付きリスト */
        .policy-list {
            padding-left: 0;
            list-style: none;
        }
        .policy-list li {
            display: flex;
            align-items: flex-start;
            margin-bottom: 0.75rem;
        }
        .policy-list li i {
            color: var(--primary-color);
            margin-top: 5px;
            margin-right: 12px;
            font-size: 0.9rem;
        }

        /* Google Analytics等の注記ボックス：ライトモード向け調整 */
        .policy-info-box {
            background-color: #f0fdf4; /* 非常に薄いエメラルド */
            border: 1px solid var(--primary-color);
            color: var(--text-main);
            padding: 1.5rem;
            border-radius: 0.75rem;
            margin: 2.5rem 0;
        }

        .policy-footer {
            margin-top: 4rem;
            padding-top: 2rem;
            border-top: 1px solid var(--border-color);
            text-align: center;
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
    {{-- 横幅を col-lg-10 などで制限し、読みやすさを向上 --}}
    <div class="col-12 col-lg-10 col-xl-9">
        <div class="policy-container shadow-sm">
            {{-- パディング確保用のラッパー --}}
            <div class="p-4 p-md-5">
                {{-- パンくずリスト --}}
                <nav aria-label="breadcrumb" class="mb-4 small">
                    <ol class="breadcrumb mb-0">
                        <li class="breadcrumb-item"><a href="{{ route('top.index') }}">ホーム</a></li>
                        <li class="breadcrumb-item active" aria-current="page">個人情報保護方針</li>
                    </ol>
                </nav>

                <h2>個人情報保護方針</h2>
                <p class="lead fw-bold" style="color: var(--text-main);">
                    当サイトは、ユーザーの皆様の個人情報保護の重要性を認識し、法令を遵守するとともに、本プライバシーポリシーに従い適切に取り扱います。
                </p>

                <hr class="my-5" style="border-color: var(--border-color); opacity: 1;">

                <section>
                    <h3>1. 個人情報の取得について</h3>
                    <p>当サイトは、お問い合わせフォームのご利用、または広告サービスを通じて、以下の情報を取得する場合があります。</p>
                    <ul class="policy-list">
                        <li><i class="fas fa-caret-right"></i>メールアドレス（お問い合わせ時）</li>
                        <li><i class="fas fa-caret-right"></i>IPアドレス</li>
                        <li><i class="fas fa-caret-right"></i>利用端末の識別情報（Cookie情報、ブラウザ情報など）</li>
                    </ul>
                </section>

                <section>
                    <h3>2. 個人情報の利用目的</h3>
                    <p>取得した情報は、以下の目的で適切に利用します。</p>
                    <ul class="policy-list">
                        <li><i class="fas fa-check"></i>お問い合わせへの回答および本人確認</li>
                        <li><i class="fas fa-check"></i>サービスの改善、アクセスの統計分析</li>
                        <li><i class="fas fa-check"></i>各アフィリエイト広告（DMM.com、FANZA、DLsite等）の効果測定</li>
                    </ul>
                </section>

                <section>
                    <h3>3. アクセス解析とCookieについて</h3>
                    <div class="policy-info-box shadow-sm">
                        <h4 class="h6 fw-bold mb-3"><i class="fas fa-chart-line me-2 text-primary"></i>分析ツールの利用</h4>
                        当サイトでは、サービスの向上を目的として**Google Analytics**を利用しています。
                        これらはデータ収集のためにCookieを使用しますが、個人を特定する情報は含まれません。
                        ユーザーはブラウザ設定でCookieを無効にすることが可能です。
                    </div>
                    <p>
                        また、利用中のアフィリエイトサービス（DMM.com、FANZA、忍者AdMax、DLsiteなど）も、成果計測のためにCookieを利用する場合があります。
                    </p>
                </section>

                <section>
                    <h3>4. 第三者提供の制限</h3>
                    <p>法令に基づく場合を除き、ご本人の同意を得ることなく個人情報を第三者に提供することはありません。</p>
                </section>

                <div class="policy-footer">
                    <p class="small text-secondary mb-3">最終改定日：{{ date('Y年m月d日') }}</p>
                    <a href="{{ route('top.index') }}" class="btn btn-outline-primary px-5 rounded-pill fw-bold">
                        <i class="fas fa-home me-2"></i>トップへ戻る
                    </a>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection