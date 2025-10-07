<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class ProfileCompletionController extends Controller
{
    /**
     * Show the form to complete the user profile.
     */
    public function create()
    {
        return view('profile.complete');
    }

    /**
     * Store the completed profile information.
     */
    public function store(Request $request)
    {
        $request->validate([
            'nickname' => 'required|string|max:25|unique:users,nickname,' . Auth::id(),
        ]);

        $user = Auth::user();
        $user->nickname = $request->input('nickname');
        $user->save();

        // Redirect to the originally intended page or a default page
        return redirect()->intended(route('propositions.index'));
    }
}
