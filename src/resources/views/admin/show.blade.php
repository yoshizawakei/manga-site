@extends('layouts.admin')

@section("css")
    <link rel="stylesheet" href="{{ asset('css/admin/dashboard.css') }}">
    <link rel="stylesheet" href="{{ asset('css/admin/inquiry-show.css') }}">
@endsection

@section("content")
    <div class="container">
        <div class="card">
            <h1 class="card-title">お問い合わせ詳細</h1>

            <div class="detail-group">
                <span class="detail-label">ID:</span>
                <span class="detail-value">{{ $inquiry->id }}</span>
            </div>

            <div class="detail-group">
                <span class="detail-label">氏名:</span>
                <span class="detail-value">{{ $inquiry->name }}</span>
            </div>

            <div class="detail-group">
                <span class="detail-label">メールアドレス:</span>
                <span class="detail-value">{{ $inquiry->email }}</span>
            </div>

            <div class="detail-group">
                <span class="detail-label">件名:</span>
                <span class="detail-value">{{ $inquiry->subject ?? '件名なし' }}</span>
            </div>

            <div class="detail-group">
                <span class="detail-label">お問い合わせ内容:</span>
                <div class="detail-message">
                    {{ $inquiry->message }}
                </div>
            </div>

            <div class="detail-group">
                <span class="detail-label">受信日時:</span>
                <span class="detail-value">{{ $inquiry->created_at->format('Y/m/d H:i') }}</span>
            </div>
        </div>
    </div>
@endsection