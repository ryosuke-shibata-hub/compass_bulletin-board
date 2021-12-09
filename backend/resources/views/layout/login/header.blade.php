@section('header')
<header class="header">
  <p>現在ログイン中のユーザー
    <span class="text-danger">{{ Auth::user()->username }}</span>
  </p>
  <a href="{{ route('logout') }}">ログアウト</a>
</header>
@endsection
