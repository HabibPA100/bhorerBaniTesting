<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;

class UserController extends Controller
{
    // সমস্ত ইউজার তালিকা দেখানোর জন্য মেথড
    public function index()
    {
        $users = User::with('role')->get();
        return view('users.index', compact('users'));
    }

    // নতুন ইউজার সংযুক্ত করার জন্য মেথড
    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required|string',
            'email' => 'required|email|unique:users,email',
            'password' => 'required|min:6',
            'role_id' => 'required|exists:roles,id',
        ]);

        User::create([
            'name' => $request->name,
            'email' => $request->email,
            'password' => Hash::make($request->password),
            'role_id' => $request->role_id,
        ]);

        return redirect()->route('users.index')->with('success', 'User added successfully!');
    }

    // নির্দিষ্ট ইউজার দেখানোর জন্য মেথড
    public function show(User $user)
    {
        return view('users.show', compact('user'));
    }

    // ইউজার আপডেট করার জন্য মেথড
    public function update(Request $request, User $user)
    {
        $request->validate([
            'name' => 'sometimes|string',
            'email' => 'sometimes|email|unique:users,email,' . $user->id,
            'password' => 'sometimes|min:6',
            'role_id' => 'sometimes|exists:roles,id',
        ]);

        if ($request->filled('password')) {
            $request->merge(['password' => Hash::make($request->password)]);
        }

        $user->update($request->except('password'));

        return redirect()->route('users.index')->with('success', 'User updated successfully!');
    }

    // ইউজার ডিলেট করার জন্য মেথড
    public function destroy(User $user)
    {
        $user->delete();
        return redirect()->route('users.index')->with('success', 'User deleted successfully!');
    }
}
