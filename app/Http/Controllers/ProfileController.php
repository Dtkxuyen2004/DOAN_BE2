<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

class ProfileController extends Controller
{
    // Hiển thị trang thông tin cá nhân
    public function show()
    {
         // Sử dụng try-catch để bắt lỗi
        try {
            $user = Auth::user();
            if (!$user) {
                return redirect()->route('login');
            }
            
            return view('profile.index', compact('user'));
        } catch (\Exception $e) {
            // Log lỗi
            \Log::error('Error in ProfileController@show: ' . $e->getMessage());
            
            // Redirect về trang login
            return redirect()->route('login')->with('error', 'Vui lòng đăng nhập để xem trang này.');
        }
    }

    
    // Cập nhật thông tin cá nhân
    public function update(Request $request)
    {
        // Validate dữ liệu
        $request->validate([
            'email' => 'nullable|email|unique:users,email,'.Auth::id(),
            'phone' => 'nullable|string|max:20',
        ]);

        try {
            // Sử dụng DB facade để tránh lỗi timestamps
            $updated = DB::table('users')
                ->where('id', Auth::id())
                ->update([
                    'email' => $request->filled('email') ? $request->email : Auth::user()->email,
                    'phone' => $request->filled('phone') ? $request->phone : Auth::user()->phone,
                ]);
            
            if ($updated) {
                return back()->with('status', 'Thông tin cá nhân đã được cập nhật thành công.');
            } else {
                return back()->withInput()->withErrors(['error' => 'Không thể cập nhật thông tin. Vui lòng thử lại.']);
            }
        } catch (\Exception $e) {
            \Log::error('Lỗi khi cập nhật thông tin: ' . $e->getMessage());
            return back()->withInput()->withErrors(['error' => 'Đã có lỗi xảy ra: ' . $e->getMessage()]);
        }
    }

    // Xử lý đăng xuất
    public function logout(Request $request)
    {
        Auth::logout();
        $request->session()->invalidate();
        $request->session()->regenerateToken();
        return redirect()->route('login');
    }
}