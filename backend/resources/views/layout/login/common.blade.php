<!DOCTYPE html>
<html lang="ja">

<head>
  <meta charset="utf-8">
  <meta name="csrf-token" content="{{ csrf_token() }}">
  <title>@yield('title')</title>
  {{-- Bootstrap css CDN --}}
  <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css"
    integrity="sha384-ggOyR0iXCbMQv3Xipma34MD+dH/1fQ784/j6cY/iJTQUOhcWr7x9JvoRxT2MZw1T" crossorigin="anonymous">
  {{-- css --}}
  <link rel="stylesheet" href="{{ asset('/css/login.css') }}">
  {{-- Font Awesome --}}
  <link href="https://use.fontawesome.com/releases/v5.6.1/css/all.css" rel="stylesheet">
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
