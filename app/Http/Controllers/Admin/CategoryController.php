<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Category;
use Illuminate\Http\Request;

class CategoryController extends Controller
{
    public function index()
    {
        $categories = Category::paginate(10);
        return view('admin.categories.index', compact('categories'));
    }

    public function create()
    {
        return view('admin.categories.create');
    }

    public function store(Request $request)
    {
        $request->validate(['name' => 'required|unique:categories,name']);
        Category::create($request->all());
        return redirect()->route('admin.categories')->with('success', 'Thể loại đã được thêm.');
    }

    public function edit(Category $category)
    {
        return view('admin.categories.edit', compact('category'));
    }

    public function update(Request $request, Category $category)
    {
        $request->validate(['name' => 'required|unique:categories,name,'.$category->id]);
        $category->update($request->all());
        return redirect()->route('admin.categories')->with('success', 'Cập nhật thể loại thành công.');
    }

    public function destroy(Category $category)
    {
        $category->delete();
        return redirect()->route('admin.categories')->with('success', 'Đã xóa thể loại.');
    }
}
