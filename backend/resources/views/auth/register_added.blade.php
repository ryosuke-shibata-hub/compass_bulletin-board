@extends('layout.logout.common')
@section('title', '登録完了ページ')
@include('layout.logout.header')

@section('content')

<p>登録ありがとうございます</p>
<a href="{{ route('login.form') }}">ログインページへ</a>

@endsection

@include('layout.logout.footer')
