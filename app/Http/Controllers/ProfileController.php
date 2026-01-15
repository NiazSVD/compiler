<?php

namespace App\Http\Controllers;

use App\Helpers\UploadHelper;
use App\Models\Team;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Redirect;
use Illuminate\Support\Facades\Hash;

class ProfileController extends Controller
{
    /**
     * Show profile edit page
     */
    public function index()
    {
        $user = Auth::user();

        return view('backend.profile.edit', compact('user'));
    }

    /**
     * Update profile info + password + avatar
     */

    public function update(Request $request)
    {
        $user = $request->user();

        $rules = [
            'name' => 'required|string|max:255',
            'email' => 'nullable|email',
            'phone' => 'required|string|max:20',
            'password' => 'nullable|min:6|confirmed',
            'profile_image' => 'nullable|image|mimes:jpg,jpeg,png,webp|max:2048',
        ];

        $data  = $request->validate($rules);

        $user->name = $request->name;
        $user->email = $request->email;
        $user->phone = $request->phone;


        $user->avater = UploadHelper::handleUpload($request->file('profile_image'), 'uploads/profile/', $user->avater);

        if ($request->password) {
            $user->password = Hash::make($request->password);
        }

        $user->save();

        return redirect()->route('profile')->with('success', 'Profile updated successfully');
    }
}
