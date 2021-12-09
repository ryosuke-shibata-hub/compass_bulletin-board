@extends('layout.logout.common')
@section('title', 'ログインページ')
@include('layout.logout.header')

@section('content')

@if(session('login_error'))
<span class="text-danger">{{ session('login_error') }}</span>
@endif

<form action="{{ route('login') }}" method="post">
  @csrf
  <label for="">メールアドレス</label>
  <input type="email" name="email">
  <label for="">パスワード</label>
  <input type="password" name="password">
  <button type="submit">ログイン</button>
</form>

<p>新規ユーザー登録は
  <span><a href="{{ route('register.form') }}">こちら</a></span>
</p>

@endsection

@include('layout.logout.footer')
