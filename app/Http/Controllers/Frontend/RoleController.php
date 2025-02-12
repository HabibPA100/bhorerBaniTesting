<?php

namespace App\Http\Controllers;

use App\Models\Role;
use Illuminate\Http\Request;

class RoleController extends Controller
{
    // Display a listing of the roles.
    public function index()
    {
        $roles = Role::with('parentRole')->get(); // Eager load the parent role
        return view('roles.index', compact('roles'));
    }

    // Show the form for creating a new role.
    public function create()
    {
        $parentRoles = Role::all(); // Get all roles to select from as parent roles
        return view('roles.create', compact('parentRoles'));
    }

    // Store a newly created role in storage.
    public function store(Request $request)
    {
        // Validate the incoming request data
        $validated = $request->validate([
            'parent_role_id' => 'nullable|exists:roles,id',
            'name' => 'required|string|max:255|unique:roles,name',
            'description' => 'nullable|string',
        ]);

        // Create the new role
        Role::create($validated);

        // Redirect back with success message
        return redirect()->route('roles.index')->with('success', 'Role created successfully!');
    }

    // Display the specified role.
    public function show(Role $role)
    {
        $role->load('parentRole'); // Eager load the parent role
        return view('roles.show', compact('role'));
    }

    // Show the form for editing the specified role.
    public function edit(Role $role)
    {
        $parentRoles = Role::all(); // Get all available parent roles for updating
        return view('roles.edit', compact('role', 'parentRoles'));
    }

    // Update the specified role in storage.
    public function update(Request $request, Role $role)
    {
        // Validate the incoming request data
        $validated = $request->validate([
            'parent_role_id' => 'nullable|exists:roles,id',
            'name' => 'required|string|max:255|unique:roles,name,' . $role->id,
            'description' => 'nullable|string',
        ]);

        // Update the role with the validated data
        $role->update($validated);

        // Redirect back with success message
        return redirect()->route('roles.index')->with('success', 'Role updated successfully!');
    }

    // Remove the specified role from storage.
    public function destroy(Role $role)
    {
        // Delete the role
        $role->delete();

        // Redirect back with success message
        return redirect()->route('roles.index')->with('success', 'Role deleted successfully!');
    }
}
