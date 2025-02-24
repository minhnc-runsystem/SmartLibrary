<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Models\User;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use App\Http\Controllers\Controller;
class UserController extends Controller
{
    public function user(Request $request)
    {
        $query = User::query();

        if ($request->has('search') && !empty($request->search)) {
            $searchTerm = '%' . $request->search . '%';
            $query->where('name', 'like', $searchTerm)
                ->orWhere('email', 'like', $searchTerm);
        }

        $users = $query->paginate(10);
        return view('admin.users.index', compact('users'));
    }

    public function edit(User $user)
    {
        return view('admin.users.edit', compact('user'));
    }

    public function update(Request $request, User $user)
    {
        if (Auth::user()->id !== $user->id && Auth::user()->role !== 'admin') {
            return redirect()->route('users.index')->with('error', 'Bạn không có quyền cập nhật thông tin này.');
        }

        $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|email|unique:users,email,' . $user->id,
            'password' => 'nullable|string|min:8|confirmed', // Cho phép để trống
            'role' => 'required|in:user,admin'
        ]);

        $user->name = $request->name;
        $user->email = $request->email;

        // Chỉ cập nhật mật khẩu nếu có nhập vào
        if ($request->filled('password')) {
            $user->password = Hash::make($request->password);
        }

        if (Auth::user()->role === 'admin') {
            $user->role = $request->role;
        }

        $user->save();

        return redirect()->route('admin.users')->with('success', 'Cập nhật thông tin người dùng thành công.');
    }



    public function destroy(User $user)
    {
        $user->delete();
        return redirect()->route('admin.users')->with('success', 'Người dùng đã được xóa');
    }

    public function create()
    {
        return view('admin.users.create');
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|email|unique:users,email',
            'password' => 'required|string|min:8|confirmed',
            'role' => 'required|in:user,admin'
        ]);
        
        $validated['password'] = Hash::make($validated['password']);

        User::create($validated);
        return redirect()->route('admin.users')->with('success', 'Người dùng đã được tạo thành công');
    }
}
