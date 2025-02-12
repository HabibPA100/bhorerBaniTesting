<?php

namespace App\Http\Controllers;

use App\Models\News;
use App\Models\Category;
use App\Models\User;
use Illuminate\Http\Request;

class NewsController extends Controller
{
    // Display a listing of the news articles.
    public function index()
    {
        $news = News::all(); // Retrieve all news articles
        return view('news.index', compact('news')); // Return the view with the news articles
    }

    // Show the form for creating a new news article.
    public function create()
    {
        $categories = Category::all(); // Get all categories
        $users = User::all(); // Get all users (for reporter selection)
        return view('news.create', compact('categories', 'users')); // Return the form for creating a news article
    }

    // Store a newly created news article in storage.
    public function store(Request $request)
    {
        // Validate the incoming request data
        $validated = $request->validate([
            'thumbnail' => 'required|image|mimes:jpg,png,jpeg,gif',
            'splash' => 'required|image|mimes:jpg,png,jpeg,gif',
            'type' => 'required|in:Breaking,Regular,Headline',
            'meta' => 'required|string|max:256',
            'division' => 'required|string|max:255',
            'district' => 'required|string|max:255',
            'subdistrict' => 'required|string|max:255',
            'category_1' => 'required|string|max:255',
            'category_2' => 'nullable|string|max:255',
            'category_3' => 'nullable|string|max:255',
            'headline' => 'required|string|max:255',
            'subtitle' => 'nullable|string|max:255',
            'content' => 'required|string',
            'date' => 'required|date',
            'reporter_id' => 'required|exists:users,id',
            'category_id' => 'required|exists:categories,id',
            'published_at' => 'nullable|date',
            'status' => 'required|string|max:255',
        ]);

        // Handle file uploads (thumbnail, splash)
        if ($request->hasFile('thumbnail')) {
            $validated['thumbnail'] = $request->file('thumbnail')->store('images/thumbnails', 'public');
        }

        if ($request->hasFile('splash')) {
            $validated['splash'] = $request->file('splash')->store('images/splash', 'public');
        }

        // Create the news article
        News::create($validated);

        // Redirect back with success message
        return redirect()->route('news.index')->with('success', 'News article created successfully!');
    }

    // Display the specified news article.
    public function show(News $news)
    {
        return view('news.show', compact('news')); // Display the news article details
    }

    // Show the form for editing the specified news article.
    public function edit(News $news)
    {
        $categories = Category::all(); // Get all categories
        $users = User::all(); // Get all users (for reporter selection)
        return view('news.edit', compact('news', 'categories', 'users')); // Return the form for editing a news article
    }

    // Update the specified news article in storage.
    public function update(Request $request, News $news)
    {
        // Validate the incoming request data
        $validated = $request->validate([
            'thumbnail' => 'nullable|image|mimes:jpg,png,jpeg,gif',
            'splash' => 'nullable|image|mimes:jpg,png,jpeg,gif',
            'type' => 'required|in:Breaking,Regular,Headline',
            'meta' => 'required|string|max:256',
            'division' => 'required|string|max:255',
            'district' => 'required|string|max:255',
            'subdistrict' => 'required|string|max:255',
            'category_1' => 'required|string|max:255',
            'category_2' => 'nullable|string|max:255',
            'category_3' => 'nullable|string|max:255',
            'headline' => 'required|string|max:255',
            'subtitle' => 'nullable|string|max:255',
            'content' => 'required|string',
            'date' => 'required|date',
            'reporter_id' => 'required|exists:users,id',
            'category_id' => 'required|exists:categories,id',
            'published_at' => 'nullable|date',
            'status' => 'required|string|max:255',
        ]);

        // Handle file uploads (thumbnail, splash)
        if ($request->hasFile('thumbnail')) {
            $validated['thumbnail'] = $request->file('thumbnail')->store('images/thumbnails', 'public');
        }

        if ($request->hasFile('splash')) {
            $validated['splash'] = $request->file('splash')->store('images/splash', 'public');
        }

        // Update the news article
        $news->update($validated);

        // Redirect back with success message
        return redirect()->route('news.index')->with('success', 'News article updated successfully!');
    }

    // Remove the specified news article from storage.
    public function destroy(News $news)
    {
        // Delete the news article
        $news->delete();

        // Redirect back with success message
        return redirect()->route('news.index')->with('success', 'News article deleted successfully!');
    }
}
