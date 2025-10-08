<?php

namespace App\Http\Controllers;

use App\Models\Proposition;
use App\Models\PropositionVote;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class PropositionController extends Controller
{
    public function index(Request $request)
    {
        $sort = $request->get('sort', 'recent');
        $perPage = 15;

        $query = Proposition::with(['user', 'comments.user']);

        if ($sort === 'top') {
            $query->orderBy('upvotes', 'desc')->orderBy('created_at', 'desc');
        } else {
            $query->orderBy('created_at', 'desc');
        }

        $propositions = $query->paginate($perPage);

        // Check if there's a pending proposition from authentication
        if (session()->has('pending_proposition') && Auth::check()) {
            $pendingProposition = session('pending_proposition');
            session()->forget('pending_proposition'); // Clear it so it doesn't repeat

            // Create the proposition automatically
            $proposition = Proposition::create([
                'user_id' => Auth::id(),
                'content' => $pendingProposition,
            ]);

            // Flash the new proposition ID for highlighting
            session()->flash('new_proposition_id', $proposition->id);

            // Re-fetch propositions to include the new one
            $propositions = $query->paginate($perPage);
        }

        if ($request->ajax()) {
            return response()->json([
                'html' => view('propositions.partials._propositions-list', compact('propositions'))->render(),
                'hasMore' => $propositions->hasMorePages(),
                'nextPage' => $propositions->currentPage() + 1,
                'total' => $propositions->total()
            ]);
        }

        return view('propositions', compact('propositions'));
    }

    public function loadMore(Request $request)
    {
        $sort = $request->get('sort', 'recent');
        $page = $request->get('page', 2);
        $perPage = 15;

        $query = Proposition::with(['user', 'comments.user']);

        if ($sort === 'top') {
            $query->orderBy('upvotes', 'desc')->orderBy('created_at', 'desc');
        } else {
            $query->orderBy('created_at', 'desc');
        }

        $propositions = $query->paginate($perPage, ['*'], 'page', $page);

        return response()->json([
            'html' => view('propositions.partials._propositions-list', compact('propositions'))->render(),
            'hasMore' => $propositions->hasMorePages(),
            'nextPage' => $propositions->currentPage() + 1,
            'total' => $propositions->total()
        ]);
    }

    public function store(Request $request)
    {
        $request->validate([
            'content' => 'required|string|max:1000',
        ]);

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

        return $this->toggleVote($proposition, $userId, 'upvote');
    }

    public function downvote(Proposition $proposition)
    {
        $userId = Auth::id();

        // Check if user is authenticated
        if (!$userId) {
            return response()->json(['error' => 'Authentication required'], 401);
        }

        return $this->toggleVote($proposition, $userId, 'downvote');
    }

    /**
     * Toggle vote for a proposition
     *
     * @param Proposition $proposition
     * @param int $userId
     * @param string $voteType
     * @return \Illuminate\Http\JsonResponse
     */
    private function toggleVote(Proposition $proposition, int $userId, string $voteType)
    {
        // Determine the opposite vote type
        $oppositeVoteType = $voteType === 'upvote' ? 'downvote' : 'upvote';

        // Check if user has already voted
        if ($proposition->hasUserVoted($userId)) {
            $currentVote = $proposition->getUserVoteType($userId);

            if ($currentVote === $voteType) {
                // User is trying to vote the same way again - remove the vote (toggle)
                PropositionVote::where('user_id', $userId)
                    ->where('proposition_id', $proposition->id)
                    ->delete();

                // Update vote counts based on vote type
                if ($voteType === 'upvote') {
                    $proposition->decrement('upvotes');
                } else {
                    $proposition->decrement('downvotes');
                }
            } else {
                // User had opposite vote, now switching - update vote and adjust both counts
                PropositionVote::where('user_id', $userId)
                    ->where('proposition_id', $proposition->id)
                    ->update(['vote_type' => $voteType]);

                // Update vote counts (increment current vote, decrement opposite vote)
                if ($voteType === 'upvote') {
                    $proposition->increment('upvotes');
                    $proposition->decrement('downvotes');
                } else {
                    $proposition->increment('downvotes');
                    $proposition->decrement('upvotes');
                }
            }
        } else {
            // New vote
            PropositionVote::create([
                'user_id' => $userId,
                'proposition_id' => $proposition->id,
                'vote_type' => $voteType
            ]);

            // Update vote counts based on vote type
            if ($voteType === 'upvote') {
                $proposition->increment('upvotes');
            } else {
                $proposition->increment('downvotes');
            }
        }

        return response()->json([
            'upvotes' => $proposition->fresh()->upvotes,
            'downvotes' => $proposition->fresh()->downvotes
        ]);
    }

    public function destroy(Proposition $proposition)
    {
        // Check if user is authenticated
        if (!Auth::check()) {
            return response()->json(['error' => 'Authentication required'], 401);
        }

        // Check if the authenticated user is the creator of the proposition
        if ($proposition->user_id !== Auth::id()) {
            return response()->json(['error' => 'Unauthorized'], 403);
        }

        // Delete the proposition
        $proposition->delete();

        return response()->json(['success' => true, 'message' => 'Proposition deleted successfully']);
    }
}
