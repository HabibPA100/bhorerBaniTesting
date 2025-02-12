<?php

namespace App\Http\Controllers;

use App\Models\Requirement;
use Illuminate\Http\Request;

class RequirementController extends Controller
{
    // Display a listing of the requirements.
    public function index()
    {
        $requirements = Requirement::all(); // Retrieve all requirements
        return view('requirements.index', compact('requirements')); // Return the view with the requirements
    }

    // Show the form for creating a new requirement.
    public function create()
    {
        return view('requirements.create'); // Return the form to create a requirement
    }

    // Store a newly created requirement in storage.
    public function store(Request $request)
    {
        // Validate the incoming request data
        $validated = $request->validate([
            'type' => 'required|in:Applicant,Journalist,Non-Journalist',
        ]);

        // Create the requirement
        Requirement::create($validated);

        // Redirect back with success message
        return redirect()->route('requirements.index')->with('success', 'Requirement created successfully!');
    }

    // Display the specified requirement.
    public function show(Requirement $requirement)
    {
        return view('requirements.show', compact('requirement')); // Display the requirement details
    }

    // Show the form for editing the specified requirement.
    public function edit(Requirement $requirement)
    {
        return view('requirements.edit', compact('requirement')); // Return the form to edit a requirement
    }

    // Update the specified requirement in storage.
    public function update(Request $request, Requirement $requirement)
    {
        // Validate the incoming request data
        $validated = $request->validate([
            'type' => 'required|in:Applicant,Journalist,Non-Journalist',
        ]);

        // Update the requirement with the validated data
        $requirement->update($validated);

        // Redirect back with success message
        return redirect()->route('requirements.index')->with('success', 'Requirement updated successfully!');
    }

    // Remove the specified requirement from storage.
    public function destroy(Requirement $requirement)
    {
        // Delete the requirement
        $requirement->delete();

        // Redirect back with success message
        return redirect()->route('requirements.index')->with('success', 'Requirement deleted successfully!');
    }
}
