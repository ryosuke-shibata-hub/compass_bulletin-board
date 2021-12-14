@extends('layouts.logout.common')
@section('title','ユーザー登録ページ')
@include('layouts.logout.header')
@section('contents')

<a href="{{ route('login') }}">戻る</a>

<form action="{{ route('register') }}" method="post">
  @csrf
    <label>ユーザー名</label>
    <input type="text" name="username">
    <label>メールアドレス</label>
    <input type="email" name="email">
    <label>パスワード</label>
    <input type="password" name="password">
    <label>パスワード確認</label>
    <input type="password" name="passwordConfirm">
    <button type="submit">登録</button>
</form>

@endsection
@include('layouts.logout.footer')
