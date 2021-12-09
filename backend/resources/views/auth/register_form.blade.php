@extends('layout.logout.common')
@section('title', 'ユーザー登録ページ')
@include('layout.logout.header')

@section('content')

<a href="{{ route('login.form') }}">戻る</a>

<form action="{{ route('register') }}" method="post">
  @csrf
  <label>ユーザー名</label>
  <input type="text" name="username" value="{{ old('username') }}">
  @if($errors->has('username'))
  <span class="text-danger">{{ $errors->first('username') }}</span>
  @endif

  <label>メールアドレス</label>
  <input type="email" name="email" value="{{ old('email') }}">
  @if($errors->has('email'))
  <span class="text-danger">{{ $errors->first('email') }}</span>
  @endif

  <label>パスワード</label>
  <input type="password" name="password">
  @if($errors->has('password'))
  <span class="text-danger">{{ $errors->first('password') }}</span>
  @endif

  <label>パスワード確認用</label>
  <input type="password" name="password_confirmation">

  <button type="submit">登録</button>
</form>

@endsection

@include('layout.logout.footer')
