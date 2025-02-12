<?php

namespace App\Http\Controllers;

use App\Models\User;
use App\Models\Role;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;

class UserController extends Controller
{
    // Display a listing of the users.
    public function index()
    {
        $users = User::with('role')->get(); // eager loading the related role
        return view('users.index', compact('users')); // Pass data to the index view
    }

    // Show the form for creating a new user.
    public function create()
    {
        $roles = Role::all(); // Retrieve all roles for the user to choose from
        return view('users.create', compact('roles')); // Return the create view
    }

    // Store a newly created user in storage.
    public function store(Request $request)
    {
        // Validate the incoming request data
        $validated = $request->validate([
            'role_id' => 'required|exists:roles,id',
            'name' => 'required|string|max:255',
            'email' => 'required|email|unique:users,email',
            'password' => 'required|string|min:8|confirmed',
        ]);

        // Hash password before saving
        $validated['password'] = Hash::make($validated['password']);

        // Create the new user
        User::create($validated);

        // Redirect back with success message
        return redirect()->route('users.index')->with('success', 'User created successfully!');
    }

    // Display the specified user.
    public function show(User $user)
    {
        $user->load('role'); // Eager load the role data
        return view('users.show', compact('user')); // Return the show view
    }

    // Show the form for editing the specified user.
    public function edit(User $user)
    {
        $roles = Role::all(); // Get all available roles for updating the user
        return view('users.edit', compact('user', 'roles')); // Return the edit view
    }

    // Update the specified user in storage.
    public function update(Request $request, User $user)
    {
        // Validate the incoming request data
        $validated = $request->validate([
            'role_id' => 'required|exists:roles,id',
            'name' => 'required|string|max:255',
            'email' => 'required|email|unique:users,email,' . $user->id,
            'password' => 'nullable|string|min:8|confirmed',
        ]);

        // If password is provided, hash it
        if ($request->filled('password')) {
            $validated['password'] = Hash::make($validated['password']);
        }

        // Update the user with the validated data
        $user->update($validated);

        // Redirect back with success message
        return redirect()->route('users.index')->with('success', 'User updated successfully!');
    }

    // Remove the specified user from storage.
    public function destroy(User $user)
    {
        // Delete the user
        $user->delete();

        // Redirect back with success message
        return redirect()->route('users.index')->with('success', 'User deleted successfully!');
    }
}
