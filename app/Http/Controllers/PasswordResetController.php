<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\DB;
use App\Models\User;

class PasswordResetController extends Controller
{
    // Hiển thị form đặt lại mật khẩu
    public function showForm()
    {
        return view('auth.password-reset'); // View form reset mật khẩu
    }

    // Xử lý đặt lại mật khẩu
    public function resetPassword(Request $request)
    {
        // Validate dữ liệu nhập vào
        $request->validate([
            'email' => 'required|email|exists:users,email', // Kiểm tra email có tồn tại trong bảng users
            'password' => 'required|min:6|confirmed', // Kiểm tra password_confirmation
        ]);

        // Tìm người dùng bằng email
        $user = User::where('email', $request->email)->first();

        // Kiểm tra nếu không tìm thấy người dùng
        if (!$user) {
            return back()->withErrors(['email' => 'Không tìm thấy người dùng với email này.']);
        }

        try {
            // Mã hóa mật khẩu và lưu lại
            $user->password = Hash::make($request->password); // Mã hóa mật khẩu
            $user->save(); // Lưu người dùng với mật khẩu mới
        } catch (\Exception $e) {
            // Xử lý lỗi nếu không thể cập nhật mật khẩu
            \Log::error('Lỗi khi cập nhật mật khẩu: ' . $e->getMessage());
            return back()->withErrors(['error' => 'Đã có lỗi xảy ra, vui lòng thử lại sau.']);
        }

        // Sau khi thành công, chuyển hướng người dùng đến trang đăng nhập
        return redirect()->route('login')->with('status', 'Mật khẩu của bạn đã được cập nhật.');
    }
}
