<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;

// Admin only: change a user's role
class UserController extends Controller
{
    public function index()
    {
        $users = User::with('roles')->paginate(15);
        return view('users.index', compact('users'));
    }

    public function updateRole(Request $request, User $user)
    {
        $request->validate(['role' => 'required|in:admin,lecturer,student']);

        if ($user->id == auth()->id()) {
            return back()->with('error', 'You cannot change your own role.');
        }

        $user->syncRoles([$request->role]);   // replaces the old role

        return back()->with('success', $user->name . ' is now a ' . $request->role . '.');
    }
}
