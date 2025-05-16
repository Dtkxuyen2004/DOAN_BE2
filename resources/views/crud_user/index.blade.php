<!DOCTYPE html>
<html lang="vi">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Trang chủ</title>
    <link rel="stylesheet" href="css/style.css">
</head>
<body>
<div class="menu">
@guest
        <a href="{{ route('index') }}">Home</a> |
        <a href="{{ route('login') }}"><b>Đăng nhập</b></a> |
        <a href="{{ route('user.createUser') }}">Đăng ký</a>
        @else
        <a href="{{ route('signout') }}">Logout</a>
        @endguest
    </div>
    <h1>Chào mừng bạn đến với trang web    </h1>

    <div class="footer">
        Lập trình web @01/2024 
    </div>
</body>
</html>
