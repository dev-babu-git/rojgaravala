<?php

namespace App\Http\Controllers;

use App\Models\User;
use  App\Models\Category;
use App\Models\Subcategory;
// use Illuminate\Testing\Fluent\Concerns\Has;
use Illuminate\Support\Facades\Hash;

use Illuminate\Http\Request;

class UserController extends Controller
{

    public function index(Request $request)
    {
        $query = User::query();

        // Filter by name
        if ($name = $request->query('name')) {
            $query->where('name', 'like', "%{$name}%");
        }

        // Filter by status
        if ($status = $request->query('status')) {
            if ($status === '1' || $status === '0') {
                $query->where('status', $status);
            }
        }

        // Pagination
        $usersData = $query->orderBy('id', 'desc')->paginate(5)->withQueryString();

        return view('admin.pages.users.list', compact('usersData'));
    }

    // Create Form
    public function create()
    {
        return view('admin.pages.users.create');
    }

    // Store
    public function store(Request $request)
    {
        // Validate request
        $data = $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|email|unique:users,email',
            'password' => 'required|string|min:6',
            'role' => 'nullable|string|in:admin,user',
        ]);

        // Prepare data
        $data['password'] = bcrypt($data['password']); // encrypt password
        $data['role'] = $data['role'] ?? 'user';       // default role
        $data['status'] = 1;                            // default active status, optional

        // Create user
        User::create($data);

        return redirect()->route('users.index')->with('success', 'User created successfully.');
    }

    // Edit Form
    public function edit(User $user)
    {
        return view('admin.pages.users.edit', compact('user'));
    }

    // Update
    public function update(Request $request, User $user)
    {
        // Validate request

        
        $data = $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|email|unique:users,email,' . $user->id,
            'password' => 'nullable|string|min:6',
            'role' => 'nullable|string|in:admin,user', 
        ]);

        // If password is provided, encrypt it
        if (!empty($data['password'])) {
            $data['password'] = Hash::make($data['password']);
        } else {
            unset($data['password']); // keep current password if blank
        }

        // Set default role if not provided
        $data['role'] = $data['role'] ?? $user->role;

        // Set default status if not provided

 
        // Update user
        $user->update($data);

        return redirect()->route('users.index')->with('success', 'User updated successfully.');
    }

    // Delete


public function destroy(User $user)
{
    $user->delete();

    return redirect()->route('users.index')->with('success', 'User deleted successfully.');
}

}
