<!-- resources/views/customers/create.blade.php -->
<!DOCTYPE html>
<html lang="vi">
<head>
    <meta charset="UTF-8">
    <title>Thêm khách hàng</title>
    <style>
        body { font-family: Arial, sans-serif; margin: 20px; }
        .container { max-width: 600px; margin: 0 auto; border: 1px solid #ccc; padding: 20px; }
        h2 { text-align: center; }
        label { font-weight: bold; display: block; margin-top: 15px; }
        input[type="text"], input[type="email"] {
            width: 100%; padding: 8px; margin-top: 5px; border: 1px solid #aaa; border-radius: 4px;
        }
        button, .back-btn {
            margin-top: 20px; padding: 10px 20px; border: none;
            background-color: #f2f2f2; border: 1px solid #aaa; cursor: pointer;
        }
        .footer { text-align: center; margin-top: 30px; color: gray; font-style: italic; }
    </style>
</head>
<body>
    <div class="container">
        <a href="{{ route('customers.index') }}" class="back-btn"><-- Quay lại</a>
        <h2>Thêm khách hàng</h2>
        <form action="{{ route('customers.store') }}" method="POST">
    @csrf

    {{-- Hiển thị lỗi --}}
    @if ($errors->any())
        <div style="color: red;">
            <ul>
                @foreach ($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
    @endif

    <label for="name">Tên khách hàng</label>
    <input type="text" name="name" id="name" value="{{ old('name') }}" required>

    <label for="phone">Số điện thoại</label>
    <input type="text" name="phone" id="phone" value="{{ old('phone') }}">

    <label for="email">Thông tin Email</label>
    <input type="email" name="email" id="email" value="{{ old('email') }}">

    <label for="address">Địa chỉ</label>
    <input type="text" name="address" id="address" value="{{ old('address') }}">

    <button type="submit">Thêm</button>
</form>

        
    </div>
</body>
</html>
