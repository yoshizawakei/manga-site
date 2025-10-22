@extends('layouts.admin')
{{-- NOTE: ユーザー向けページですが、デザイン統一のため、Bootstrap構造を持つlayouts.adminを継承します。 --}}

@section("css")
    <style>
        /* サイトポリシー・利用規約ページ用スタイル */
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
            /* シアンのアクセント (セクションタイトル) */
            margin-top: 2rem;
            margin-bottom: 1rem;
            font-weight: 600;
            font-size: 1.5rem;
        }

        .main-content-container h4 {
            color: var(--primary-color);
            /* 紫のアクセント (条項タイトル) */
            margin-top: 1rem;
            margin-bottom: 0.5rem;
            font-weight: 700;
            font-size: 1.25rem;
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

        .alert-danger-custom {
            background-color: #331518;
            /* ダークテーマに合わせた薄い赤 */
            border-left: 5px solid #DC3545;
            padding: 1rem;
            border-radius: 0.25rem;
            color: var(--text-color);
        }
    </style>
@endsection

@section('content')
    <div class="main-content-container">
        <h2>サイトポリシー・利用規約</h2>
        <p class="lead">
            当サイトは、無料のアダルト漫画を合法的に紹介・配信することを目的とした、DMM.comおよび株式会社FANZA等のアフィリエイトサイトです。ユーザーの皆様に安全で快適な閲覧環境を提供するため、以下のポリシーおよび利用規約を定めます。
        </p>

        <hr class="border-secondary my-4">

        <h3>1. 著作権について</h3>
        <p>当サイトに掲載されている漫画作品の著作権は、各漫画家、出版社、またはコンテンツ提供者に帰属します。当サイトが提供するコンテンツは、DMM.comおよびFANZA等の公式アフィリエイトプログラムに基づき、各著作権者の許諾を得て掲載しております。
        </p>
        <p class="alert alert-warning text-dark fw-bold">当サイトの文章、画像、デザイン等の著作権は当サイトに帰属します。無断での転載・複製・二次利用は固く禁じます。</p>

        <h3>2. 閲覧年齢制限について</h3>
        <p class="alert alert-danger-custom fw-bold">
            当サイトはアダルトコンテンツを扱っているため、18歳未満の方のご利用を固くお断りいたします。当サイトを利用された時点で、ユーザーは18歳以上であるとみなします。</p>

        <h3>3. 広告について</h3>
        <p>当サイトでは、DMM.comおよびFANZA等のアフィリエイトプログラム、並びに**忍者AdMax**と**DLsite**の広告を利用しています。これらの広告は当サイトの運営費を賄うためのものです。</p>
        <p>広告のリンク先でのトラブルや購入に関するお問い合わせは、各広告主または販売元に直接ご連絡ください。当サイトでは一切の責任を負いかねます。</p>

        <hr class="border-secondary my-4">

        <h3>4. 利用規約</h3>

        <h4>第1条（本規約の適用）</h4>
        <p>本規約は、当サイトの利用に関する一切に適用されます。ユーザーは、本サイトを利用した時点で本規約に同意したものとみなします。</p>

        <h4>第2条（禁止事項）</h4>
        <p>ユーザーは、本サイトの利用にあたり、以下の行為を行ってはならないものとします。</p>
        <ul class="list-unstyled">
            <li><i class="fas fa-times-circle me-2 text-danger"></i>違法な行為、公序良俗に反する行為</li>
            <li><i class="fas fa-times-circle me-2 text-danger"></i>当サイトまたは第三者の著作権、商標権、その他の知的財産権を侵害する行為</li>
            <li><i class="fas fa-times-circle me-2 text-danger"></i>他者への誹謗中傷、プライバシー侵害、ハラスメント行為</li>
            <li><i class="fas fa-times-circle me-2 text-danger"></i>有害なコンピュータプログラム等の送信、当サイトの運営を妨害する行為</li>
            <li><i class="fas fa-times-circle me-2 text-danger"></i>その他、当サイトが不適切と判断する行為</li>
        </ul>
        <p class="small text-white-50 fst-italic">上記の禁止事項に違反した場合、当サイトは事前に通知することなく、ユーザーの利用を停止または制限することができるものとします。</p>
    </div>
@endsection