@extends('layouts.login.common')
@section('title', '投稿詳細')
@include('layouts.login.header')
@section('contents')

<p>
  <a href="{{ route('userPostIndex') }}">トップページへ</a>
</p>
<p>
  @if(Auth::user()->contributorAndAdmin($posts_detail->user_id))
  <a href="{{ route('post.edit',[$posts_detail->id]) }}">編集</a>
  @endif
</p>
<ul>
  <li>{{ $posts_detail->user->username }}</li>
  <li>{{ $posts_detail->event_at }}</li>
  <li class="text-danger">閲覧数:12</li>
  <li>{{ $posts_detail->title }}</li>
  <li>{{ $posts_detail->postSubCategory->sub_category }}</li>
  <li class="text-danger">コメント数:23</li>
  <li class="text-danger">いいね数:66</li>
</ul>
<Form action="{{ route('post_comment_store',[$posts_detail->id]) }}" method="post">
  @csrf
  <input type="text" name="post_comment">
  <button type="submit">コメントする</button>
</Form>

@foreach($posts_detail->postComments as $postComment)
  <p>{{ $postComment->user->username }}</p>
  <p>{{ $postComment->comment }}</p>
  <p>{{ $postComment->event_at }}</p>
  <p class="text-danger">いいね数22</p>
  @if (Auth::user()->contributorAndAdmin($postComment->user_id))
        <a href="{{ route('post_comment.edit',[$postComment->id]) }}">
        コメントの編集</a>
  @endif
@endforeach

@endsection
@include('layouts.login.footer')
