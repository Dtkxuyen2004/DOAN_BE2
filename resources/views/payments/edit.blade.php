@extends('layouts.app')

@section('content')
<div class="container">
    <h2>Chỉnh sửa thanh toán</h2>

    <form action="{{ route('payments.update', $payment->id) }}" method="POST">
        @csrf
        @method('PUT')

        <div class="mb-3">
            <label for="customer_id" class="form-label">Khách hàng</label>
            <select name="customer_id" id="customer_id" class="form-control">
                @foreach ($customers as $customer)
                    <option value="{{ $customer->id }}" {{ $payment->customer_id == $customer->id ? 'selected' : '' }}>
                        {{ $customer->name }}
                    </option>
                @endforeach
            </select>
        </div>

        <div class="mb-3">
            <label for="services" class="form-label">Dịch vụ</label>
            @foreach ($payment->services as $service)
                <input type="text" name="services[]" value="{{ $service }}" class="form-control mb-2">
            @endforeach
            <input type="text" name="services[]" class="form-control" placeholder="Thêm dịch vụ">
        </div>

        <div class="mb-3">
            <label for="staffs" class="form-label">Nhân viên</label>
            @foreach ($payment->staffs as $staff)
                <input type="text" name="staffs[]" value="{{ $staff }}" class="form-control mb-2">
            @endforeach
            <input type="text" name="staffs[]" class="form-control" placeholder="Thêm nhân viên">
        </div>

        <div class="mb-3">
            <label for="total_amount" class="form-label">Tổng tiền</label>
            <input type="number" name="total_amount" value="{{ $payment->total_amount }}" class="form-control">
        </div>

        <div class="mb-3">
            <label for="payment_method" class="form-label">Hình thức thanh toán</label>
            <input type="text" name="payment_method" value="{{ $payment->payment_method }}" class="form-control">
        </div>

        <button type="submit" class="btn btn-primary">Cập nhật</button>
        <a href="{{ route('payments.index') }}" class="btn btn-secondary">Quay lại</a>
    </form>
</div>
@endsection
