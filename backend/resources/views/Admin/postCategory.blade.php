@extends('layouts.login.common')
@section('title','トップページ')
@include('layouts.login.header')
@section('contents')

<a href="{{ route('userPostIndex') }}">戻る</a>

<Form action="{{ route('post_main_category.store') }}" method="post">
  @csrf
  <label>新規メインカテゴリー</label>
  <input type="text" name="main_category">
  <button type="submit">登録</button>
</Form>

<Form action="{{ route('post_sub_category.store') }}" method="post">
  @csrf
    <label>メインカテゴリー</label>
    <select name="post_main_category_id">
      <option value="">-----</option>
        @foreach($post_main_categories as $post_maincategory)
          <option value="{{ $post_maincategory->id }}">
            {{ $post_maincategory->main_category }}
          </option>
        @endforeach
    </select>

    <label>新規サブカテゴリー追加</label>
    <input type="text" name="sub_category">
    <button type="submit">登録</button>
</Form>

<p>カテゴリー一覧</p>
<ul>
  @foreach($post_main_categories as $post_main_category)
  <li>{{ $post_main_category->main_category }}</li>
    <ul>
      @foreach($post_main_category->postSubCategory as $post_sub_category)
      <li>{{ $post_sub_category->sub_category }}</li>
      <Form name="postSubCategoryDestroy{{ $post_sub_category->id }}"
        action="{{ route('post_sub_category.destroy',[$post_sub_category->id])}}"      method="post">
        @method('delete')
        @csrf
        <a href="javascript:post_sub_category_delete{{ $post_sub_category->id }}.submit()">サブカテゴリー削除</a>
      </Form>
      @endforeach
    </ul>
  @endforeach
  </ul>
@endsection
@include('layouts.login.footer')
