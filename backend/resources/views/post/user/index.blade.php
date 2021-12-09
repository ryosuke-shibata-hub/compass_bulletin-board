@extends('layout.login.common')
@section('title', '投稿一覧ページ')
@include('layout.login.header')

@section('content')

@can('admin')
<p><a href="{{ route('post_category.index') }}">カテゴリーを追加</a></p>
@endcan

<p><a href="{{ route('post.create') }}">投稿</a></p>


<p>
  <label>カテゴリー</label>
  <select id="post_sub_category_change" name="post_sub_category_id">
    <option value="">----</option>
    @foreach($post_main_categories as $post_main_category)
    <optgroup label="{{ $post_main_category->main_category }}">
      @foreach($post_main_category->postSubCategories as $postSubCategory)
      <option value="{{ $postSubCategory->id }}" data-category_id="{{ $postSubCategory->id }}">
        {{$postSubCategory->sub_category }}
      </option>
      @endforeach
    </optgroup>
    @endforeach
  </select>
</p>

<form action="{{ route('post.index') }}" method="get">
  <input type="text" name="keyword">
  <button type="submit">検索</button>
</form>

<form action="{{ route('post.index') }}" method="get">
  <button type="submit" name="post_favorite" value="post_favorite">いいねした投稿</button>
  <button type="submit" name="my_post" value="my_post">自分の投稿</button>
</form>


@foreach ($post_lists as $post_list)
<ul>
  <li>{{ $post_list->user->username }}さん</li>
  <li>{{ $post_list->event_at }}</li>
  <li>view{{ $post_list->actionLogs->count() }}</li>
  <li>{{ $post_list->title }}</li>
  <li>{{ $post_list->postSubCategory->sub_category }}</li>
  <li>コメント数{{ $post_list->postComments->count() }}</li>
  <li class="text-danger">いいね数○○</li>
  <li><a href="{{ route('post.show' ,[$post_list->id]) }}">詳細ページへ</a></li>
</ul>
<hr>
@endforeach

@endsection

@include('layout.login.footer')
