<?php

namespace App\Http\Controllers;

use App\Models\News;
use Illuminate\Http\Request;

class NewsController extends Controller
{
    public function index()
    {
        return response()->json(News::with(['reporter', 'category'])->get());
    }

    public function store(Request $request)
    {
        $request->validate([
            'thumbnail' => 'required|string',
            'splash' => 'nullable|string',
            'type' => 'required|in:Breaking,Regular,Headline',
            'meta' => 'nullable|string|max:256',
            'division' => 'nullable|string',
            'district' => 'nullable|string',
            'subdistrict' => 'nullable|string',
            'category_1' => 'nullable|string',
            'category_2' => 'nullable|string',
            'category_3' => 'nullable|string',
            'headline' => 'required|string',
            'subtitle' => 'nullable|string',
            'content' => 'required|string',
            'date' => 'nullable|date',
            'reporter_id' => 'required|exists:users,id',
            'category_id' => 'required|exists:categories,id',
            'published_at' => 'nullable|date',
            'status' => 'required|string',
        ]);

        $news = News::create($request->all());
        return response()->json($news, 201);
    }

    public function show(News $news)
    {
        return response()->json($news->load(['reporter', 'category']));
    }

    public function update(Request $request, News $news)
    {
        $request->validate([
            'thumbnail' => 'sometimes|string',
            'splash' => 'sometimes|string',
            'type' => 'sometimes|in:Breaking,Regular,Headline',
            'meta' => 'sometimes|string|max:256',
            'division' => 'sometimes|string',
            'district' => 'sometimes|string',
            'subdistrict' => 'sometimes|string',
            'category_1' => 'sometimes|string',
            'category_2' => 'sometimes|string',
            'category_3' => 'sometimes|string',
            'headline' => 'sometimes|string',
            'subtitle' => 'sometimes|string',
            'content' => 'sometimes|string',
            'date' => 'sometimes|date',
            'reporter_id' => 'sometimes|exists:users,id',
            'category_id' => 'sometimes|exists:categories,id',
            'published_at' => 'sometimes|date',
            'status' => 'sometimes|string',
        ]);

        $news->update($request->all());
        return response()->json($news);
    }

    public function destroy(News $news)
    {
        $news->delete();
        return response()->json(null, 204);
    }
}
