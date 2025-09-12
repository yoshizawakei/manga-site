@extends('layouts.admin')

@section('content')
    <div class="main-content-container">
        <h2>お問い合わせ</h2>
        @if(session('success'))
            <div class="alert alert-success">
                {{ session('success') }}
            </div>
        @endif
        <p>当サイトに関するご質問、ご意見、ご要望は、下記のフォームよりお気軽にご連絡ください。</p>

        <form action="{{ route("top.submitContact") }}" method="POST" class="contact-form">
            @csrf
            <div class="form-group">
                <label for="name">お名前<span class="required">（必須）</span></label>
                <input type="text" id="name" name="name" value="{{ old('name') }}" required>
                @error('name')
                    <span class="error-message">{{ $message }}</span>
                @enderror
            </div>
            <div class="form-group">
                <label for="email">メールアドレス<span class="required">（必須）</span></label>
                <input type="email" id="email" name="email" value="{{ old('email') }}" required>
                @error('email')
                    <span class="error-message">{{ $message }}</span>
                @enderror
            </div>
            <div class="form-group">
                <label for="subject">件名</label>
                <input type="text" id="subject" name="subject" value="{{ old('subject') }}">
                @error('subject')
                    <span class="error-message">{{ $message }}</span>
                @enderror
            </div>
            <div class="form-group">
                <label for="message">お問い合わせ内容<span class="required">（必須）</span></label>
                <textarea id="message" name="message" rows="8" required>{{ old('message') }}</textarea>
                @error('message')
                    <span class="error-message">{{ $message }}</span>
                @enderror
            </div>
            <button type="submit" class="submit-button">送信する</button>
        </form>
    </div>
@endsection