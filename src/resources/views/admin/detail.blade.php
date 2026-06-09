@extends('layouts.admin')

@section('title', '新規ログ作成')

{{--
親レイアウトの受け口に合わせて @push('css') に変更し、
スタイルが確実に反映されるように修正しました。
--}}
@push('css')
    <style>
        /* クリーン・エメラルド・エディターカスタム */
        :root {
            --editor-card: #ffffff;
            --editor-primary: #10b981;
            --editor-border: #e2e8f0;
            --editor-text: #1e293b;
            --editor-secondary: #64748b;
        }

        /* 【修正】全体の最大幅を維持しつつ、左右中央に配置するラッパー */
        .editor-container {
            max-width: 900px;
            margin: 0 auto;
            width: 100%;
        }

        .editor-card {
            background-color: var(--editor-card);
            border-radius: 1.5rem;
            border: 1px solid var(--editor-border);
            box-shadow: 0 10px 15px -3px rgba(0, 0, 0, 0.05);
            overflow: hidden;
        }

        .editor-header {
            background-color: #f0fdf4;
            /* 薄いエメラルド */
            padding: 2rem;
            border-bottom: 1px solid var(--editor-border);
            text-align: center;
        }

        .contents-h1 {
            color: var(--editor-text);
            font-weight: 800;
            margin-bottom: 0;
            font-size: 1.5rem;
            letter-spacing: -0.02em;
        }

        .form-label {
            font-weight: 700;
            color: var(--editor-text);
            margin-bottom: 0.5rem;
            font-size: 0.9rem;
            display: flex;
            align-items: center;
        }

        .form-label i {
            color: var(--editor-primary);
            width: 20px;
            margin-right: 8px;
        }

        .form-control,
        .form-select {
            background-color: #f8fafc;
            border: 1.5px solid var(--editor-border);
            color: var(--editor-text);
            padding: 0.75rem 1rem;
            border-radius: 0.75rem;
            transition: all 0.2s;
        }

        .form-control:focus,
        .form-select:focus {
            background-color: #fff;
            border-color: var(--editor-primary);
            box-shadow: 0 0 0 4px rgba(16, 185, 129, 0.1);
        }

        /* 本文エリアの強調 */
        .body-textarea {
            font-size: 1rem;
            line-height: 1.8;
            min-height: 400px;
            background-color: #fff;
        }

        /* 【修正】Bootstrap標準のbtn-primaryと競合しないようカスタムボタンに変更 */
        .btn-editor-submit {
            background: linear-gradient(135deg, #10b981 0%, #059669 100%) !important;
            border: none !important;
            padding: 1rem;
            border-radius: 0.75rem;
            font-weight: 800;
            font-size: 1.1rem;
            color: #ffffff !important;
            transition: all 0.2s ease-in-out;
            box-shadow: 0 4px 6px -1px rgba(16, 185, 129, 0.2);
        }

        .btn-editor-submit:hover {
            filter: brightness(1.05);
            transform: translateY(-2px);
            box-shadow: 0 10px 15px -3px rgba(16, 185, 129, 0.3);
        }

        .form-text {
            color: var(--editor-secondary);
            font-size: 0.8rem;
            margin-top: 0.5rem;
        }

        .back-link {
            color: var(--editor-secondary);
            font-weight: 600;
            text-decoration: none;
            transition: 0.2s;
            display: inline-flex;
            align-items: center;
        }

        .back-link:hover {
            color: var(--editor-primary);
        }

        /* スマホ向けの余白調整 */
        @media (max-width: 576px) {
            .editor-header {
                padding: 1.5rem 1rem;
            }

            .contents-h1 {
                font-size: 1.25rem;
            }
        }
    </style>
@endpush

@section("content")
    <div class="editor-container">
        <div class="mb-4">
            <a href="{{ route("admin.dashboard") }}" class="back-link">
                <i class="fas fa-arrow-left me-2"></i>ダッシュボードへ戻る
            </a>
        </div>

        <div class="editor-card">
            <div class="editor-header">
                <h1 class="contents-h1"><i class="fas fa-pen-nib me-2 text-success"></i>新規ログ作成</h1>
                <p class="text-secondary small mb-0 mt-1">新しい副業実践記・レビューを公開しましょう</p>
            </div>

            @if ($errors->any())
                <div class="alert alert-danger mx-4 mt-4 border-0 shadow-sm" style="background-color: #fef2f2; color: #991b1b;">
                    <ul class="mb-0 fw-bold small" style="list-style: none; padding-left: 0;">
                        @foreach ($errors->all() as $error)
                            <li><i class="fas fa-exclamation-triangle me-2"></i>{{ $error }}</li>
                        @endforeach
                    </ul>
                </div>
            @endif

            <form action="{{ route("admin.contents.store") }}" method="POST" class="p-3 p-sm-4 p-md-5">
                @csrf

                {{-- タイトル --}}
                <div class="mb-4">
                    <label for="title" class="form-label"><i class="fas fa-heading"></i>タイトル</label>
                    <input type="text" id="title" name="title" class="form-control @error('title') is-invalid @enderror"
                        value="{{ old('title') }}" placeholder="記事のタイトルを入力" required>
                    @error('title')
                        <div class="invalid-feedback fw-bold">{{ $message }}</div>
                    @enderror
                </div>

                {{-- 公開ステータス設定 --}}
                <div class="mb-4">
                    <label for="status" class="form-label"><i class="fas fa-eye"></i>公開設定</label>
                    <select name="status" id="status" class="form-select @error('status') is-invalid @enderror" required>
                        <option value="published" {{ old('status') == 'published' ? 'selected' : '' }}>公開</option>
                        <option value="draft" {{ old('status') == 'draft' ? 'selected' : '' }}>非公開（下書き）</option>
                    </select>
                    @error('status')
                        <div class="invalid-feedback fw-bold">{{ $message }}</div>
                    @enderror
                </div>

                {{-- 説明（短い紹介文） --}}
                <div class="mb-4">
                    <label for="description" class="form-label"><i class="fas fa-align-left"></i>リード文（一覧に表示される短い紹介）</label>
                    <textarea id="description" name="description"
                        class="form-control @error('description') is-invalid @enderror" rows="2"
                        placeholder="読者の興味を引く2~3行の紹介文">{{ old('description') }}</textarea>
                    <div class="form-text">SNSでシェアされた際や、検索結果の概要としても利用されます。</div>
                </div>

                {{-- 本文 --}}
                <div class="mb-4">
                    <label for="body" class="form-label"><i class="fas fa-file-alt"></i>レビュー・感想（ブログ本文）</label>
                    <textarea id="body" name="body" class="form-control body-textarea @error('body') is-invalid @enderror"
                        placeholder="ここに熱いレビューや実践記録を書いてください。">{{ old('body') }}</textarea>
                    @error('body')
                        <div class="invalid-feedback fw-bold">{{ $message }}</div>
                    @enderror
                </div>

                {{-- 画像URL & アフィリエイトURL --}}
                <div class="row">
                    <div class="col-12 col-md-6 mb-4">
                        <label for="image_url" class="form-label"><i class="fas fa-image"></i>画像URL</label>
                        <input type="text" id="image_url" name="image_url" class="form-control"
                            value="{{ old('image_url') }}" placeholder="https://example.com/thumb.jpg">
                    </div>

                    <div class="col-12 col-md-6 mb-4">
                        <label for="content_url" class="form-label"><i class="fas fa-link"></i>アフィリエイトURL</label>
                        <input type="text" id="content_url" name="content_url" class="form-control"
                            value="{{ old('content_url') }}" placeholder="https://al.dmm.co.jp/...">
                    </div>
                </div>

                {{-- タグ --}}
                <div class="mb-5">
                    <label for="tag" class="form-label"><i class="fas fa-tags"></i>カテゴリータグ</label>
                    <input type="text" id="tag" name="tag" class="form-control" value="{{ old('tag') }}"
                        placeholder="例: ツール, 収益報告, Laravel">
                    <div class="form-text">カンマ（ , ）で区切って複数入力できます。</div>
                </div>

                {{-- 送信ボタン --}}
                <div class="d-grid">
                    <button type="submit" class="btn btn-editor-submit">
                        <i class="fas fa-save me-2"></i>保存する
                    </button>
                </div>
            </form>
        </div>
    </div>
@endsection