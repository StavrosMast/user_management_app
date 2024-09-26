<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;
use App\Models\Role;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\DB;

class UserController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $users = User::with('roles')->get();
        return view('users.index', compact('users'));
    }

    public function store(Request $request)
{
    $validated = $request->validate([
        'name' => 'required|string|max:255',
        'email' => 'required|string|email|max:255|unique:users',
        'password' => 'required|string|min:8',
        'roles' => 'required|array',
        'roles.*' => 'exists:roles,id',
    ]);

    $user = User::create([
        'name' => $validated['name'],
        'email' => $validated['email'],
        'password' => Hash::make($validated['password']),
    ]);

    $user->roles()->attach($validated['roles']);

    return redirect()->route('users.index')->with('success', 'User created successfully');
}

public function update(Request $request, User $user)
{
    $validated = $request->validate([
        'name' => 'required|string|max:255',
        'email' => 'required|string|email|max:255|unique:users,email,' . $user->id,
        'password' => 'nullable|string|min:8',
        'roles' => 'required|array',
        'roles.*' => 'exists:roles,id',
    ]);

    $user->update([
        'name' => $validated['name'],
        'email' => $validated['email'],
    ]);

    if ($validated['password']) {
        $user->update(['password' => Hash::make($validated['password'])]);
    }

    $user->roles()->sync($validated['roles']);

    return redirect()->route('users.index')->with('success', 'User updated successfully');
}

    public function create()
    {
        $roles = Role::all();
        return view('users.form', compact('roles'));
    }

    public function edit(User $user)
    {
        $roles = Role::all();
        return view('users.form', compact('user', 'roles'));
    }

    public function destroy(User $user)
    {
        try {
            // Begin a database transaction
            DB::beginTransaction();

            // Detach all roles associated with the user
            $user->roles()->detach();

            // Delete the user
            $user->delete();

            // Commit the transaction
            DB::commit();

            return redirect()->route('users.index')->with('success', 'User deleted successfully');
        } catch (\Exception $e) {
            // If an error occurs, rollback the transaction
            DB::rollBack();
            return redirect()->route('users.index')->with('error', 'Failed to delete user: ' . $e->getMessage());
        }
    }
}
