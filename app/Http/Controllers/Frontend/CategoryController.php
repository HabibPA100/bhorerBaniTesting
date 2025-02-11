<?php

namespace App\Http\Controllers;

use App\Models\Category;
use Illuminate\Http\Request;

class CategoryController extends Controller
{
    // ক্যাটাগরি তালিকা দেখানোর জন্য মেথড
    public function index()
    {
        $categories = Category::all();
        return view('categories.index', compact('categories'));
    }

    // নতুন ক্যাটাগরি সংযুক্ত করার জন্য মেথড
    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required|string|unique:categories,name',
            'description' => 'nullable|string',
        ]);

        Category::create($request->all());

        return redirect()->route('categories.index')->with('success', 'Category added successfully!');
    }

    // নির্দিষ্ট ক্যাটাগরি দেখানোর জন্য মেথড
    public function show(Category $category)
    {
        return view('categories.show', compact('category'));
    }

    // ক্যাটাগরি আপডেট করার জন্য মেথড
    public function update(Request $request, Category $category)
    {
        $request->validate([
            'name' => 'required|string|unique:categories,name,' . $category->id,
            'description' => 'nullable|string',
        ]);

        $category->update($request->all());

        return redirect()->route('categories.index')->with('success', 'Category updated successfully!');
    }

    // ক্যাটাগরি ডিলেট করার জন্য মেথড
    public function destroy(Category $category)
    {
        $category->delete();
        return redirect()->route('categories.index')->with('success', 'Category deleted successfully!');
    }
}
