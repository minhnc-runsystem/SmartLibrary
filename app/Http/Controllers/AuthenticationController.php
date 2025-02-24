<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\User;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Str;
class AuthenticationController extends Controller
{
    public function getLoginView()
    {
        return view('auth.login');
    }

    public function getRegisterView()
    {
        return view('auth.register');
    }

    public function login(Request $request)
    {
        $credentials = $request->validate([
            'email' => 'required|email',
            'password' => 'required',
        ]);

        if (Auth::attempt($credentials)) {
            $request->session()->regenerate();
            $user = Auth::user();
            echo $user->role;
    
            // Kiểm tra role và chuyển hướng
            if ($user->role === 'admin') {
                return redirect()->route('admin')->with('success', 'Đăng nhập thành công với quyền Admin');
            } else {
                return redirect()->route('user')->with('success', 'Đăng nhập thành công');
            }
        }    

        return back()->withErrors([
            'email' => 'The provided credentials do not match our records.',
        ]);
    }

    public function register(Request $request)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|string|email|max:255|unique:users',
            'password' => 'required|string|min:8|confirmed',
            'password_confirmation' => 'required|string|min:8|same:password',
        ]);
        
        $user = User::create([
            'name' => $request->name,
            'email' => $request->email,
            'password' => Hash::make($request->password),
            'role' => 'user',
            'created_at' => now(),
            'updated_at' => now(),
            'remember_token' => Str::random(10),
            'email_verified_at' => now(),
        
        ]);

        Auth::login($user);
        return redirect()->intended('user')->with('success', 'Chào mừng bạn!');
    }

    public function logout()
    {
        Auth::logout();
        return redirect()->route('login')->with('success', 'Đăng xuất thành công');
    }
    
    
    
}
