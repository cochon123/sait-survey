<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Profile - Campus Voice</title>

    <!-- Fonts -->
    <link rel="preconnect" href="https://fonts.bunny.net">
    <link href="https://fonts.bunny.net/css?family=instrument-sans:400,500,600" rel="stylesheet" />

    <!-- Styles / Scripts -->
    @vite(['resources/css/app.css', 'resources/js/app.js'])

    <!-- CSRF Token -->
    <meta name="csrf-token" content="{{ csrf_token() }}">
</head>
<body class="depth-layer-1 min-h-screen pb-24">
    <!-- Main Content -->
    <main class="max-w-4xl mx-auto px-4 sm:px-6 lg:px-8 py-8">
        <!-- App Header with Logo -->
        <div class="frosted-card p-6 mb-8">
            <div class="flex items-center justify-between">
                <div class="flex items-center">
                    <img src="{{ asset('image/campus_voice.png') }}" alt="Campus Voice Logo" class="h-12 w-auto mr-4">
                    <div>
                        <h1 class="text-2xl font-bold text-primary">My Profile</h1>
                        <p class="text-muted text-sm">Manage your account settings</p>
                    </div>
                </div>
                <div class="flex space-x-3">
                </div>
            </div>
        </div>

        <div class="max-w-4xl mx-auto">
            <!-- Success Message -->
            @if (session('success'))
                <div class="mb-6 p-4 rounded-lg frosted-card" style="border-left: 4px solid var(--brand);">
                    <p class="text-sm font-medium" style="color: var(--brand);">{{ session('success') }}</p>
                </div>
            @endif

            <!-- Profile Information -->
            <div class="frosted-card p-8 mb-6">
                <div class="flex flex-col md:flex-row gap-8">
                    <!-- Profile Picture Section -->
                    <div class="flex flex-col items-center md:w-1/3">
                        <div class="relative mb-4">
                            <img id="profilePreview"
                                 src="{{ $user->profile_picture_url }}"
                                 alt="Profile Picture"
                                 class="w-40 h-40 rounded-full object-cover frosted-card ring-4 ring-opacity-20"
                                 style="ring-color: var(--brand);">
                            <label for="profile_picture_input"
                                   class="absolute bottom-2 right-2 p-3 rounded-full cursor-pointer hover:scale-110 transition-transform shadow-lg"
                                   style="background: var(--brand); color: hsl(0, 0%, 10%);"
                                   title="Change profile picture">
                                <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 9a2 2 0 012-2h.93a2 2 0 001.664-.89l.812-1.22A2 2 0 0110.07 4h3.86a2 2 0 011.664.89l.812 1.22A2 2 0 0018.07 7H19a2 2 0 012 2v9a2 2 0 01-2 2H5a2 2 0 01-2-2V9z"></path>
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 13a3 3 0 11-6 0 3 3 0 016 0z"></path>
                                </svg>
                            </label>
                        </div>
                        <p class="text-xs text-center" style="color: var(--text-muted);">
                            Max 2MB • JPG, PNG, GIF
                        </p>
                    </div>

                    <!-- Profile Form -->
                    <div class="flex-1">
                        <h3 class="text-lg font-semibold mb-6" style="color: var(--text);">Profile Information</h3>

                        <form id="profileForm" method="POST" action="{{ route('profile.update') }}" enctype="multipart/form-data" class="space-y-6">
                            @csrf
                            @method('PATCH')

                            <input type="file"
                                   id="profile_picture_input"
                                   name="profile_picture"
                                   accept="image/*"
                                   class="hidden">

                            <!-- Nickname -->
                            <div>
                                <label for="nickname" class="block text-sm font-medium mb-2" style="color: var(--text);">
                                    Nickname <span style="color: var(--brand);">*</span>
                                </label>
                                <input id="nickname"
                                       type="text"
                                       name="nickname"
                                       value="{{ old('nickname', $user->nickname) }}"
                                       required
                                       maxlength="50"
                                       class="frosted-input w-full px-4 py-2 rounded-lg focus:outline-none focus:ring-2 transition-all"
                                       style="color: var(--text); --tw-ring-color: var(--brand);"
                                       placeholder="Your unique nickname">
                                @error('nickname')
                                    <p class="mt-1 text-sm" style="color: hsl(0, 70%, 60%);">{{ $message }}</p>
                                @enderror
                                <p class="mt-1 text-xs" style="color: var(--text-muted);">
                                    This is how other students will see you
                                </p>
                            </div>

                            <!-- Name (Read-only) -->
                            <div>
                                <label for="name" class="block text-sm font-medium mb-2" style="color: var(--text);">
                                    Full Name
                                </label>
                                <input id="name"
                                       type="text"
                                       value="{{ $user->name }}"
                                       disabled
                                       class="frosted-input w-full px-4 py-2 rounded-lg opacity-60 cursor-not-allowed"
                                       style="color: var(--text-muted);">
                                <p class="mt-1 text-xs" style="color: var(--text-muted);">
                                    From your Google account
                                </p>
                            </div>

                            <!-- Email (Read-only) -->
                            <div>
                                <label for="email" class="block text-sm font-medium mb-2" style="color: var(--text);">
                                    Email
                                </label>
                                <input id="email"
                                       type="email"
                                       value="{{ $user->email }}"
                                       disabled
                                       class="frosted-input w-full px-4 py-2 rounded-lg opacity-60 cursor-not-allowed"
                                       style="color: var(--text-muted);">
                                <p class="mt-1 text-xs" style="color: var(--text-muted);">
                                    From your Google account
                                </p>
                            </div>

                            <!-- Save Button -->
                            <div class="flex items-center justify-end pt-4">
                                <button type="submit"
                                        class="py-3 px-8 rounded-lg font-semibold text-center transition-all hover:scale-[1.02] active:scale-[0.98]"
                                        style="background: var(--brand); color: hsl(0, 0%, 10%); box-shadow: var(--shadow-s);">
                                    Save Changes
                                </button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>

            <!-- Account Statistics -->
            <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                <div class="frosted-card p-6 text-center">
                    <div class="text-3xl font-bold mb-2" style="color: var(--brand);">{{ $user->propositions->count() }}</div>
                    <div class="text-sm" style="color: var(--text-muted);">Propositions</div>
                </div>
                <div class="frosted-card p-6 text-center">
                    <div class="text-3xl font-bold mb-2" style="color: var(--brand);">{{ $user->votes->count() }}</div>
                    <div class="text-sm" style="color: var(--text-muted);">Votes Cast</div>
                </div>
            </div>

            <!-- User's Propositions -->
            <br />
            @if($propositions->count() > 0)
                <h3 class="text-lg font-semibold mb-6" style="color: var(--text);">My Propositions</h3>
                <div class="space-y-4">
                    @foreach($propositions as $proposition)
                        <x-proposition-card :proposition="$proposition" />
                    @endforeach
                </div>
            @endif
            <br

            <!-- Delete Account Section -->
            <div class="frosted-card p-8">
                <h3 class="text-lg font-semibold mb-4" style="color: hsl(0, 70%, 60%);">Danger Zone</h3>
                <p class="text-sm mb-4" style="color: var(--text-muted);">
                    Once you delete your account, all of your propositions and votes will be permanently deleted.
                </p>
                <form method="POST" action="{{ route('profile.destroy') }}" onsubmit="return confirm('Are you sure you want to delete your account? This action cannot be undone.');">
                    @csrf
                    @method('DELETE')
                    <button type="submit"
                            class="py-2 px-6 rounded-lg font-semibold text-white transition-all hover:scale-[1.02] active:scale-[0.98]"
                            style="background: hsl(0, 70%, 50%); box-shadow: var(--shadow-s);">
                        Delete Account
                    </button>
                </form>

                <!-- Logout Button -->
                <div class="mt-6 pt-6 border-t" style="border-color: var(--bg-light);">
                    <form method="POST" action="{{ route('logout') }}" class="inline">
                        @csrf
                        <button type="submit"
                                class="py-2 px-4 rounded-lg font-medium text-center transition-all hover:scale-[1.02] active:scale-[0.98] flex items-center space-x-2"
                                style="background: var(--bg-light); color: var(--text); box-shadow: var(--shadow-s);">
                            <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 16l4-4m0 0l-4-4m4 4H7m6 4v1a3 3 0 01-3 3H6a3 3 0 01-3-3V7a3 3 0 013-3h4a3 3 0 013 3v1"></path>
                            </svg>
                            <span>Logout</span>
                        </button>
                    </form>
                </div>
            </div>
        </div>
    </div>

    <script>
        // Image preview
        const input = document.getElementById('profile_picture_input');
        const preview = document.getElementById('profilePreview');
        const form = document.getElementById('profileForm');

        input.addEventListener('change', function(e) {
            const file = e.target.files[0];
            if (file) {
                // Validate file size (2MB)
                if (file.size > 2 * 1024 * 1024) {
                    alert('File is too large. Maximum size is 2MB.');
                    input.value = '';
                    return;
                }

                // Validate file type
                if (!file.type.startsWith('image/')) {
                    alert('Please select an image file.');
                    input.value = '';
                    return;
                }

                // Show preview
                const reader = new FileReader();
                reader.onload = function(e) {
                    preview.src = e.target.result;
                };
                reader.readAsDataURL(file);
            }
        });

        // ===== PROPOSITION VOTING AND COMMENTING FUNCTIONALITY =====
        
        // Voting functionality
        document.addEventListener('click', function(e) {
            if (e.target.closest('.upvote-btn')) {
                e.preventDefault();
                const btn = e.target.closest('.upvote-btn');
                handleVote(btn, 'upvote');
            } else if (e.target.closest('.downvote-btn')) {
                e.preventDefault();
                const btn = e.target.closest('.downvote-btn');
                handleVote(btn, 'downvote');
            } else if (e.target.closest('.comment-toggle-btn')) {
                e.preventDefault();
                const btn = e.target.closest('.comment-toggle-btn');
                toggleComments(btn);
            } else if (e.target.closest('.delete-btn')) {
                e.preventDefault();
                const btn = e.target.closest('.delete-btn');
                deleteProposition(btn);
            } else if (e.target.closest('.delete-comment-btn')) {
                e.preventDefault();
                const btn = e.target.closest('.delete-comment-btn');
                deleteComment(btn);
            }
        });

        // Handle voting
        async function handleVote(button, voteType) {
            const propositionId = button.getAttribute('data-id');
            const hasVoted = button.getAttribute('data-user-voted') === 'true';
            
            try {
                const response = await fetch(`/propositions/${propositionId}/vote`, {
                    method: 'POST',
                    headers: {
                        'Content-Type': 'application/json',
                        'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').getAttribute('content')
                    },
                    body: JSON.stringify({
                        vote_type: hasVoted ? null : voteType
                    })
                });

                if (response.ok) {
                    const data = await response.json();
                    updateVoteDisplay(propositionId, data);
                } else {
                    if (window.APP_DEBUG) console.error('Vote failed');
                }
            } catch (error) {
                if (window.APP_DEBUG) console.error('Vote error:', error);
            }
        }

        // Update vote display
        function updateVoteDisplay(propositionId, data) {
            const card = document.querySelector(`[data-id="${propositionId}"]`);
            if (!card) return;

            const upvoteBtn = card.querySelector('.upvote-btn');
            const downvoteBtn = card.querySelector('.downvote-btn');
            const upvoteCount = card.querySelector('.upvote-count');
            const downvoteCount = card.querySelector('.downvote-count');

            // Update counts
            upvoteCount.textContent = data.upvotes;
            downvoteCount.textContent = data.downvotes;

            // Update button states
            const userVote = data.user_vote;
            
            if (userVote === 'upvote') {
                upvoteBtn.classList.add('bg-green-200', 'shadow-md');
                upvoteBtn.classList.remove('hover:bg-green-50');
                upvoteBtn.setAttribute('data-user-voted', 'true');
                downvoteBtn.classList.remove('bg-red-200', 'shadow-md');
                downvoteBtn.classList.add('hover:bg-red-50');
                downvoteBtn.setAttribute('data-user-voted', 'false');
            } else if (userVote === 'downvote') {
                downvoteBtn.classList.add('bg-red-200', 'shadow-md');
                downvoteBtn.classList.remove('hover:bg-red-50');
                downvoteBtn.setAttribute('data-user-voted', 'true');
                upvoteBtn.classList.remove('bg-green-200', 'shadow-md');
                upvoteBtn.classList.add('hover:bg-green-50');
                upvoteBtn.setAttribute('data-user-voted', 'false');
            } else {
                upvoteBtn.classList.remove('bg-green-200', 'shadow-md');
                upvoteBtn.classList.add('hover:bg-green-50');
                upvoteBtn.setAttribute('data-user-voted', 'false');
                downvoteBtn.classList.remove('bg-red-200', 'shadow-md');
                downvoteBtn.classList.add('hover:bg-red-50');
                downvoteBtn.setAttribute('data-user-voted', 'false');
            }
        }

        // Toggle comments section
        function toggleComments(button) {
            const propositionId = button.getAttribute('data-id');
            const card = document.querySelector(`[data-id="${propositionId}"]`);
            const commentsSection = card.querySelector('.comments-section');
            
            commentsSection.classList.toggle('hidden');
        }

        // Delete proposition
        async function deleteProposition(button) {
            if (!confirm('Are you sure you want to delete this proposition?')) {
                return;
            }

            const propositionId = button.getAttribute('data-id');
            
            try {
                const response = await fetch(`/propositions/${propositionId}`, {
                    method: 'DELETE',
                    headers: {
                        'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').getAttribute('content')
                    }
                });

                if (response.ok) {
                    const card = document.querySelector(`[data-id="${propositionId}"]`);
                    card.remove();
                } else {
                    alert('Failed to delete proposition');
                }
            } catch (error) {
                if (window.APP_DEBUG) console.error('Delete error:', error);
                alert('Failed to delete proposition');
            }
        }

        // Delete comment
        async function deleteComment(button) {
            if (!confirm('Are you sure you want to delete this comment?')) {
                return;
            }

            const commentId = button.getAttribute('data-comment-id');
            
            try {
                const response = await fetch(`/comments/${commentId}`, {
                    method: 'DELETE',
                    headers: {
                        'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').getAttribute('content')
                    }
                });

                if (response.ok) {
                    const commentItem = document.querySelector(`[data-comment-id="${commentId}"]`);
                    commentItem.remove();
                } else {
                    alert('Failed to delete comment');
                }
            } catch (error) {
                if (window.APP_DEBUG) console.error('Delete comment error:', error);
                alert('Failed to delete comment');
            }
        }

        // Handle comment form submission
        document.addEventListener('submit', async function(e) {
            if (e.target.classList.contains('comment-form')) {
                e.preventDefault();
                const form = e.target;
                const propositionId = form.getAttribute('data-proposition-id');
                const formData = new FormData(form);
                
                try {
                    const response = await fetch(`/propositions/${propositionId}/comments`, {
                        method: 'POST',
                        headers: {
                            'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').getAttribute('content')
                        },
                        body: formData
                    });

                    if (response.ok) {
                        const data = await response.json();
                        addCommentToList(propositionId, data.comment);
                        form.reset();
                    } else {
                        alert('Failed to add comment');
                    }
                } catch (error) {
                    if (window.APP_DEBUG) console.error('Comment error:', error);
                    alert('Failed to add comment');
                }
            }
        });

        // Add comment to list
        function addCommentToList(propositionId, comment) {
            const card = document.querySelector(`[data-id="${propositionId}"]`);
            const commentsList = card.querySelector('.comments-list');
            
            const commentHtml = `
                <div class="comment-item flex gap-3" data-comment-id="${comment.id}">
                    <img src="${comment.user.profile_picture_url}" alt="${comment.user.display_name}" class="w-8 h-8 rounded-full object-cover flex-shrink-0">
                    <div class="flex-1">
                        <div class="flex items-center gap-2 mb-1">
                            <span class="font-medium text-primary text-sm">${comment.user.display_name}</span>
                            <span class="text-xs text-muted">just now</span>
                            <button class="delete-comment-btn text-xs text-muted hover:text-red-500 ml-auto" data-comment-id="${comment.id}">
                                <svg class="w-3 h-3" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-6v6m1-10V4a1 1 0 00-1-1h-4a1 1 0 00-1 1v3M4 7h16"></path>
                                </svg>
                            </button>
                        </div>
                        <p class="text-primary text-sm">${comment.content}</p>
                    </div>
                </div>
            `;
            
            commentsList.insertAdjacentHTML('beforeend', commentHtml);
            
            // Update comment count
            const commentCountSpan = card.querySelector('.comment-count');
            const currentCount = parseInt(commentCountSpan.textContent.match(/\d+/)[0]);
            commentCountSpan.textContent = `(${currentCount + 1})`;
        }

        // ===== END PROPOSITION FUNCTIONALITY =====

        // Automatically detect and apply system theme preference
        if (window.matchMedia && window.matchMedia('(prefers-color-scheme: light)').matches) {
            document.body.classList.add('light');
        }

        // Listen for theme changes
        window.matchMedia('(prefers-color-scheme: light)').addEventListener('change', e => {
            if (e.matches) {
                document.body.classList.add('light');
            } else {
                document.body.classList.remove('light');
            }
        });
    </script>

    <!-- Bottom Navigation -->
    @include('components.bottom-navigation')
</body>
</html>
