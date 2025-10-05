<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;
use Illuminate\Validation\Rule;

class ProfileSetupController extends Controller
{
    /**
     * Show the profile completion form.
     */
    public function show()
    {
        $user = Auth::user();
        
        // If profile is already completed, redirect to propositions
        if ($user->profile_completed) {
            return redirect()->route('propositions.index');
        }

        return view('auth.complete-profile');
    }

    /**
     * Store the completed profile.
     */
    public function store(Request $request)
    {
        $user = Auth::user();

        $validated = $request->validate([
            'nickname' => [
                'required',
                'string',
                'max:50',
                'min:3',
                'regex:/^[a-zA-Z0-9_-]+$/',
                Rule::unique('users')->ignore($user->id),
            ],
            'profile_picture' => [
                'nullable',
                'image',
                'mimes:jpeg,jpg,png,gif',
                'max:2048', // 2MB max
            ],
        ], [
            'nickname.regex' => 'Nickname can only contain letters, numbers, hyphens and underscores.',
            'nickname.unique' => 'This nickname is already taken.',
            'nickname.min' => 'Nickname must be at least 3 characters.',
            'profile_picture.max' => 'Profile picture must be less than 2MB.',
        ]);

        // Handle profile picture upload
        if ($request->hasFile('profile_picture')) {
            // Delete old profile picture if exists
            if ($user->profile_picture) {
                Storage::disk('public')->delete($user->profile_picture);
            }

            // Store new profile picture
            $path = $request->file('profile_picture')->store('profile-pictures', 'public');
            $validated['profile_picture'] = $path;
        }

        // Update user
        $user->update([
            'nickname' => $validated['nickname'],
            'profile_picture' => $validated['profile_picture'] ?? $user->profile_picture,
            'profile_completed' => true,
        ]);

        return redirect()->route('propositions.index')
            ->with('success', 'Profile completed successfully! Welcome to Campus Voice.');
    }
}
