@extends('layout.login.common')
@section('title', '掲示板投稿ページ')
@include('layout.login.header')

@section('content')

<a href="{{ route('post.index') }}">戻る</a>

<form action="{{ route('post.store') }}" method="post">
  @csrf
  <label>カテゴリー</label>
  <select name="post_sub_category_id">
    <option value="">----</option>
    @foreach($post_main_categories as $post_main_category)
    <optgroup label="{{ $post_main_category->main_category }}">
      @foreach($post_main_category->postSubCategories as $post_sub_category)
      <option value="{{ $post_sub_category->id }}">
        {{ $post_sub_category->sub_category }}
      </option>
      @endforeach
    </optgroup>
    @endforeach
  </select>

  <label>タイトル</label>
  <input type="text" name='title'>

  <label>投稿内容</label>
  <input type="text" name='post'>
  <button type="submit">登録</button>
</form>

@endsection

@include('layout.login.footer')
