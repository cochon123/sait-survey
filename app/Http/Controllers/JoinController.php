<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Http\RedirectResponse;
use Illuminate\View\View;
use App\Mail\JoinApplicationMail;
use Illuminate\Support\Facades\Mail;

class JoinController extends Controller
{
    /**
     * Display the join form.
     */
    public function index(): View
    {
        return view('join');
    }

    /**
     * Handle the join form submission and send email.
     */
    public function submit(Request $request): RedirectResponse
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'program' => 'required|string|max:255',
            'competence' => 'nullable|string',
        ]);

        // Send email
        Mail::to('tchiosemepierrearthur@gmail.com')
            ->send(new JoinApplicationMail($request->name, $request->program, $request->competence));

        return redirect()->route('join')->with('status', 'thank-you');
    }
}