namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class UserController extends Controller
{
    public function show()
    {
        $user = Auth::user();

        return view('thongtincanhan.profile', [
            'userName' => $user->name,
            'userEmail' => $user->email,
            'userPhone' => $user->phone ?? 'Chưa có số điện thoại',
        ]);
    }

    public function update(Request $request)
    {
        $request->validate([
            'userEmail' => 'required|email',
            'userPhone' => 'nullable|string|max:20',
        ]);

        $user = Auth::user();
        $user->email = $request->userEmail;
        $user->phone = $request->userPhone;
        $user->save();

        return redirect()->route('profile.show')->with('message', 'Thông tin đã được cập nhật thành công!');
    }
}
