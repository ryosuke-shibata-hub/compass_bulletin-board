@extends('layouts.login.common')
@section('title','トップページ')
@include('layouts.login.header')
@section('contents')

<p>
  <a href="{{ route('logout') }}">ログアウト</a>
</p>
@can('admin')
<p><a href="{{ route('postCategory.index') }}">カテゴリーを追加</a></p>
@endcan
<p><a href="{{ route('post.create') }}">投稿</a></p>

@foreach($posts_lists as $post_list)
  <ul>
    <li>{{ $post_list->user->username }}</li>
    <li>{{ $post_list->event_at }}</li>
    <li class="text-danger">10view</li>
    <li>{{ $post_list->title }}</li>
    <li>{{ $post_list->postSubCategory->sub_category }}</li>
    <li class="text-danger">いいね数</li>
    <li class="text-danger">コメント数</li>
    <li><a href="{{ route('post_show',[$post_list->id]) }}">
    詳細ページ</a></li>
  </ul>
@endforeach
@endsection
@include('layouts.login.footer')
