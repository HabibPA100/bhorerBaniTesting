<?php

namespace App\Http\Controllers;

use App\Models\Role;
use Illuminate\Http\Request;

class RoleController extends Controller
{
    // ভূমিকা (Role) তালিকা দেখানোর জন্য মেথড
    public function index()
    {
        $roles = Role::all();
        return view('roles.index', compact('roles'));
    }

    // নতুন ভূমিকা সংযুক্ত করার জন্য মেথড
    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required|unique:roles,name',
            'description' => 'nullable|string',
        ]);

        Role::create($request->all());

        return redirect()->route('roles.index')->with('success', 'Role added successfully!');
    }

    // নির্দিষ্ট ভূমিকা দেখানোর জন্য মেথড
    public function show(Role $role)
    {
        return view('roles.show', compact('role'));
    }

    // ভূমিকা আপডেট করার জন্য মেথড
    public function update(Request $request, Role $role)
    {
        $request->validate([
            'name' => 'required|unique:roles,name,' . $role->id,
            'description' => 'nullable|string',
        ]);

        $role->update($request->all());

        return redirect()->route('roles.index')->with('success', 'Role updated successfully!');
    }

    // ভূমিকা ডিলেট করার জন্য মেথড
    public function destroy(Role $role)
    {
        $role->delete();
        return redirect()->route('roles.index')->with('success', 'Role deleted successfully!');
    }
}
