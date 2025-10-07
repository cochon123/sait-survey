<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Support\Facades\Auth;
use Carbon\Carbon;

class Proposition extends Model
{
    use HasFactory;
    protected $fillable = [
        'user_id',
        'content',
        'status',
        'upvotes',
        'downvotes',
    ];

    public function user(): BelongsTo
    {
        return $this->belongsTo(User::class);
    }

    public function votes(): HasMany
    {
        return $this->hasMany(PropositionVote::class);
    }

    public function comments(): HasMany
    {
        return $this->hasMany(Comment::class);
    }

    /**
     * Check if the authenticated user has voted on this proposition
     */
    public function hasUserVoted($userId = null): bool
    {
        $userId = $userId ?? Auth::id();
        if (!$userId) {
            return false;
        }

        return $this->votes()->where('user_id', $userId)->exists();
    }

    /**
     * Get the vote type of the authenticated user for this proposition
     */
    public function getUserVoteType($userId = null): ?string
    {
        $userId = $userId ?? Auth::id();
        if (!$userId) {
            return null;
        }

        $vote = $this->votes()->where('user_id', $userId)->first();
        return $vote ? $vote->vote_type : null;
    }

    /**
     * Check if a user can create a new proposition today
     */
    public static function canUserCreatePropositionToday($userId = null): bool
    {
        $userId = $userId ?? Auth::id();
        if (!$userId) {
            return false;
        }

        $today = Carbon::today();
        $propositionToday = static::where('user_id', $userId)
            ->whereDate('created_at', $today)
            ->exists();

        return !$propositionToday;
    }
}
