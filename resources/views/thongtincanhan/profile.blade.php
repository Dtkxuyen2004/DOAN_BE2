<!DOCTYPE html>
<html lang="vi">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Thông Tin Cá Nhân</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body>
    <div class="container mt-5">
        <!-- Quay lại trang dashboard -->
        <a href="{{ url('/dashboard') }}" class="btn btn-secondary mb-3">&larr; Quay Lại</a>
        
        <h2>Thông Tin Cá Nhân</h2>

        <!-- Hiển thị thông báo cập nhật -->
        @if (session('message'))
            <div class="alert alert-success">{{ session('message') }}</div>
        @endif

        <div class="card">
            <div class="card-body">
                <h5 class="card-title">Xin chào, {{ $userName }}!</h5>
                <p class="card-text"><strong>Email:</strong> {{ $userEmail }}</p>
                <p class="card-text"><strong>Số điện thoại:</strong> {{ $userPhone }}</p>

                <!-- Form cập nhật thông tin -->
                <form action="{{ route('profile.update') }}" method="POST">
                    @csrf
                    <div class="mb-3">
                        <label class="form-label">Thay đổi email</label>
                        <input type="email" name="userEmail" class="form-control" 
                               value="{{ old('userEmail', $userEmail) }}" required>
                    </div>
                    <div class="mb-3">
                        <label class="form-label">Thay đổi số điện thoại</label>
                        <input type="text" name="userPhone" class="form-control" 
                               value="{{ old('userPhone', $userPhone) }}">
                    </div>
                    <button type="submit" class="btn btn-primary">Cập nhật thông tin</button>
                </form>

                <!-- Nút đăng xuất -->
                <a href="{{ route('logout') }}" 
                   onclick="event.preventDefault(); document.getElementById('logout-form').submit();" 
                   class="btn btn-danger mt-3">Đăng xuất</a>

                <form id="logout-form" action="{{ route('logout') }}" method="POST" class="d-none">
                    @csrf
                </form>
            </div>
        </div>
    </div>
</body>
</html>
