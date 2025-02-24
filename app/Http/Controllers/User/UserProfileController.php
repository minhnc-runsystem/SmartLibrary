<?php

namespace App\Http\Controllers\User;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\User;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Hash;

class UserProfileController extends Controller
{
    public function show()
    {
        return view('user.profile.show', ['user' => Auth::user()]);
    }

    public function edit()
    {
        return view('user.profile.edit', ['user' => Auth::user()]);
    }

    public function update(Request $request)
    {
        if(!$request->filled('password_confirmation')){
            return redirect()->back()->with('error', 'Confirm password is required');
        }
        // Đảm bảo lấy được user instance
        $user = Auth::user();
        
        // Kiểm tra xem có user không
        if (!$user) {
            return redirect()->back()->with('error', 'User not found');
        }
        $user = User::find($user->id);


        $validatedData = $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|email|unique:users,email,' . $user->id,
            // Nếu không cập nhật password thì không cần validate
            'password' => $request->filled('password') ? 'required|min:6|confirmed' : '',
            'password_confirmation' => $request->filled('password') ? 'required|min:6' : '',
        ]);

      


        try {
            // Cập nhật thông tin cơ bản
            
            $user->name = $validatedData['name'];
            $user->email = $validatedData['email'];

            // Chỉ cập nhật password nếu ca nhập mới
            if ($request->filled('password')) {
                $user->password = Hash::make($request->password);
            }

            $user->update();

            return redirect()->back()->with('success', 'Update information successfully');
        } catch (\Exception $e) {
            return redirect()->back()->with('error', 'An error occurred while updating information');
        }
    }
}
