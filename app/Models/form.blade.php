<div class="mb-3">
    <label for="name" class="form-label">Tên</label>
    <input type="text" name="name" class="form-control" value="{{ old('name', $customer->name ?? '') }}" required>
</div>
<div class="mb-3">
    <label for="email" class="form-label">Email</label>
    <input type="email" name="email" class="form-control" value="{{ old('email', $customer->email ?? '') }}" required>
</div>
<div class="mb-3">
    <label for="phone" class="form-label">Điện thoại</label>
    <input type="text" name="phone" class="form-control" value="{{ old('phone', $customer->phone ?? '') }}">
</div>
<div class="mb-3">
    <label for="address" class="form-label">Địa chỉ</label>
    <textarea name="address" class="form-control">{{ old('address', $customer->address ?? '') }}</textarea>
</div>
