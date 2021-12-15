@extends('layouts.login.common')
@section('title','トップページ')
@include('layouts.login.header')
@section('contents')

<p>
  <a href="{{ route('logout') }}">ログアウト</a>
</p>
@can('admin')
<p><a href="{{ route('postMainCategory') }}">カテゴリーを追加</a></p>
@endcan

@endsection
@include('layouts.login.footer')
