<?php
namespace App\Http\Controllers;

use Illuminate\Http\Request;

class BookingController extends Controller
{
    public function create()
    {
        return view('booking.create');
    }

    public function store(Request $request)
    {
        // Validate dữ liệu
        $request->validate([
            'name' => 'required',
            'email' => 'required|email',
            'phone' => 'required',
            'address' => 'nullable',
            'date' => 'required|date',
            'time' => 'required',
            'service' => 'required',
            'note' => 'nullable',
        ]);

        // Lưu dữ liệu vào DB (nếu đã tạo Model + Migration)
        // Booking::create($request->all());

        return redirect()->back()->with('success', 'Đặt lịch thành công!');
    }
}
