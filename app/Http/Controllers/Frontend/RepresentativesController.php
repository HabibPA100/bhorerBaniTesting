<?php

namespace App\Http\Controllers;

use App\Models\Representative;
use App\Models\User;
use Illuminate\Http\Request;

class RepresentativesController extends Controller
{
    // Display a listing of the resource.
    public function index()
    {
        $representatives = Representative::all();
        return view('representatives.index', compact('representatives'));
    }

    // Show the form for creating a new resource.
    public function create()
    {
        $users = User::all();  // Fetching all users for the dropdown
        return view('representatives.create', compact('users'));
    }

    // Store a newly created resource in storage.
    public function store(Request $request)
    {
        $request->validate([
            'user_id' => 'required|exists:users,id',
            'image' => 'required|image',
            'email' => 'required|email|unique:representatives,email',
            'password' => 'required|min:6',
            'bangla_name' => 'required|string|max:255',
            'first_name' => 'required|string|max:255',
            'last_name' => 'required|string|max:255',
            'father_name' => 'required|string|max:255',
            'mother_name' => 'required|string|max:255',
            'mobile_number' => 'required|string|max:15',
            'whatsapp_number' => 'nullable|string|max:15',
            'dob' => 'required|date|before:today',
            'education_qualifications' => 'required|string|max:1000',
            'national_id' => 'required|string|max:20',
            'interested_position' => 'required|string|max:255',
            'responsible_place_name' => 'required|string|max:255',
            'accept_terms_conditions' => 'required|boolean',
            'role_id' => 'required|exists:roles,id',
        ]);
        

        $representative = new Representative($request->all());

        // Store image
        if ($request->hasFile('image')) {
            $representative->image = $request->file('image')->store('images');
        }

        $representative->save();

        return redirect()->route('representatives.index');
    }

    // Display the specified resource.
    public function show($id)
    {
        $representative = Representative::findOrFail($id);
        return view('representatives.show', compact('representative'));
    }

    // Show the form for editing the specified resource.
    public function edit($id)
    {
        $representative = Representative::findOrFail($id);
        $users = User::all();  // Fetching all users for the dropdown
        return view('representatives.edit', compact('representative', 'users'));
    }

    // Update the specified resource in storage.
    public function update(Request $request, $id)
    {
        $request->validate([
            'user_id' => 'required',
            'image' => 'nullable|image',
            'email' => 'required|email|unique:representatives,email,' . $id,
            'password' => 'nullable|min:8',
            'bangla_name' => 'required|string|max:255',
            'first_name' => 'required|string|max:255',
            'last_name' => 'required|string|max:255',
            'father_name' => 'required|string|max:255',
            'mother_name' => 'required|string|max:255',
            'mobile_number' => 'required|string|max:15',
            'whatsapp_number' => 'nullable|string|max:15',
            'dob' => 'required|date|before:today',
            'education_qualifications' => 'required|string|max:1000',
            'national_id' => 'required|string|max:20',
            'interested_position' => 'required|string|max:255',
            'responsible_place_name' => 'required|string|max:255',
            'accept_terms_conditions' => 'required|boolean',
            'role_id' => 'required|exists:roles,id',
        ]);
        

        $representative = Representative::findOrFail($id);
        $representative->update($request->all());

        // Update image if present
        if ($request->hasFile('image')) {
            $representative->image = $request->file('image')->store('images');
        }

        $representative->save();

        return redirect()->route('representatives.index');
    }

    // Remove the specified resource from storage.
    public function destroy($id)
    {
        $representative = Representative::findOrFail($id);
        $representative->delete();

        return redirect()->route('representatives.index');
    }
}
