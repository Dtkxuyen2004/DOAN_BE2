<?php

namespace App\Http\Controllers;

use App\Models\Payment;
use App\Models\Customer;
use Illuminate\Http\Request;

class PaymentController extends Controller
{
    public function edit(Payment $payment)
{
    $customers = Customer::all();
    $payment->services = json_decode($payment->services, true);
    $payment->staffs = json_decode($payment->staffs, true);
    return view('payments.edit', compact('payment', 'customers'));
}

public function update(Request $request, Payment $payment)
{
    $request->validate([
        'customer_id' => 'required|exists:customers,id',
        'services' => 'required|array',
        'staffs' => 'required|array',
        'total_amount' => 'required|numeric|min:0',
        'payment_method' => 'required|string',
    ]);

    $validServices = array_filter($request->services, function ($item) {
        return !empty(trim($item));
    });
    if (count($validServices) == 0) {
        return back()->withInput()->withErrors(['services' => 'Vui lòng nhập ít nhất một dịch vụ.']);
    }

    $validStaffs = array_filter($request->staffs, function ($item) {
        return !empty(trim($item));
    });
    if (count($validStaffs) == 0) {
        return back()->withInput()->withErrors(['staffs' => 'Vui lòng nhập ít nhất một nhân viên.']);
    }

    $payment->update([
        'customer_id' => $request->customer_id,
        'services' => json_encode($validServices),
        'staffs' => json_encode($validStaffs),
        'total_amount' => $request->total_amount,
        'payment_method' => $request->payment_method
    ]);

    return redirect()->route('payments.index')->with('success', 'Cập nhật thanh toán thành công.');
}

public function destroy(Payment $payment)
{
    $payment->delete();
    return redirect()->route('payments.index')->with('success', 'Đã xóa thanh toán.');
}

    /**
     * Hiển thị danh sách thanh toán
     */
    public function index()
    {
        $payments = Payment::with('customer')->orderBy('created_at', 'desc')->get();
        return view('payments.index', compact('payments'));
    }

    /**
     * Hiển thị form tạo thanh toán mới
     */
    public function create()
    {
        $customers = Customer::all();
        return view('payments.create', compact('customers'));
    }

    /**
     * Lưu dữ liệu thanh toán mới
     */
    public function store(Request $request)
    {
        $request->validate([
            'customer_id' => 'required|exists:customers,id',
            'services' => 'required|array',
            'staffs' => 'required|array',
            'total_amount' => 'required|numeric|min:0',
            'payment_method' => 'required|string',
        ]);

        $validServices = array_filter($request->services, function ($item) {
            return !empty(trim($item));
        });
        if (count($validServices) == 0) {
            return back()->withInput()->withErrors(['services' => 'Vui lòng nhập ít nhất một dịch vụ.']);
        }

        
        $validStaffs = array_filter($request->staffs, function ($item) {
            return !empty(trim($item));
        });
        if (count($validStaffs) == 0) {
            return back()->withInput()->withErrors(['staffs' => 'Vui lòng nhập ít nhất một nhân viên.']);
        }

       
        Payment::create([
            'customer_id' => $request->customer_id,
            'services' => json_encode($validServices),
            'staffs' => json_encode($validStaffs),
            'total_amount' => $request->total_amount,
            'payment_method' => $request->payment_method
        ]);

        return redirect()->route('payments.index')->with('success', 'Thanh toán đã được tạo thành công.');
    }

    public function show(Payment $payment) {}
   
}
