@extends('dashboard')

@section('content')
   
    

    <div class="container">
        <h2>Màn hình đăng nhập</h2>
        <form method="POST" action="{{ route('user.authUser') }}">
            @csrf
            <div class="form-group mb-3">
                <input type="text" placeholder="Email" id="email" class="form-control" name="email" required autofocus>
                @if ($errors->has('email'))
                    <span class="text-danger">{{ $errors->first('email') }}</span>
                @endif
            </div>
            <div class="form-group mb-3">
                <input type="password" placeholder="Password" id="password" class="form-control" name="password" required>
                @if ($errors->has('password'))
                    <span class="text-danger">{{ $errors->first('password') }}</span>
                @endif
            </div>
            <div class="checkbox">
                <input type="checkbox"> Ghi nhớ đăng nhập
            </div>
            <div class="forgot">
                <a href="#">Quên mật khẩu</a>
            </div>
            <div class="d-grid mx-auto">
                <button type="submit" class="btn btn-dark btn-block">Đăng nhập</button>
            </div>
        </form>
    </div>

    <div class="footer">
        Lập trình web @01/2024
    </div>
@endsection