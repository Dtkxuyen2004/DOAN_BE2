@extends('layouts.app') {{-- Giả sử bạn có layout sẵn --}}

@section('content')
<div class="container mt-4">
    <div class="p-4 bg-white shadow rounded">
        <form action="{{ route('booking.store') }}" method="POST">
            @csrf

            <div class="row mb-3">
                <div class="col">
                    <label>Tên</label>
                    <input type="text" name="name" class="form-control" placeholder="Nhập tên">
                </div>
                <div class="col">
                    <label>Email</label>
                    <input type="email" name="email" class="form-control" placeholder="Nhập email">
                </div>
            </div>

            <div class="row mb-3">
                <div class="col">
                    <label>Số điện thoại</label>
                    <input type="text" name="phone" class="form-control" placeholder="Nhập số điện thoại">
                </div>
                <div class="col">
                    <label>Địa chỉ</label>
                    <input type="text" name="address" class="form-control" placeholder="Nhập địa chỉ">
                </div>
            </div>

            <div class="row mb-3">
                <div class="col">
                    <label>Ngày đặt lịch</label>
                    <input type="date" name="date" class="form-control">
                </div>
                <div class="col">
                    <label>Thời gian</label>
                    <input type="time" name="time" class="form-control">
                </div>
            </div>

            <div class="mb-3">
                <label>Dịch vụ</label>
                <select name="service" class="form-control">
                    <option value="">-- Chọn dịch vụ --</option>
                    <option value="massage">Massage</option>
                    <option value="facial">Facial</option>
                    <option value="nail">Nail</option>
                    <!-- Thêm dịch vụ khác -->
                </select>
            </div>

            <div class="mb-3">
                <label>Ghi chú</label>
                <textarea name="note" class="form-control" rows="3"></textarea>
            </div>

            <div class="text-center">
                <button type="submit" class="btn btn-primary">Xác nhận</button>
            </div>
        </form>
    </div>
</div>
@endsection
