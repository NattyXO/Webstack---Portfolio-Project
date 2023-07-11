<?php

namespace App\Http\Controllers;

use App\User;
use Illuminate\Http\Request;

class ProfileController extends Controller
{
    public function editProfile(Request $request)
    {
        $field = $request->validate([
            'phone_number' => 'required',
            'profile_pic' => 'required|image|mimes:jpg,png,jpeg,gif,svg|max:2048',
            'bio' => 'required',
        ]);
        
        $user = User::find(auth()->user()->id);

        // $path = $file->store('public/files');
        // $name = $file->getClientOriginalName();

        $image_path = $request->file('profile_pic')->store('image', 'public');

        if ($user->profile == null) {
            $profile = $user->profile()->create([
                'phone_number' => $field['phone_number'],
                'profile_pic' => $image_path,
                'bio' => $field['bio'],
            ]);
        } else {
            $profile = $user->profile()->update([
                'phone_number' => $field['phone_number'],
                'profile_pic' => $image_path,
                'bio' => $field['bio'],
            ]);
            $profile = $user->profile;
        }

        $response = [
            'response' => 200,
            'message' => 'Profile updated successfully !',
            'profile' => $profile
        ];
        return response($response, 201);
    }

    public function getProfile(Request $request)
    {
        $user = User::find(auth()->user()->id);
        return $user->profile;
    }
}
