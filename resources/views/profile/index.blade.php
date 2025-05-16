@extends('layouts.app')

@section('content')
<div class="container mt-5">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header bg-primary text-white">
                    <h4 class="mb-0">Thông Tin Cá Nhân</h4>
                </div>
                
                <div class="card-body">
                    <div class="mb-3">
                        <a href="{{ route('index') }}" class="btn btn-secondary">&larr; Quay Lại</a>
                    </div>
                    
                    @if(session('message'))
                        <div class="alert alert-success">
                            {{ session('message') }}
                        </div>
                    @endif
                    
                    @if($errors->any())
                        <div class="alert alert-danger">
                            <ul class="mb-0">
                                @foreach($errors->all() as $error)
                                    <li>{{ $error }}</li>
                                @endforeach
                            </ul>
                        </div>
                    @endif
                    
                    <h5 class="card-title">Xin chào, {{ $user->name }}!</h5>
                    <p class="card-text"><strong>Email:</strong> {{ $user->email }}</p>
                    <p class="card-text"><strong>Số điện thoại:</strong> {{ $user->phone ?? 'Chưa có số điện thoại' }}</p>
                    
                    <form action="{{ route('profile.update') }}" method="POST">
                        @csrf
                        <div class="mb-3">
                            <label for="email" class="form-label">Thay đổi email</label>
                            <input type="email" id="email" name="email" class="form-control" value="{{ old('email', $user->email) }}">
                        </div>
                        <div class="mb-3">
                            <label for="phone" class="form-label">Thay đổi số điện thoại</label>
                            <input type="text" id="phone" name="phone" class="form-control" value="{{ old('phone', $user->phone) }}">
                        </div>
                        <button type="submit" class="btn btn-primary">Cập nhật thông tin</button>
                    </form>
                    
                    <form action="{{ route('logout') }}" method="POST" class="mt-3">
                        @csrf
                        <button type="submit" class="btn btn-danger">Đăng xuất</button>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection 