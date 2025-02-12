<?php

namespace App\Http\Controllers;

use App\Models\Category;
use Illuminate\Http\Request;

class CategoryController extends Controller
{
    // Display a listing of the categories.
    public function index()
    {
        $categories = Category::all(); // Retrieve all categories
        return view('categories.index', compact('categories')); // Return the view with the categories
    }

    // Show the form for creating a new category.
    public function create()
    {
        return view('categories.create'); // Return the form to create a category
    }

    // Store a newly created category in storage.
    public function store(Request $request)
    {
        // Validate the incoming request data
        $validated = $request->validate([
            'name' => 'required|string|max:255|unique:categories,name',
            'description' => 'nullable|string',
        ]);

        // Create the category
        Category::create($validated);

        // Redirect back with success message
        return redirect()->route('categories.index')->with('success', 'Category created successfully!');
    }

    // Display the specified category.
    public function show(Category $category)
    {
        return view('categories.show', compact('category')); // Display the category details
    }

    // Show the form for editing the specified category.
    public function edit(Category $category)
    {
        return view('categories.edit', compact('category')); // Return the form to edit a category
    }

    // Update the specified category in storage.
    public function update(Request $request, Category $category)
    {
        // Validate the incoming request data
        $validated = $request->validate([
            'name' => 'required|string|max:255|unique:categories,name,' . $category->id,
            'description' => 'nullable|string',
        ]);

        // Update the category with the validated data
        $category->update($validated);

        // Redirect back with success message
        return redirect()->route('categories.index')->with('success', 'Category updated successfully!');
    }

    // Remove the specified category from storage.
    public function destroy(Category $category)
    {
        // Delete the category
        $category->delete();

        // Redirect back with success message
        return redirect()->route('categories.index')->with('success', 'Category deleted successfully!');
    }
}
