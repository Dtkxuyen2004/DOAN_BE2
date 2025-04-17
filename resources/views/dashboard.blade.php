<!DOCTYPE html>
<html>
<head>
    <title>Laravel 10.48.0 - CRUD User Example</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0-beta3/dist/css/bootstrap.min.css" rel="stylesheet">
    <link href="{{ asset('css/style.css') }}" rel="stylesheet">
    <script type="text/javascript" src="{{ asset('js/scripts.js') }}"></script>
</head>
<body>

<div class="menu">
@guest
        <a href="{{ route('index') }}">Home</a> |
        <a href="{{ route('login') }}"><b>Đăng nhập</b></a> |
        <a href="{{ route('user.createUser') }}">Đăng ký</a>
        @else
        <a href="{{ route('index') }}">Home</a>|
        <a href="{{ route('signout') }}">Đăng Xuất</a>
        
        @endguest
    </div>

@yield('content')
</body>
</html>
