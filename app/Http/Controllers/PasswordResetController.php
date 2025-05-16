<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;
use Illuminate\Support\Facades\Hash;

class PasswordResetController extends Controller
{
    public function showForm()
    {
        return view('crud_user.password-reset');
    }

    public function updatePassword(Request $request)
    {
        $request->validate([
            'email' => 'required|email',
            'new_password' => 'required|min:6',
        ]);

        $user = User::where('email', $request->email)->first();

        if ($user) {
            $user->password = Hash::make($request->new_password);
            $user->save();

            return back()->with('message', 'Mật khẩu đã được cập nhật thành công.');
        } else {
            return back()->with('message', 'Không tìm thấy email này trong hệ thống.');
        }
    }
}
