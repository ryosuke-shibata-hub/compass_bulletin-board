@extends('layout.login.common')
@section('title', '投稿編集ページ')
@include('layout.login.header')

@section('content')

<a href="{{ route('post.show', [$post_detail->id]) }}">戻る</a>

<form action="{{ route('post.update', [$post_detail->id]) }}" method="post">
  @method('PUT')
  @csrf
  <label>カテゴリー</label>
  <select name="post_sub_category_id">
    <option value="">----</option>
    @foreach($post_main_categories as $post_main_category)
    <optgroup label="{{ $post_main_category->main_category }}">
      @foreach($post_main_category->postSubCategories as $post_sub_category)
      <option value="{{ $post_sub_category->id }}" @if(old('post_sub_category_id', $post_sub_category->
        id==$post_detail->post_sub_category_id)) selected @endif>
        {{ $post_sub_category->sub_category }}
      </option>
      @endforeach
    </optgroup>
    @endforeach
  </select>

  <label>タイトル</label>
  <input type="text" name='title' value="{{ $post_detail->title }}">

  <label>投稿内容</label>
  <input type="text" name='post' value="{{ $post_detail->post }}">
  <button type="submit">編集</button>

</form>

@if ($post_detail->postCommentIsExistence($post_detail))
<form action="{{ route('post.destroy', [$post_detail->id]) }}" method="post">
  @method('DELETE')
  @csrf
  <button type="submit">削除</button>
</form>
@endif

@endsection

@include('layout.login.footer')
