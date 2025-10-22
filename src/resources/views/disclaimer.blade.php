@extends('layouts.admin')
{{-- NOTE: ユーザー向けページですが、デザイン統一のため、Bootstrap構造を持つlayouts.adminを継承します。 --}}

@section("css")
    <style>
        /* 免責事項ページ用スタイル */
        .main-content-container {
            max-width: 900px;
            margin: 0 auto;
            padding: 3rem 1.5rem;
            background-color: var(--card-background); /* カード背景色を使用 */
            border-radius: 0.75rem;
            box-shadow: var(--shadow-light);
            border: 1px solid var(--border-color);
        }
        .main-content-container h2 {
            color: var(--primary-color); /* 紫のアクセント */
            border-bottom: 3px solid var(--secondary-color);
            padding-bottom: 0.5rem;
            margin-bottom: 2rem;
            font-weight: bold;
            font-size: 2rem;
        }
        .main-content-container h3 {
            color: var(--secondary-color); /* シアンのアクセント */
            margin-top: 1.5rem;
            margin-bottom: 0.75rem;
            font-weight: 600;
            font-size: 1.5rem;
        }
        .main-content-container p {
            color: var(--text-color);
            line-height: 1.8;
            margin-bottom: 1.5rem;
        }
    </style>
@endsection

@section('content')
    <div class="main-content-container">
        <h2>免責事項</h2>
        <p class="lead">当サイトは、DMM.comおよび株式会社FANZA等のアフィリエイトサービスを利用して運営されています。</p>

        <hr class="border-secondary my-4">

        <h3>1. コンテンツの正確性・完全性について</h3>
        <p>当サイトで紹介している作品情報、価格、在庫状況などは、常に変動する可能性があります。これらの情報は、ご自身で必ずFANZA等の公式サイトにてご確認ください。当サイトのコンテンツの正確性、完全性、有用性については一切保証いたしません。</p>
        <p class="alert alert-warning text-dark fw-bold">当サイトのご利用によって生じた、いかなる損害につきましても、当サイトでは一切の責任を負いかねます。</p>

        <h3>2. 外部サイトへのリンクについて</h3>
        <p>当サイトからFANZAをはじめとする外部サイトへ移動した場合、移動先サイトで提供される情報やサービス等について、当サイトは一切の責任を負いません。</p>
        <p>DMM.com、FANZA、および忍者AdMaxなど、当サイトに掲載されている広告リンク先の利用については、各サイトの規約を遵守してください。当サイトは、リンク先サイトの内容やプライバシー保護、サービス利用に関して、責任を負うものではありません。</p>

        <h3>3. 広告の表示について</h3>
        <p>当サイトに掲載されている広告は、当サイト運営者によって選択されたものであり、すべての広告がユーザーのニーズに合致することを保証するものではありません。広告の表示内容や表現に関する責任は、各広告主に帰属します。</p>
    </div>
@endsection