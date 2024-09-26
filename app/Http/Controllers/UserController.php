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

    /**
     * Store a newly created resource in storage.
     */
    // public function store(Request $request)
    // {
    //     $validator = Validator::make($request->all(), [
    //         'name' => 'required|string|max:255',
    //         'email' => 'required|email|unique:users',
    //         'password' => 'required|string|min:8',
    //         'roles' => 'required|array',
    //         'roles.*' => 'exists:roles,id',
    //     ]);

    //     if ($validator->fails()) {
    //         return response()->json(['errors' => $validator->errors()], 422);
    //     }

    //     DB::beginTransaction();
    //     try {
    //         $user = User::create([
    //             'name' => $request->name,
    //             'email' => $request->email,
    //             'password' => Hash::make($request->password),
    //         ]);

    //         $user->roles()->attach($request->roles);

    //         DB::commit();
    //         return response()->json(['message' => 'User created successfully'], 201);
    //     } catch (\Exception $e) {
    //         DB::rollBack();
    //         return response()->json(['message' => 'Failed to create user', 'error' => $e->getMessage()], 500);
    //     }
    // }


    public function store(Request $request)
{
    $validated = $request->validate([
        'name' => 'required|string|max:255',
        'email' => 'required|string|email|max:unique:users',
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
}
