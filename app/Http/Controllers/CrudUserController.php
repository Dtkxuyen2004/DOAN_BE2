<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Session;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\DB;

/**
 * CRUD User controller
 */
class CrudUserController extends Controller
{
    /**
     * Home page
     */
    public function index()
    {
        return view('crud_user.index'); 
    }

    /**
     * Dashboard page
     */
    public function dashboard()
    {
        if(Auth::check()){
            return view('crud_user.dashboard');
        }
        return redirect("login")->withErrors('Bạn không có quyền truy cập');
    }

    /**
     * Login page
     */
    public function login()
    {
        if(Auth::check()){
            return redirect()->route('user.list');
        }
        return view('crud_user.login');
    }

    /**
     * User submit form login
     */
    public function authUser(Request $request)
    {
       $request->validate([
        'email' => 'required|email',
        'password' => 'required',
    ], [
        'email.required' => 'Vui lòng nhập email.',
        'email.email' => 'Email không đúng định dạng.',
        'password.required' => 'Vui lòng nhập mật khẩu.',
    ]);
    // Đơn giản hóa logic đăng nhập
    if (Auth::attempt(['email' => $request->email, 'password' => $request->password])) {
        $request->session()->regenerate();
        return redirect()->route('user.list')->with('success', 'Đăng nhập thành công');
    }
    return redirect()->route('login')->withErrors('Thông tin đăng nhập không chính xác');
    }

    /**
     * Registration page
     */
    public function createUser()
    {
        if(Auth::check()){
            return redirect()->route('user.list');
        }
        return view('crud_user.create');
    }

    /**
     * User submit form register
     */
   public function postUser(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'username' => 'required|string|max:255|unique:users,username',
            'full_name' => 'required|string|max:255',
            'email' => 'required|string|email|max:255|unique:users',
            'phone' => 'required|string|regex:/^[0-9]+$/|min:10|max:11',
            'password' => 'required|min:6',
            'confirm_password' => 'required|same:password',
        ], [
            'username.required' => 'Vui lòng nhập tên đăng nhập.',
            'username.unique' => 'Tên đăng nhập đã tồn tại.',
            'full_name.required' => 'Vui lòng nhập họ và tên.',
            'email.required' => 'Vui lòng nhập email.',
            'email.email' => 'Email không đúng định dạng.',
            'email.unique' => 'Email đã tồn tại.',
            'phone.required' => 'Vui lòng nhập số điện thoại.',
            'phone.regex' => 'Số điện thoại chỉ được chứa các chữ số.',
            'phone.min' => 'Số điện thoại phải có ít nhất 10 chữ số.',
            'phone.max' => 'Số điện thoại không được quá 11 chữ số.',
            'password.required' => 'Vui lòng nhập mật khẩu.',
            'password.min' => 'Mật khẩu phải có ít nhất 6 ký tự.',
            'confirm_password.required' => 'Vui lòng xác nhận mật khẩu.',
            'confirm_password.same' => 'Mật khẩu và Xác nhận mật khẩu không khớp.',
        ]);
        if ($validator->fails()) {
            return back()->withErrors($validator)->withInput();
        }
        try {
            DB::table('users')->insert([
                'username' => $request->username,
                'full_name' => $request->full_name,
                'email' => $request->email,
                'phone' => $request->phone,
                'password' => Hash::make($request->password)
            ]);
            
            // Sử dụng route() thay vì đường dẫn cứng
            return redirect()->route('login')->with('success', 'Đăng ký thành công. Vui lòng đăng nhập.');
        } catch (\Exception $e) {
            return back()->withInput()->withErrors(['error' => 'Đã có lỗi xảy ra: ' . $e->getMessage()]);
        }
    }

    /**
     * View user detail page
     */
    public function readUser(Request $request) {
        if (!Auth::check()) {
            return redirect()->route('login')->withErrors('Bạn không có quyền truy cập');
        }

        $user_id = $request->get('id');
        $user = User::find($user_id);

        if (!$user) {
            return redirect()->route('user.list')->withErrors('Không tìm thấy người dùng');
        }

        return view('crud_user.read', ['user' => $user]);
    }

    /**
     * Delete user by id
     */
    public function deleteUser(Request $request) {
        if (!Auth::check()) {
            return redirect()->route('login')->withErrors('Bạn không có quyền truy cập');
        }

        $user_id = $request->get('id');
        
        // Không cho phép xóa chính mình
        if ($user_id == Auth::id()) {
            return redirect()->route('user.list')->withErrors('Không thể xóa tài khoản đang đăng nhập');
        }
        
        try {
            // Sử dụng DB thay vì Eloquent để nhất quán
            DB::table('users')->where('id', $user_id)->delete();
            return redirect()->route('user.list')->with('success', 'Xóa người dùng thành công');
        } catch (\Exception $e) {
            return redirect()->route('user.list')->withErrors('Không thể xóa người dùng: ' . $e->getMessage());
        }
    }

    /**
     * Form update user page
     */
    public function updateUser(Request $request)
    {
        if (!Auth::check()) {
            return redirect()->route('login')->withErrors('Bạn không có quyền truy cập');
        }

        $user_id = $request->get('id');
        $user = User::find($user_id);

        if (!$user) {
            return redirect()->route('user.list')->withErrors('Không tìm thấy người dùng');
        }

        return view('crud_user.update', ['user' => $user]);
    }

    /**
     * Submit form update user
     */
   public function postUpdateUser(Request $request)
    {
        if (!Auth::check()) {
            return redirect()->route('login')->withErrors('Bạn không có quyền truy cập');
        }
        $input = $request->all();
        $validator = Validator::make($input, [
            'username' => 'required|string|max:255|unique:users,username,'.$input['id'],
            'full_name' => 'required|string|max:255',
            'email' => 'required|email|unique:users,email,'.$input['id'],
            'phone' => 'required|string|regex:/^[0-9]+$/|min:10|max:11',
            'password' => 'nullable|min:6',
            'confirm_password' => 'nullable|same:password',
        ], [
            'username.required' => 'Vui lòng nhập tên người dùng.',
            'full_name.required' => 'Vui lòng nhập họ và tên.',
            'email.required' => 'Vui lòng nhập email.',
            'email.email' => 'Email không đúng định dạng.',
            'email.unique' => 'Email đã tồn tại.',
            'phone.required' => 'Vui lòng nhập số điện thoại.',
            'phone.regex' => 'Số điện thoại chỉ được chứa các chữ số.',
            'phone.min' => 'Số điện thoại phải có ít nhất 10 chữ số.',
            'phone.max' => 'Số điện thoại không được quá 11 chữ số.',
            'password.min' => 'Mật khẩu phải có ít nhất 6 ký tự.',
            'confirm_password.same' => 'Mật khẩu và Xác nhận mật khẩu không khớp.',
        ]);
        if ($validator->fails()) {
            return back()->withErrors($validator)->withInput();
        }
        try {
            $updateData = [
                'username' => $input['username'],
                'full_name' => $input['full_name'],
                'email' => $input['email'],
                'phone' => $input['phone']
            ];
            
            // Chỉ cập nhật mật khẩu nếu đã nhập
            if (!empty($input['password'])) {
                $updateData['password'] = Hash::make($input['password']);
            }
            
            DB::table('users')
                ->where('id', $input['id'])
                ->update($updateData);
            
            return redirect()->route('user.list')->with('success', 'Cập nhật người dùng thành công');
        } catch (\Exception $e) {
            return back()->withInput()->withErrors(['error' => 'Đã có lỗi xảy ra: ' . $e->getMessage()]);
        }
    }

    /**
     * List of users
     */
    public function listUser()
    {
        if(Auth::check()){
            // Sử dụng DB query và thêm phân trang
            $users = DB::table('users')->paginate(10);
            return view('crud_user.list', ['users' => $users]);
        }

        return redirect()->route('login')->withErrors('Bạn không có quyền truy cập');
    }

    /**
     * Sign out
     */
    public function signOut() {
        Session::flush();
        Auth::logout();
        
        return redirect()->route('login')->with('success', 'Đăng xuất thành công');
    }
}