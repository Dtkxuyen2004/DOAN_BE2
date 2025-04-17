@extends('layouts.app') {{-- Nếu em có file layout --}}

@section('content')
<div class="container">
    <div class="rating-container">
        <h2 class="text-center">Danh Sách Đánh Giá Dịch Vụ</h2>

        <div class="back-btn text-center mb-3">
            <a href="{{ url('/') }}" class="btn btn-secondary">Quay lại Trang Chủ</a>
        </div>

        @if (count($ratings) > 0)
            @foreach ($ratings as $rating)
                <div class="rating-item">
                    <h5>{{ $rating->customer_name }} <span class="stars">
                        @for ($i = 0; $i < $rating->service_rating; $i++)
                            ★
                        @endfor
                    </span></h5>
                    <p class="comment">"{{ $rating->comments }}"</p>
                    <p><small>Đánh giá vào lúc: {{ $rating->created_at->format('d/m/Y H:i:s') }}</small></p>
                </div>
            @endforeach
        @else
            <p>Chưa có đánh giá nào.</p>
        @endif
    </div>
</div>

<style>
    .rating-container {
        max-width: 800px;
        margin: 50px auto;
        background: #fff;
        border-radius: 8px;
        box-shadow: 0 4px 6px rgba(0, 0, 0, 0.1);
        padding: 30px;
    }

    .stars {
        color: #f39c12;
    }

    .rating-item {
        margin-bottom: 20px;
    }

    .rating-item .comment {
        font-style: italic;
        color: #6c757d;
    }
</style>
@endsection
