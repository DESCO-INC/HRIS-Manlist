<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use App\Models\User;

class MaintenanceController extends Controller
{
    public function index(Request $request)
    {
        $search = $request->input('search');

        $query = User::when($search, function ($q) use ($search) {
            $q->where(function ($query) use ($search) {
                $query
                    ->where('name', 'like', "%{$search}%")
                    ->orWhere('email', 'like', "%{$search}%")
                    ->orWhere('credential', 'like', "%{$search}%");
            });
        });

        $users = $query->orderByDesc('id')->paginate(10);
        return view('maintenance.index', compact('users', 'search'));
    }

    public function store_user(Request $request)
    {
        $validated = $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|email|unique:users,email',
            'credential' => 'required|string|max:255',
            'password' => 'required|min:5|confirmed',
        ]);

        User::create([
            'name' => $validated['name'],
            'email' => $validated['email'],
            'credential' => $validated['credential'],
            'password' => Hash::make($validated['password']),
        ]);

        return redirect()->route('maintenance.index')->with('success', 'User added successfully.');
    }

    public function delete_user(User $user)
    {
        // prevent deleting yourself
        if ($user->id === auth()->id()) {
            return redirect()->route('maintenance.index')->with('error', 'You cannot delete your own account.');
        }

        $user->delete();

        return redirect()->route('maintenance.index')->with('success', 'User deleted successfully.');
    }

    public function update_user(Request $request, User $user)
    {
        $validated = $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|email|unique:users,email,' . $user->id,
            'credential' => 'required|string|max:255',
            'password' => 'nullable|min:5|confirmed',
        ]);

        $user->name = $validated['name'];
        $user->email = $validated['email'];
        $user->credential = $validated['credential'];

        if (!empty($validated['password'])) {
            $user->password = Hash::make($validated['password']);
        }

        $user->save();

        return redirect()->route('maintenance.index')->with('success', 'User updated successfully.');
    }
}
