@props(['proposition'])

<div class="frosted-card p-6 proposition-card transition-all duration-300 hover:shadow-frosted-m @if(session('new_proposition_id') == $proposition->id) ring-2 ring-brand @endif" data-id="{{ $proposition->id }}" data-upvotes="{{ $proposition->upvotes }}" data-downvotes="{{ $proposition->downvotes }}" data-created="{{ $proposition->created_at->timestamp }}">
    <div class="mb-1">
        <!-- Header with profile picture and user info -->
        <div class="flex items-center mb-3">
            <img src="{{ $proposition->user->profile_picture_url }}" alt="{{ $proposition->user->display_name }}" class="w-10 h-10 rounded-full mr-3 object-cover">
            <div>
                <div class="flex items-center">
                    <span class="font-medium text-primary">{{ $proposition->user->display_name }}</span>
                    @if(Auth::user() && Auth::user()->is_admin ?? false)
                        <span class="ml-2 text-sm text-muted">({{ $proposition->user->email }})</span>
                    @endif
                </div>
                <span class="text-xs text-muted">{{ $proposition->created_at->diffForHumans() }}</span>
            </div>
        </div>

        <!-- Proposition content -->
        <p class="text-primary mb-4">{{ $proposition->content }}</p>

        <!-- Action buttons (horizontal layout at bottom) -->
        <div class="flex items-center gap-2 pt-3">
            @auth
                <button class="upvote-btn frosted-input flex items-center space-x-1 px-3 py-2 rounded-xl transition-all duration-200 hover:shadow-frosted-s" data-id="{{ $proposition->id }}">
                    <svg class="w-4 h-4 text-green-500" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 15l7-7 7 7"></path>
                    </svg>
                    <span class="upvote-count text-sm font-semibold text-green-500">{{ $proposition->upvotes }}</span>
                </button>
                <button class="downvote-btn frosted-input flex items-center space-x-1 px-3 py-2 rounded-xl transition-all duration-200 hover:shadow-frosted-s" data-id="{{ $proposition->id }}">
                    <svg class="w-4 h-4 text-red-500" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 9l-7 7-7-7"></path>
                    </svg>
                    <span class="downvote-count text-sm font-semibold text-red-500">{{ $proposition->downvotes }}</span>
                </button>
                <button class="comment-toggle-btn frosted-input flex items-center space-x-2 px-3 py-2 rounded-xl transition-all duration-200 hover:shadow-frosted-s" data-id="{{ $proposition->id }}">
                    <svg class="w-4 h-4 text-primary" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 12h.01M12 12h.01M16 12h.01M21 12c0 4.418-4.03 8-9 8a9.863 9.863 0 01-4.255-.949L3 20l1.395-3.72C3.512 15.042 3 13.574 3 12c0-4.418 4.03-8 9-8s9 3.582 9 8z"></path>
                    </svg>
                    <span class="text-sm text-primary">Comment</span>
                    <span class="comment-count text-sm font-semibold text-primary">({{ $proposition->comments->count() }})</span>
                </button>
                @if($proposition->user_id === Auth::id())
                    <button class="delete-btn frosted-input flex items-center justify-center p-2 rounded-xl transition-all duration-200 hover:shadow-frosted-s ml-auto" data-id="{{ $proposition->id }}" title="Delete proposition">
                        <svg class="w-4 h-4 text-muted hover:text-red-500 transition-colors" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-6v6m1-10V4a1 1 0 00-1-1h-4a1 1 0 00-1 1v3M4 7h16"></path>
                        </svg>
                    </button>
                @endif
            @else
                <div class="flex items-center gap-2">
                    <div class="frosted-input flex items-center space-x-1 px-3 py-2 rounded-xl opacity-60 cursor-not-allowed">
                        <svg class="w-4 h-4 text-muted" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 15l7-7 7 7"></path>
                        </svg>
                        <span class="text-sm font-medium text-muted">{{ $proposition->upvotes }}</span>
                    </div>
                    <div class="frosted-input flex items-center space-x-1 px-3 py-2 rounded-xl opacity-60 cursor-not-allowed">
                        <svg class="w-4 h-4 text-muted" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 9l-7 7-7-7"></path>
                        </svg>
                        <span class="text-sm font-medium text-muted">{{ $proposition->downvotes }}</span>
                    </div>
                    <div class="frosted-input flex items-center space-x-2 px-3 py-2 rounded-xl opacity-60 cursor-not-allowed">
                        <svg class="w-4 h-4 text-muted" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 12h.01M12 12h.01M16 12h.01M21 12c0 4.418-4.03 8-9 8a9.863 9.863 0 01-4.255-.949L3 20l1.395-3.72C3.512 15.042 3 13.574 3 12c0-4.418 4.03-8 9-8s9 3.582 9 8z"></path>
                        </svg>
                        <span class="text-sm text-muted">Comment</span>
                        <span class="text-sm font-medium text-muted">({{ $proposition->comments->count() }})</span>
                    </div>
                </div>
            @endauth
        </div>

        <!-- Comments Section (initially hidden) -->
        <div class="comments-section hidden mt-4 pt-4 border-t border-muted/20" data-proposition-id="{{ $proposition->id }}">
            <!-- Comments list -->
            <div class="comments-list space-y-3 mb-4">
                @foreach($proposition->comments as $comment)
                    <div class="comment-item flex gap-3" data-comment-id="{{ $comment->id }}">
                        <img src="{{ $comment->user->profile_picture_url }}" alt="{{ $comment->user->display_name }}" class="w-8 h-8 rounded-full object-cover flex-shrink-0">
                        <div class="flex-1">
                            <div class="flex items-center gap-2 mb-1">
                                <span class="font-medium text-primary text-sm">{{ $comment->user->display_name }}</span>
                                <span class="text-xs text-muted">{{ $comment->created_at->diffForHumans() }}</span>
                                @if(Auth::check() && ($comment->user_id === Auth::id() || Auth::user()->is_admin))
                                    <button class="delete-comment-btn text-xs text-muted hover:text-red-500 ml-auto" data-comment-id="{{ $comment->id }}">
                                        <svg class="w-3 h-3" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-6v6m1-10V4a1 1 0 00-1-1h-4a1 1 0 00-1 1v3M4 7h16"></path>
                                        </svg>
                                    </button>
                                @endif
                            </div>
                            <p class="text-primary text-sm">{{ $comment->content }}</p>
                        </div>
                    </div>
                @endforeach
            </div>

            @auth
                <!-- Comment form -->
                <form class="comment-form flex gap-2" data-proposition-id="{{ $proposition->id }}">
                    @csrf
                    <img src="{{ Auth::user()->profile_picture_url }}" alt="{{ Auth::user()->display_name }}" class="w-8 h-8 rounded-full object-cover flex-shrink-0">
                    <input type="text" name="content" placeholder="Add a comment..." maxlength="500" required class="form-input flex-1 text-sm">
                    <button type="submit" class="btn-primary px-3 py-2 text-sm rounded-xl">
                        <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 19l9 2-9-18-9 18 9-2zm0 0v-8"></path>
                        </svg>
                    </button>
                </form>
            @endauth
        </div>
    </div>
</div>