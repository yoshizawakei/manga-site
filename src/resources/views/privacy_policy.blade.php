@extends('layouts.admin')
{{-- NOTE: ユーザー向けページですが、デザイン統一のため、Bootstrap構造を持つlayouts.adminを継承します。 --}}

@section("css")
    <style>
        /* プライバシーポリシーページ用スタイル */
        .main-content-container {
            max-width: 900px;
            margin: 0 auto;
            padding: 3rem 1.5rem;
            background-color: var(--card-background);
            /* common.cssのカード背景色を使用 */
            border-radius: 0.75rem;
            box-shadow: var(--shadow-light);
            border: 1px solid var(--border-color);
        }

        .main-content-container h2 {
            color: var(--primary-color);
            /* 紫のアクセント */
            border-bottom: 3px solid var(--secondary-color);
            padding-bottom: 0.5rem;
            margin-bottom: 2rem;
            font-weight: bold;
            font-size: 2rem;
        }

        .main-content-container h3 {
            color: var(--secondary-color);
            /* シアンのアクセント */
            margin-top: 2rem;
            margin-bottom: 1rem;
            font-weight: 600;
            font-size: 1.5rem;
        }

        .main-content-container p,
        .main-content-container ul {
            color: var(--text-color);
            line-height: 1.8;
            margin-bottom: 1.5rem;
        }

        .main-content-container ul {
            list-style-type: none;
            /* デフォルトのリストスタイルを非表示 */
            padding-left: 0;
        }

        .main-content-container ul li {
            position: relative;
            padding-left: 1.5rem;
            margin-bottom: 0.5rem;
        }

        .main-content-container ul li::before {
            content: "•";
            color: var(--primary-color);
            /* 紫の箇条書きマーク */
            font-weight: bold;
            display: inline-block;
            width: 1em;
            margin-left: -1em;
            position: absolute;
        }
    </style>
@endsection

@section('content')
    <div class="main-content-container">
        <h2>個人情報保護方針</h2>
        <p class="lead">当サイトは、ユーザーの皆様の個人情報保護の重要性について認識し、個人情報保護に関する法令を遵守するとともに、以下のプライバシーポリシーに従い、適切に取り扱います。</p>

        <hr class="border-secondary my-4">

        <h3>1. 個人情報の取得について</h3>
        <p>当サイトは、お問い合わせフォームのご利用、または広告サービスを通じて、以下のような個人情報を取得する場合があります。</p>
        <ul class="list-unstyled">
            <li><i class="fas fa-dot-circle me-2 text-primary"></i>メールアドレス</li>
            <li><i class="fas fa-dot-circle me-2 text-primary"></i>IPアドレス</li>
            <li><i class="fas fa-dot-circle me-2 text-primary"></i>利用端末の識別情報（Cookie情報、ブラウザ情報など）</li>
        </ul>
        <p class="small text-white-50">これらの情報は、当サイトのサービス向上、ユーザーの利便性向上、および広告効果の分析に利用されます。</p>

        <h3>2. 個人情報の利用目的</h3>
        <p>取得した個人情報は、以下の目的で利用します。</p>
        <ul class="list-unstyled">
            <li><i class="fas fa-check-circle me-2 text-primary"></i>お問い合わせへの対応</li>
            <li><i class="fas fa-check-circle me-2 text-primary"></i>サービスの改善、新サービスの開発</li>
            <li><i class="fas fa-check-circle me-2 text-primary"></i>広告の配信、および広告効果の測定</li>
            <li><i class="fas fa-check-circle me-2 text-primary"></i>利用状況の分析、統計データの作成</li>
        </ul>

        <h3>3. 個人情報の第三者提供について</h3>
        <p>当サイトは、以下の場合を除き、ご本人の同意を得ることなく、個人情報を第三者に提供することはありません。</p>
        <ul class="list-unstyled">
            <li><i class="fas fa-gavel me-2 text-primary"></i>法令に基づく場合</li>
            <li><i class="fas fa-gavel me-2 text-primary"></i>人の生命、身体または財産の保護のために必要がある場合</li>
            <li><i class="fas fa-gavel me-2 text-primary"></i>公衆衛生の向上または児童の健全な育成の推進のために特に必要がある場合</li>
            <li><i class="fas fa-gavel me-2 text-primary"></i>国の機関もしくは地方公共団体またはその委託を受けた者が法令の定める事務を遂行することに対して協力する必要がある場合</li>
        </ul>

        <h3>4. アクセス解析ツールおよびCookieについて</h3>
        <p class="alert alert-info text-dark fw-bold">当サイトでは、サービスの向上を目的として、**Google
            Analytics**などのアクセス解析ツールを利用しています。これらのツールはトラフィックデータ収集のためにCookieを使用しますが、個人を特定する情報ではありません。ユーザーはブラウザの設定でCookieの利用を拒否することができます。
        </p>
        <p>また、当サイトで利用しているアフィリエイトサービス（DMM.com、FANZA、忍者AdMaxなど）も、Cookieを利用してユーザーの訪問履歴情報を取得する場合があります。これらの情報は、広告の配信、および成果の測定にのみ利用されます。
        </p>

        <h3>5. プライバシーポリシーの変更について</h3>
        <p>本ポリシーの内容は、法令改正やサービスの変更等に応じて、事前の予告なく変更されることがあります。変更後のプライバシーポリシーは、当サイトに掲載された時点で有効になります。</p>
    </div>
@endsection