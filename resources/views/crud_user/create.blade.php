@extends('layouts.app')

@section('content')
<div class="container mt-5">
    <div class="row justify-content-center">
        <div class="col-md-6">
            <div class="card shadow">
                <div class="card-header text-center">
                    <h4>Đăng Ký</h4>
                </div>
                <div class="card-body">
                    <!-- Hiển thị lỗi nếu có -->
                    @if ($errors->any())
                        <div class="alert alert-danger">
                            <ul class="mb-0">
                                @foreach ($errors->all() as $error)
                                    <li>{{ $error }}</li>
                                @endforeach
                            </ul>
                        </div>
                    @endif

                    <!-- Hiển thị thông báo thành công nếu có -->
                    @if (session('success'))
                        <div class="alert alert-success text-center">
                            {{ session('success') }}
                        </div>
                    @endif

                    <!-- Form đăng ký -->
                    <form method="POST" action="{{ route('user.postUser') }}">
                        @csrf
                        <div class="mb-3">
                            <label for="username" class="form-label">Tên đăng nhập</label>
                            <input type="text" name="username" id="username" class="form-control" value="{{ old('username') }}" required>
                        </div>
                        <div class="mb-3">
                            <label for="full_name" class="form-label">Họ và tên</label>
                            <input type="text" name="full_name" id="full_name" class="form-control" value="{{ old('full_name') }}" required>
                        </div>
                        <div class="mb-3">
                            <label for="email" class="form-label">Email</label>
                            <input type="email" name="email" id="email" class="form-control" value="{{ old('email') }}" required>
                        </div>
                        <div class="mb-3">
                            <label for="phone" class="form-label">Số điện thoại</label>
                            <input type="text" name="phone" id="phone" class="form-control" value="{{ old('phone') }}" required>
                        </div>
                        <div class="mb-3">
                            <label for="password" class="form-label">Mật khẩu</label>
                            <div class="input-group">
                                <input type="password" name="password" id="password" class="form-control" required>
                                <button type="button" class="btn btn-outline-secondary" id="togglePassword">
                                    Hiển thị
                                </button>
                            </div>
                        </div>
                        <div class="mb-3">
                            <label for="confirm_password" class="form-label">Xác nhận mật khẩu</label>
                            <input type="password" name="confirm_password" id="confirm_password" class="form-control" required>
                        </div>
                        <div class="text-center">
                            <button type="submit" class="btn btn-primary w-100">Đăng ký</button>
                        </div>
                        <div class="text-center mt-3">
                            <small>
                                Quay lại trang 
                                <a href="{{ route('login') }}" class="text-decoration-none" style="color: #00564e;">Đăng Nhập</a>
                            </small>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection

@section('styles')
<style>
    body {
        background-color: #f8f9fa;
    }

    .card-header {
        background-color: #00564e;
        color: white;
    }

    .btn-primary {
        background-color: #00564e;
        border-color: #00564e;
    }

    .btn-primary:hover {
        background-color: #004d46;
        border-color: #004d46;
    }

    .btn-outline-secondary {
        color: #00564e;
        border-color: #00564e;
    }

    .btn-outline-secondary:hover {
        background-color: #00564e;
        color: white;
    }

    .alert-success {
        background-color: #d4edda;
        color: #155724;
        border-color: #c3e6cb;
    }

    .alert-danger {
        background-color: #f8d7da;
        color: #721c24;
        border-color: #f5c6cb;
    }
</style>
@endsection

@section('scripts')
<script>
    // Tính năng hiển thị mật khẩu
    document.getElementById('togglePassword').addEventListener('click', function () {
        const passwordField = document.getElementById('password');
        const isPasswordHidden = passwordField.type === 'password';

        // Chuyển đổi thuộc tính type
        passwordField.type = isPasswordHidden ? 'text' : 'password';

        // Thay đổi text của nút
        this.textContent = isPasswordHidden ? 'Ẩn' : 'Hiển thị';
    });

    // Kiểm tra định dạng số điện thoại
    document.getElementById('phone').addEventListener('input', function (e) {
        let value = e.target.value;
        // Chỉ cho phép nhập số
        e.target.value = value.replace(/[^0-9]/g, '');
    });
</script>
@endsection