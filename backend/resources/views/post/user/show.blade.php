@extends('layout.login.common')
@section('title', '投稿詳細ページ')
@include('layout.login.header')

@section('content')

<a href="{{ route('post.index') }}">戻る</a>

<ul>
  <li>{{ $post_detail->user->username }}</li>
  <li>{{ $post_detail->event_at }}</li>
  <li>view{{ $post_detail->actionLogs->count() }}</li>
  <li>{{ $post_detail->title }}</li>
  <li>{{ $post_detail->post }}</li>
  <li>{{ $post_detail->postSubCategory->sub_category }}</li>
  <li>コメント数{{ $post_detail->postComments->count() }}</li>

  <li>
    @if ($post_detail->postFavoriteIsExistence($post_detail))
    <a class="post_favorite_key" post_id="{{ $post_detail->id }}" post_favorite_id="0"
      style="color:#FF0000; text-decoration: none;">
      <i class="far fa-heart"></i>
    </a>
    @else
    <a class="post_favorite_key" post_id="{{ $post_detail->id }}" post_favorite_id="1"
      style="color:#FF0000; text-decoration: none;">
      <i class="fas fa-heart"></i>
    </a>
    @endif
  </li>

  <li>いいね数
    <span id="post_favorite_count{{ $post_detail->id }}">
      {{ $post_detail->userPostFavoriteRelations->count() }}
    </span>
  </li>

  @if (Auth::user()->contributorAndAdmin($post_detail->user_id))
  <li><a href="{{ route('post.edit', [$post_detail->id]) }}">投稿の編集</a></li>
  @endif
</ul>
<hr>

<form action="{{ route('post_comment.store',[$post_detail->id]) }}" method="post">
  @csrf
  <input type="text" name="comment">
  <button type="submit">コメント登録</button>
</form>
<hr>

@foreach ($post_detail->postComments as $post_comment)
<p>{{ $post_comment->user->username }}</p>
<p>{{ $post_comment->comment }}</p>
<p>{{ $post_comment->event_at }}</p>
<p class="text-danger">いいね数○○</p>
@if (Auth::user()->contributorAndAdmin($post_comment->user_id))
<a href="{{ route('post_comment.edit', [$post_comment->id]) }}">コメントの編集</a>
@endif
<hr>
@endforeach

@endsection

@include('layout.login.footer')
