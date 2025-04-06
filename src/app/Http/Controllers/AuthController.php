<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\User;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;

class AuthController extends Controller
{
    /**
     * Hiển thị form đăng nhập
     */
    public function showLoginForm()
    {
        return view('auth.login');
    }

    /**
     * Xử lý đăng nhập
     */
    public function login(Request $request)
    {
        // Validate dữ liệu đầu vào
        $validator = Validator::make($request->all(), [
            'email' => 'required|email',
            'password' => 'required',
        ], [
            'email.required' => 'Vui lòng nhập địa chỉ email',
            'email.email' => 'Địa chỉ email không hợp lệ',
            'password.required' => 'Vui lòng nhập mật khẩu',
        ]);

        if ($validator->fails()) {
            return redirect()->back()
                ->withErrors($validator)
                ->withInput($request->except('password'));
        }

        // Thông tin đăng nhập
        $credentials = $request->only('email', 'password');
        $remember = $request->filled('remember');

        // Kiểm tra đăng nhập
        if (Auth::attempt($credentials, $remember)) {
            // Khởi tạo lại session để ngăn ngừa session fixation
            $request->session()->regenerate();

            // Chuyển hướng đến trang dashboard hoặc trang chủ sau khi đăng nhập
            return redirect()->intended('home');
        }

        // Đăng nhập thất bại
        return redirect()->back()
            ->withErrors(['email' => 'Thông tin đăng nhập không chính xác'])
            ->withInput($request->except('password'));
    }

    /**
     * Xử lý đăng xuất
     */
    public function logout(Request $request)
    {
        Auth::logout();

        // Vô hiệu hóa session hiện tại
        $request->session()->invalidate();

        // Tạo mới CSRF token
        $request->session()->regenerateToken();

        // Chuyển hướng về trang đăng nhập với thông báo
        return redirect()->route('login')
            ->with('status', 'Bạn đã đăng xuất thành công');
    }

    /**
     * Hiển thị trang chủ sau khi đăng nhập
     */
    public function home()
    {
        return view('home');
    }
}