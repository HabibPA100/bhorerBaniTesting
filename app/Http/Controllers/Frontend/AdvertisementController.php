<?php

namespace App\Http\Controllers;

use App\Models\Advertisement;
use Illuminate\Http\Request;

class AdvertisementController extends Controller
{
    // Display a listing of the advertisements.
    public function index()
    {
        $advertisements = Advertisement::all(); // Retrieve all advertisements
        return view('advertisements.index', compact('advertisements')); // Return the view with the advertisements
    }

    // Show the form for creating a new advertisement.
    public function create()
    {
        return view('advertisements.create'); // Return the form to create an advertisement
    }

    // Store a newly created advertisement in storage.
    public function store(Request $request)
    {
        // Validate the incoming request data
        $validated = $request->validate([
            'priority' => 'required|in:High,Medium,Low',
            'content' => 'required|string',
            'advertiser_name' => 'nullable|string|max:255',
            'advertiser_contact' => 'nullable|string|max:255',
            'start_date' => 'nullable|date',
            'end_date' => 'nullable|date',
            'placement' => 'required|in:Homepage,Sidebar,Article,Popup',
            'image' => 'nullable|image|mimes:jpg,png,jpeg,gif',
            'video' => 'nullable|mimes:mp4,avi,mkv',
            'link' => 'nullable|url',
            'status' => 'required|in:Active,Inactive,Pending',
        ]);

        // Handle file uploads (image or video)
        if ($request->hasFile('image')) {
            $validated['image'] = $request->file('image')->store('images', 'public');
        }

        if ($request->hasFile('video')) {
            $validated['video'] = $request->file('video')->store('videos', 'public');
        }

        // Create the advertisement
        Advertisement::create($validated);

        // Redirect back with success message
        return redirect()->route('advertisements.index')->with('success', 'Advertisement created successfully!');
    }

    // Display the specified advertisement.
    public function show(Advertisement $advertisement)
    {
        return view('advertisements.show', compact('advertisement')); // Display the advertisement details
    }

    // Show the form for editing the specified advertisement.
    public function edit(Advertisement $advertisement)
    {
        return view('advertisements.edit', compact('advertisement')); // Return the form to edit an advertisement
    }

    // Update the specified advertisement in storage.
    public function update(Request $request, Advertisement $advertisement)
    {
        // Validate the incoming request data
        $validated = $request->validate([
            'priority' => 'required|in:High,Medium,Low',
            'content' => 'required|string',
            'advertiser_name' => 'nullable|string|max:255',
            'advertiser_contact' => 'nullable|string|max:255',
            'start_date' => 'nullable|date',
            'end_date' => 'nullable|date',
            'placement' => 'required|in:Homepage,Sidebar,Article,Popup',
            'image' => 'nullable|image|mimes:jpg,png,jpeg,gif',
            'video' => 'nullable|mimes:mp4,avi,mkv',
            'link' => 'nullable|url',
            'status' => 'required|in:Active,Inactive,Pending',
        ]);

        // Handle file uploads (image or video)
        if ($request->hasFile('image')) {
            $validated['image'] = $request->file('image')->store('images', 'public');
        }

        if ($request->hasFile('video')) {
            $validated['video'] = $request->file('video')->store('videos', 'public');
        }

        // Update the advertisement
        $advertisement->update($validated);

        // Redirect back with success message
        return redirect()->route('advertisements.index')->with('success', 'Advertisement updated successfully!');
    }

    // Remove the specified advertisement from storage.
    public function destroy(Advertisement $advertisement)
    {
        // Delete the advertisement
        $advertisement->delete();

        // Redirect back with success message
        return redirect()->route('advertisements.index')->with('success', 'Advertisement deleted successfully!');
    }
}
