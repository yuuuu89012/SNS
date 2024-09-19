
<!--@extends('layouts.app')-->

<link rel="stylesheet" href="{{ asset('loginstyle.css') }}">
<link rel="preconnect" href="https://fonts.googleapis.com">
<link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
<link href="https://fonts.googleapis.com/css2?family=Raleway:ital@0;1&family=Zen+Kaku+Gothic+New&display=swap" rel="stylesheet">

<body>
@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="logo">
                <img src="{{ asset('logo.png') }}" width="150" height="150" alt="Logo">
            </div><!--ロゴの挿入-->
            <div class="card">
                <div class="card-body">
                    <form id="login-form" class="login" method="POST" action="{{ route('login') }}">
                        @csrf

                        <div class="row mb-3">
                            <label for="email" class="col-md-4 col-form-label text-md-end">{{ __('E-mail') }}</label>

                            <div class="col-md-6">
                                <input id="email" type="email" class="form-control @error('email') is-invalid @enderror" name="email" value="{{ old('email') }}" required autocomplete="email" autofocus>

                                @error('email')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                        </div>

                        <div class="row mb-3 pass">
                            <label for="password" class="col-md-4 col-form-label text-md-end">{{ __('Password') }}</label>

                            <div class="col-md-6">
                                <input id="password" type="password" class="form-control @error('password') is-invalid @enderror" name="password" required autocomplete="current-password">

                                @error('password')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                        </div>

                        <div class="row mb-0">
                            <div class="col-md-8 offset-md-4">
                               @if (Route::has('password.request'))
                                    <a class="btn btn-link forgot" href="{{ route('password.request') }}">
                                        {{ __('パスワードをお忘れの場合') }}
                                    </a>
                                @endif
                                <br>
                                <!--<br><button type="submit" class="btn btn-primary">
                                    {{ __('Login') }}
                                </button>
                                <div class="log-button">
                                    @if (Route::has('home'))
                                        <li class="nav-item">
                                            <a class="nav-link" href="{{ route('home') }}">{{ __('Login →') }}</a>
                                        </li>
                                    @endif
                                </div>ホームに行かない！-->
                                <div class="log-button">
                                <a href="#" class="btn btn-primary" onclick="document.getElementById('login-form').submit(); return false;">
                                    {{ __('Login →') }}
                                </a>
                                </div><!--上のコメントアウトしてるボタンと同じ機能？-->
                            </div>
                        </div>
                    </form>
                </div>
                <div class="signin">
                    <div class="signin-text">
                        <p class="sign-p1">はじめてご利用の方</p>
                        <p class="sign-p2">ご利用には新規登録が必要です</p>
                    </div>
                    <div class="sign-button">
                        @if (Route::has('register'))
                            <li class="nav-item">
                                <a class="nav-link" href="{{ route('register') }}">{{ __('Sing up →') }}</a>
                            </li>
                        @endif
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection

</body>