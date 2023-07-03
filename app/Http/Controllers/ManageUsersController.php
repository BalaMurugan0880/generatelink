<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;
use App\Models\Role;

class ManageUsersController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        // Fetch users with their profiles and roles
        $users = User::with('role')->get();

        // dd($users);

        return view('admin.management.users.index', compact('users'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('admin.management.users.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required',
            'email' => 'required|unique:users,email',
            'password' => 'required|confirmed',
            'designation' => 'required',
            'phone_number' => 'required',
            'gender' => 'required',
            'dob' => 'required',
            'status' => 'required',
        ]);


        $customerRole = Role::where('slug', 'customer')->first();

        $customerUser = new User();
        $customerUser->name = $request->name;
        $customerUser->email = $request->email;
        $customerUser->password = bcrypt($request->password);
        $customerUser->is_active = $request->status === 'on' ? 1 : 0;
        $customerUser->role()->associate($customerRole);
        $customerUser->save();

        if ($customerUser) {
            return redirect()->route('users.index')->with('success', 'User created successfully.');
        } else {
            return redirect()->back()->with('error', 'Failed to create user.');
        }

    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(User $user)
    {
        return view('admin.management.users.edit', compact('user'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, User $user)
    {
        $request->validate([
            'name' => 'required',
            'email' => 'required|unique:users,email,'.$user->id,
            'password' => 'nullable',
            'designation' => 'required',
            'phone_number' => 'required',
            'gender' => 'required',
            'dob' => 'required',
            'status' => 'required',
        ]);

        // Update user details
        $user->name = $request->name;
        $user->email = $request->email;
        $user->is_active = $request->status === 'on' ? 1 : 0;
        if (!empty($request->password)) {
            $user->password = bcrypt($request->password);
        }
        $user->save();


        if ($profile) {
            return redirect()->route('users.index')->with('success', 'User updated successfully.');
        } else {
            return redirect()->back()->with('error', 'Failed to update user.');
        }

    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(User $user)
    {

        $user->delete();

        return redirect()->route('users.index')->with('success', 'User deleted successfully');
    }
}
