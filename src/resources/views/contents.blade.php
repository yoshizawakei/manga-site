@extends('layouts.app')

@section("css")
    <link rel="stylesheet" href="{{ asset('css/contents.css') }}">
    <style>
        /* コンテンツエリアのダークテーマ補助スタイル */
        .content-card {
            background-color: var(--card-background);
            /* common.cssのカード背景色を使用 */
            border-radius: 0.75rem;
            padding: 2rem;
            box-shadow: 0 6px 15px rgba(0, 0, 0, 0.5);
            /* 強めの影 */
            border: 1px solid var(--border-color);
        }
    </style>
@endsection

@section("content")
    <div class="container my-5">
        <div class="content-card">
            <div class="content p-4 text-white">
                <h1 class="text-primary border-bottom border-secondary pb-2 mb-4">コンテンツのタイトル</h1>
                <p class="lead">詳細なコンテンツの本文がここに表示されます。</p>
                <ul>
                    <li>クールなデザインが適用されます。</li>
                    <li>Bootstrapの機能が利用可能です。</li>
                </ul>
            </div>

        </div>
    </div>
@endsection