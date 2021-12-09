@extends('layout.login.common')
@section('title', '投稿一覧ページ')
@include('layout.login.header')

@section('content')

<a href="{{ route('post.index') }}">戻る</a>

<form action="{{ route('post_main_category.store') }}" method="post">
  @csrf
  <label>新規メインカテゴリー</label>
  <input type="text" name="main_category">
  <button type="submit">登録</button>
</form>

<form action="{{ route('post_sub_category.store') }}" method="post">
  @csrf
  <label>メインカテゴリー</label>
  <select name="post_main_category_id">
    <option value="">-----</option>
    @foreach ($post_main_categories as $post_main_category)
    <option value="{{ $post_main_category->id }}">
      {{ $post_main_category->main_category }}
    </option>
    @endforeach
  </select>

  <label>新規サブカテゴリー</label>
  <input type="text" name="sub_category">
  <button type="submit">登録</button>
</form>

<p>カテゴリー一覧</p>
<ul>
  @foreach ($post_main_categories as $post_main_category)
  <li>{{ $post_main_category->main_category }}
    @if ($post_main_category->postSubCategoryIsExistence($post_main_category))
    <form name="post_main_category_delete{{ $post_main_category->id }}"
      action="{{ route('post_main_category.destroy', [$post_main_category->id]) }}" method="post">
      @method('DELETE')
      @csrf
      <a href="javascript:post_main_category_delete{{ $post_main_category->id }}.submit()">メインカテゴリー削除</a>
    </form>
    @endif
    <ul>
      @foreach ($post_main_category->postSubCategories as $post_sub_category)
      <li>{{ $post_sub_category->sub_category }}</li>
      @if ($post_sub_category->postIsExistence($post_sub_category))
      <form name="post_sub_category_delete{{ $post_sub_category->id }}"
        action="{{ route('post_sub_category.destroy', [$post_sub_category->id]) }}" method="post">
        @method('DELETE')
        @csrf
        <a href="javascript:post_sub_category_delete{{ $post_sub_category->id }}.submit()">サブカテゴリー削除</a>
      </form>
      @endif
      @endforeach
    </ul>
  </li>
  <hr>
  @endforeach
</ul>

@endsection

@include('layout.login.footer')
