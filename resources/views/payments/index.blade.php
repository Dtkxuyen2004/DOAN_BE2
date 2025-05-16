@extends('layouts.app')

@section('content')
<div class="container">
    <div class="d-flex justify-content-between align-items-center mb-3">
        <h2>Danh sách thanh toán</h2>
        <a href="{{ route('payments.create') }}" class="btn btn-success">+ Tạo thanh toán</a>
    </div>

    <table class="table table-bordered">
        <thead class="table-light">
            <tr>
                <th>STT</th>
                <th>Khách hàng</th>
                <th>Dịch vụ</th>
                <th>Nhân viên</th>
                <th>Hình thức</th>
                <th>Tổng tiền</th>
                <th>Ngày tạo</th>
                <th>Tùy chọn</th>
            </tr>
        </thead>
        <tbody>
            @forelse($payments as $index => $payment)
                <tr>
                    <td>{{ $index + 1 }}</td>
                    <td>{{ $payment->customer->name ?? 'Không rõ' }}</td>
                    <td>
                        @foreach(json_decode($payment->services) as $service)
                            <span class="badge bg-primary">{{ $service }}</span>
                        @endforeach
                    </td>
                    <td>
                        @foreach(json_decode($payment->staffs) as $staff)
                            <span class="badge bg-info">{{ $staff }}</span>
                        @endforeach
                    </td>
                    <td>{{ $payment->payment_method }}</td>
                    <td>{{ number_format($payment->total_amount, 0, ',', '.') }}₫</td>
                    <td>{{ $payment->created_at->format('d/m/Y H:i') }}</td>
                    <td>
                        <a href="{{ route('payments.edit', $payment->id) }}" class="btn btn-warning btn-sm">Sửa</a>

                        <form action="{{ route('payments.destroy', $payment->id) }}" method="POST" style="display:inline-block;" onsubmit="return confirm('Bạn có chắc chắn muốn xóa?');">
                            @csrf
                            @method('DELETE')
                            <button type="submit" class="btn btn-danger btn-sm">Xóa</button>
                        </form>
                    </td>
                </tr>
            @empty
                <tr><td colspan="8" class="text-center">Không có thanh toán nào.</td></tr>
            @endforelse
        </tbody>
    </table>
</div>
@endsection
