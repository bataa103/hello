<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\User;

class UserController extends Controller
{
    /**
     * Import users from a CSV file.
     */
    public function import(Request $request)
    {
        $request->validate([
            'file' => 'required|mimes:csv,txt|max:2048',
        ]);

        $file = $request->file('file');
        $data = array_map('str_getcsv', file($file));

        // Process each row
        $header = array_shift($data); // Assume first row is the header
        foreach ($data as $row) {
            $userData = array_combine($header, $row);

            User::create([
                'name' => $userData['name'],
                'email' => $userData['email'],
                'password' => bcrypt($userData['password']),
            ]);
        }

        return redirect()->back()->with('success', 'Users imported successfully.');
    }
}


// class UserController extends Controller
// {
//     public function index()
//     {
//         $users = User::all();
//         return view('admin.users.index', compact('users'));
//     }

//     // Show the form for creating a new user
//     public function create()
//     {
//         return view('admin.users.create');
//     }

//     // Store a new user in the database
//     public function store(Request $request)
//     {
//         $validated = $request->validate([
//             'name' => 'required|string|max:255',
//             'email' => 'required|string|email|max:255|unique:users',
//             'password' => 'required|string|min:8|confirmed',
//         ]);

//         User::create([
//             'name' => $validated['name'],
//             'email' => $validated['email'],
//             'password' => bcrypt($validated['password']),
//         ]);

//         return redirect()->route('admin.users.index')->with('success', 'User created successfully.');
//     }

//     // Show the form for editing a user's details
//     public function edit($id)
//     {
//         $user = User::findOrFail($id);
//         return view('admin.users.edit', compact('user'));
//     }

//     // Update an existing user's details
//     public function update(Request $request, $id)
//     {
//         $user = User::findOrFail($id);

//         $validated = $request->validate([
//             'name' => 'required|string|max:255',
//             'email' => 'required|string|email|max:255|unique:users,email,' . $id,
//         ]);

//         $user->update($validated);

//         return redirect()->route('admin.users.index')->with('success', 'User updated successfully.');
//     }

//     // Delete a user from the database
//     public function destroy($id)
//     {
//         $user = User::findOrFail($id);
//         $user->delete();

//         return redirect()->route('admin.users.index')->with('success', 'User deleted successfully.');
//     }
// }
