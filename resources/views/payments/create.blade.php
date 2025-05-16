@extends('layouts.app')

@section('content')
<div class="container">
    <h2 class="mb-4">Tạo thanh toán mới</h2>

    @if($errors->any())
        <div class="alert alert-danger">
            <ul class="mb-0">
                @foreach($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
    @endif

    <form action="{{ route('payments.store') }}" method="POST">
        @csrf

        <div class="mb-3">
            <label for="customer_id" class="form-label">Khách hàng</label>
            <select name="customer_id" id="customer_id" class="form-select" required>
                <option value="">-- Chọn khách hàng --</option>
                @foreach($customers as $customer)
                    <option value="{{ $customer->id }}">{{ $customer->name }}</option>
                @endforeach
            </select>
        </div>

        <div class="mb-3">
            <label for="services" class="form-label">Dịch vụ</label>
            <input type="text" name="services[]" class="form-control" placeholder="Nhập dịch vụ..." required>
        </div>

        <div class="mb-3">
            <label for="staffs" class="form-label">Nhân viên</label>
            <input type="text" name="staffs[]" class="form-control" placeholder="Tên nhân viên..." required>
        </div>

        <div class="mb-3">
            <label for="total_amount" class="form-label">Tổng tiền</label>
            <input type="number" name="total_amount" class="form-control" placeholder="Nhập số tiền..." required>
        </div>

        <div class="mb-3">
            <label for="payment_method" class="form-label">Hình thức thanh toán</label>
            <select name="payment_method" class="form-select" required>
                <option value="">-- Chọn hình thức --</option>
                <option value="Tiền mặt">Tiền mặt</option>
                <option value="Chuyển khoản">Chuyển khoản</option>
                <option value="Thẻ">Thẻ</option>
            </select>
        </div>

        <button type="submit" class="btn btn-primary">Lưu thanh toán</button>
        <a href="{{ route('payments.index') }}" class="btn btn-secondary">Quay lại</a>
    </form>
</div>
@endsection
