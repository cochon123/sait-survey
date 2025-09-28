<?php

namespace App\Http\Controllers;

use App\Models\Proposition;
use App\Models\PropositionVote;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class PropositionController extends Controller
{
    public function index()
    {
        $propositions = Proposition::with('user')
            ->orderBy('created_at', 'desc')
            ->get();

        // Check if there's a pending proposition from authentication
        if (session()->has('pending_proposition') && Auth::check()) {
            $pendingProposition = session('pending_proposition');
            session()->forget('pending_proposition'); // Clear it so it doesn't repeat

            // Check if user can create a proposition today
            if (Proposition::canUserCreatePropositionToday()) {
                // Create the proposition automatically
                $proposition = Proposition::create([
                    'user_id' => Auth::id(),
                    'content' => $pendingProposition,
                ]);

                // Flash the new proposition ID for highlighting
                session()->flash('new_proposition_id', $proposition->id);
            } else {
                // User already created a proposition today
                session()->flash('error', 'Vous ne pouvez créer qu\'une proposition par jour.');
            }

            // Re-fetch propositions to include the new one
            $propositions = Proposition::with('user')
                ->orderBy('created_at', 'desc')
                ->get();
        }

        return view('propositions', compact('propositions'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'content' => 'required|string|max:1000',
        ]);

        // Check if user can create a proposition today
        if (!Proposition::canUserCreatePropositionToday()) {
            return redirect()->back()->withErrors(['content' => 'Vous ne pouvez créer qu\'une proposition par jour.']);
        }

        $proposition = Proposition::create([
            'user_id' => Auth::id(),
            'content' => $request->input('content'),
        ]);

        // Check if this is a pending proposition from guest authentication
        if ($request->has('pending_proposition') && $request->pending_proposition) {
            // This was a guest proposition, mark it as special for styling
            session()->flash('new_proposition_id', $proposition->id);
        }

        return redirect()->back()->with('success', 'Proposition created successfully!');
    }

    public function upvote(Proposition $proposition)
    {
        $userId = Auth::id();
        
        // Check if user is authenticated
        if (!$userId) {
            return response()->json(['error' => 'Authentication required'], 401);
        }

        // Check if user has already voted
        if ($proposition->hasUserVoted($userId)) {
            $currentVote = $proposition->getUserVoteType($userId);
            
            if ($currentVote === 'upvote') {
                // User is trying to upvote again - do nothing
                return response()->json([
                    'message' => 'Vous avez déjà voté pour cette proposition',
                    'upvotes' => $proposition->upvotes,
                    'downvotes' => $proposition->downvotes
                ]);
            } else {
                // User had downvoted, now switching to upvote
                PropositionVote::where('user_id', $userId)
                    ->where('proposition_id', $proposition->id)
                    ->update(['vote_type' => 'upvote']);
                
                $proposition->increment('upvotes');
                $proposition->decrement('downvotes');
            }
        } else {
            // New vote
            PropositionVote::create([
                'user_id' => $userId,
                'proposition_id' => $proposition->id,
                'vote_type' => 'upvote'
            ]);
            
            $proposition->increment('upvotes');
        }

        return response()->json([
            'upvotes' => $proposition->fresh()->upvotes,
            'downvotes' => $proposition->fresh()->downvotes
        ]);
    }

    public function downvote(Proposition $proposition)
    {
        $userId = Auth::id();
        
        // Check if user is authenticated
        if (!$userId) {
            return response()->json(['error' => 'Authentication required'], 401);
        }

        // Check if user has already voted
        if ($proposition->hasUserVoted($userId)) {
            $currentVote = $proposition->getUserVoteType($userId);
            
            if ($currentVote === 'downvote') {
                // User is trying to downvote again - do nothing
                return response()->json([
                    'message' => 'Vous avez déjà voté contre cette proposition',
                    'upvotes' => $proposition->upvotes,
                    'downvotes' => $proposition->downvotes
                ]);
            } else {
                // User had upvoted, now switching to downvote
                PropositionVote::where('user_id', $userId)
                    ->where('proposition_id', $proposition->id)
                    ->update(['vote_type' => 'downvote']);
                
                $proposition->increment('downvotes');
                $proposition->decrement('upvotes');
            }
        } else {
            // New vote
            PropositionVote::create([
                'user_id' => $userId,
                'proposition_id' => $proposition->id,
                'vote_type' => 'downvote'
            ]);
            
            $proposition->increment('downvotes');
        }

        return response()->json([
            'upvotes' => $proposition->fresh()->upvotes,
            'downvotes' => $proposition->fresh()->downvotes
        ]);
    }
}
