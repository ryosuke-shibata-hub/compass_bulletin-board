@extends('layouts.login.common')
@section('title','トップページ')
@include('layouts.login.header')
@section('contents')
メインかてごりー
<a href="{{ route('userPostIndex') }}">戻る</a>

@endsection
@include('layouts.login.footer')
