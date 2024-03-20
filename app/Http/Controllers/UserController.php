<?php

namespace App\Http\Controllers;

use App\Models\Carousel;
use App\Models\Content;
use App\Models\Gallery;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;


class UserController extends Controller
{
    public function index()
{
    // Assuming 'role_user' is a column in the users table
    $users = User::where('role_user', '!=', 'Superuser')->get();
    $formMethod = 'store';

    return view('superuser.superuser', compact('users','formMethod'));
}


    public function show($id)
    {
        $user = User::find($id);

        if (!$user) {
            return response()->json(['error' => 'User not found'], 404);
        }

        return response()->json($user);
    }
    public function storeOrUpdate(Request $request)
{
    $formMethod = $request->get('formMethod');

    try {
        if ($formMethod === "store") {
            // Validation for store operation
            $request->validate([
                'role_user' => 'required',
                'nama_user' => 'required',
                'email' => 'required',
                'password' => 'required',
                'status' => 'required',
                'email_user' => 'required',
            ]);

            $userData = [
                'role_user' => $request->role_user,
                'nama_user' => $request->nama_user,
                'email' => $request->email,
                'status' => $request->status,
                'password' => Hash::make($request->password),
                'email_user' => $request->email_user,
            ];

            // Store new user
            User::create($userData);

            return redirect()->route('superuser')->with('success', 'User created successfully');
        } elseif ($formMethod === "update") {
            // Validation for update operation
            $request->validate([
                'role_user' => 'required',
                'nama_user' => 'required',
                'email' => 'required',
                'status' => 'required',
            ]);

            $userId = $request->input('user_id');

            // Fetch the existing user
            $user = User::find($userId);

            if (!$user) {
                return redirect()->route('superuser')->with('error', 'User not found');
            }

            $userData = [
                'role_user' => $request->role_user,
                'nama_user' => $request->nama_user,
                'email' => $request->email,
                'status' => $request->status,
                'email_user' => $request->email_user,
            ];
            
            if ($user->role_user!= $userData['role_user'] || $user->nama_user != $userData['nama_user'] || 
                $user->email != $userData['email'] || $user->status != $userData['status'] || $user->status != $userData['email_user']) {
                // Update user data only if a new password is provided
                if ($request->filled('password')) {
                    $userData['password'] = Hash::make($request->password);
                }
                $user->update($userData);

                return redirect()->route('superuser')->with('success', 'User updated successfully');
            } else {
                // Tidak ada perubahan yang dilakukan
                return redirect()->route('superuser')->with('message', 'No changes made to the user');            
            }
        }
    } catch (\Illuminate\Validation\ValidationException $e) {
        $errors = $e->errors();
        return back()->withErrors($errors)->withInput();
    } catch (\Exception $e) {
        return back()->with('error', 'An error occurred while processing the request');
    }
}

    
    public function update(Request $request, $id)
    {
        try {
            $user = User::findOrFail($id);
    
            // Check if old password, new password, and profile picture are all empty
            if (
                empty($request->old_password) &&
                empty($request->new_password) &&
                !$request->hasFile('profile_picture')
            ) {
                return redirect()->route('editProfil', ['id' => $user->id])->with('error', 'No changes made to the profile');
            }
    
            $request->validate([
                'password' => 'sometimes|required|confirmed',
                'profile_picture' => 'image|mimes:jpeg,png,jpg,gif|max:2048',
            ]);
    
            // Check if the provided old password matches the hashed password in the database
            if ($request->filled('old_password') && !Hash::check($request->old_password, $user->password)) {
                return redirect()->route('editProfil', ['id' => $user->id])->with('error_oldPass', 'Old password is incorrect');
            }
    
            $userData = [
                'nama_user' => $user->nama_user,
                'email_user' => $user->email_user,
            ];
    
            // Check if the new password is provided
            if ($request->filled('new_password')) {
                // Check if new password matches confirmation
                if ($request->new_password !== $request->password_confirmation) {
                    return redirect()->route('editProfil', ['id' => $user->id])->with('error_newPass', 'New password and confirmation do not match');
                }
    
                // Check if new password is the same as the existing password
                if (Hash::check($request->new_password, $user->password)) {
                    return redirect()->route('editProfil', ['id' => $user->id])->with('error_newPass', 'New password must be different from the current password');
                }
    
                // Validate new password confirmation
                $request->validate([
                    'password_confirmation' => 'required|same:new_password',
                ]);
    
                $userData['password'] = Hash::make($request->new_password);
            }
    
            if ($request->hasFile('profile_picture')) {
                $imagePath = $request->file('profile_picture')->store('profile_pictures', 'public');
                $userData['profile_picture'] = $imagePath;
            }
    
            // Check if new password or profile picture has changed
            if (isset($userData['password']) || isset($userData['profile_picture'])) {
                $user->update($userData);
                return redirect()->route('editProfil', ['id' => $user->id])->with('success', 'Profile updated successfully');
            } else {
                // No changes were made
                return redirect()->route('editProfil', ['id' => $user->id])->with('error', 'Failed to update profile. No changes made.');
            }
        } catch (\Exception $e) {
            return redirect()->route('editProfil', ['id' => $user->id])->with('error', 'Failed to update profile');
        }
    }
    



    public function editProfile($id)
    {
        // Retrieve user information based on $id
        $user = User::find($id);

        // Pass the $user data to the view
        return view('editProfile', ['user' => $user]);
    }


    public function delete($id)
    {
        $user = User::find($id);

        if ($user) {
            try {
                $user->delete();
                return redirect()->route('admin.userManagement')->with('success', 'User deleted successfully');
            } catch (\Exception $e) {
                // Handle any exceptions here, e.g., log the error
                return redirect()->route('admin.userManagement')->with('error', 'Failed to delete user');
            }
        }

        return redirect()->route('admin.userManagement')->with('error', 'User not found');
    }
    public function deleteUsermanagement($id)
    {
        $user = User::find($id);

        if ($user) {
            try {
                $user->delete();
                return redirect()->route('superuser')->with('success', 'User deleted successfully');
            } catch (\Exception $e) {
                // Handle any exceptions here, e.g., log the error
                return redirect()->route('superuser')->with('error', 'Failed to delete user');
            }
        }

        return redirect()->route('superuser')->with('error', 'User not found');
    }
}

    