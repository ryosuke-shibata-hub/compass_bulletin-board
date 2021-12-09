<!DOCTYPE html>
<html lang="ja">

<head>
  <meta charset="utf-8">
  <title>@yield('title')</title>
  {{-- Bootstrap css CDN --}}
  <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css"
    integrity="sha384-ggOyR0iXCbMQv3Xipma34MD+dH/1fQ784/j6cY/iJTQUOhcWr7x9JvoRxT2MZw1T" crossorigin="anonymous">
  {{-- css --}}
  <link rel="stylesheet" href="{{ asset('/css/logout.css') }}">
</head>

<body>
  @yield('header')

  <div class="contents">
    <div class="main">
      @yield('content')
    </div>
  </div>

  @yield('footer')
</body>

</html>
