<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Http\Request;

class UserController extends Controller
{
    public function index()
    {
        $users = User::latest()->paginate(20);
        return view('admin.users.index', compact('users'));
    }

    public function pending()
    {
        $users = User::where('is_approved', false)->latest()->paginate(20);
        return view('admin.users.pending', compact('users'));
    }

    public function approve(User $user)
    {
        $user->update(['is_approved' => true]);
        return back()->with('success', "User {$user->name} has been approved.");
    }

    public function destroy(User $user)
    {
        if ($user->id === auth()->id()) {
            return back()->with('error', "You cannot delete your own account.");
        }

        $user->delete();
        return back()->with('success', "User deleted successfully.");
    }
}
