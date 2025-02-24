<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class AdminMiddleware
{
    public function handle(Request $request, Closure $next)
    {
        // dd("oke");
        // Kiểm tra xem user có quyền admin không
        if (Auth::check() && Auth::user()->role === 'admin') {
            return $next($request);
        }

        // Nếu không phải admin, chuyển hướng về trang chủ hoặc login
        return redirect('/')->with('error', 'Bạn không có quyền truy cập!');
    }
}

