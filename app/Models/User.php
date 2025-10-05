<?php

namespace App\Models;

// use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;

class User extends Authenticatable
{
    /** @use HasFactory<\Database\Factories\UserFactory> */
    use HasFactory, Notifiable;

    /**
     * The attributes that are mass assignable.
     *
     * @var list<string>
     */
    protected $fillable = [
        'name',
        'email',
        'password',
        'nickname',
        'profile_picture',
        'profile_completed',
        'google_id',
        'is_admin',
    ];

    /**
     * The attributes that should be hidden for serialization.
     *
     * @var list<string>
     */
    protected $hidden = [
        'password',
        'remember_token',
    ];

    /**
     * Get the attributes that should be cast.
     *
     * @return array<string, string>
     */
    protected function casts(): array
    {
        return [
            'email_verified_at' => 'datetime',
            'password' => 'hashed',
            'profile_completed' => 'boolean',
            'is_admin' => 'boolean',
        ];
    }

    /**
     * Get the user's display name (nickname or name).
     */
    public function getDisplayNameAttribute(): string
    {
        return $this->nickname ?? $this->name;
    }

    /**
     * Get the user's profile picture URL.
     */
    public function getProfilePictureUrlAttribute(): string
    {
        return $this->profile_picture 
            ? asset('storage/' . $this->profile_picture)
            : asset('image/default-avatar.svg');
    }

    public function propositions()
    {
        return $this->hasMany(Proposition::class);
    }

    public function votes()
    {
        return $this->hasMany(PropositionVote::class);
    }
}
