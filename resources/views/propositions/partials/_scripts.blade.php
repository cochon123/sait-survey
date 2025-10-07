<script>
    // Character counter for authenticated user form
    @auth
        const textarea = document.getElementById('content');
        const charCount = document.getElementById('char-count');

        textarea.addEventListener('input', function() {
            charCount.textContent = this.value.length;
        });
    @endauth

    // Guest input functionality
    @guest
        document.addEventListener('DOMContentLoaded', function() {
            const guestInput = document.getElementById('guest-proposition-input');
            const guestCharCount = document.getElementById('guest-char-count');
            const guestSendBtn = document.getElementById('guest-send-btn');
            const loginFormElement = document.getElementById('login-form-element');
            const registerFormElement = document.getElementById('register-form-element');

            let pendingProposition = '';

            // Character counter for guest input
            if (guestInput) {
                guestInput.addEventListener('input', function() {
                    if (guestCharCount) guestCharCount.textContent = this.value.length;
                });
            }

            // Send button click
            if (guestSendBtn) {
                guestSendBtn.addEventListener('click', function() {
                    const propositionText = guestInput ? guestInput.value.trim() : '';
                    if (propositionText.length === 0) {
                        alert('Please enter your proposition first.');
                        return;
                    }
                    if (propositionText.length > 1000) {
                        alert('Proposition is too long. Maximum 1000 characters.');
                        return;
                    }

                    pendingProposition = propositionText;
                    openAuthModal();
                });
            }

            // Handle form submissions with pending proposition
            function handleFormSubmit(form, action) {
                if (form) {
                    form.addEventListener('submit', function(e) {
                        // Add the pending proposition as a hidden field
                        const propositionInput = document.createElement('input');
                        propositionInput.type = 'hidden';
                        propositionInput.name = 'pending_proposition';
                        propositionInput.value = pendingProposition;
                        form.appendChild(propositionInput);
                    });
                }
            }

            handleFormSubmit(loginFormElement, 'login');
            handleFormSubmit(registerFormElement, 'register');
        });
    @endguest

    // Voting functionality with event delegation
    @auth
        document.addEventListener('DOMContentLoaded', function() {
            // Use event delegation for all voting buttons
            document.body.addEventListener('click', async function(e) {
                // Close comments section when clicking outside
                const openCommentsSections = document.querySelectorAll('.comments-section:not(.hidden)');
                const clickedOnCommentToggle = e.target.closest('.comment-toggle-btn');
                const clickedInsideComments = e.target.closest('.comments-section');

                if (openCommentsSections.length > 0 && !clickedOnCommentToggle && !clickedInsideComments) {
                    openCommentsSections.forEach(section => {
                        section.classList.add('hidden');
                        const card = section.closest('.proposition-card');
                        const toggleBtn = card.querySelector('.comment-toggle-btn');
                        if (toggleBtn) {
                            toggleBtn.classList.remove('bg-brand', 'text-black');
                        }
                    });
                }

                // Handle upvote buttons
                if (e.target.closest('.upvote-btn')) {
                    e.preventDefault();
                    const button = e.target.closest('.upvote-btn');
                    const propositionId = button.dataset.id;
                    const countSpan = button.querySelector('.upvote-count');
                    const downvoteBtn = button.closest('.proposition-card').querySelector('.downvote-btn');
                    const downvoteCountSpan = downvoteBtn.querySelector('.downvote-count');
                    const svg = button.querySelector('svg');
                    const wasUpvoted = button.dataset.userVoted === 'true';

                    try {
                        const response = await fetch(`/propositions/${propositionId}/upvote`, {
                            method: 'POST',
                            headers: {
                                'Content-Type': 'application/json',
                                'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').getAttribute('content')
                            }
                        });

                        if (response.ok) {
                            const data = await response.json();
                            countSpan.textContent = data.upvotes;

                            // Update downvote count if it changed
                            if (downvoteCountSpan) {
                                downvoteCountSpan.textContent = data.downvotes;
                            }

                            if (wasUpvoted) {
                                // User is removing their upvote
                                button.dataset.userVoted = 'false';
                            } else {
                                // User is adding upvote - TRIGGER ANIMATION!
                                button.classList.add('upvote-animate', 'upvote-hearts');
                                button.dataset.userVoted = 'true';

                                // Remove animation classes after animation completes
                                setTimeout(() => {
                                    button.classList.remove('upvote-animate', 'upvote-hearts');
                                }, 1000);

                                // If user had downvoted before, update downvote button
                                if (downvoteBtn.dataset.userVoted === 'true') {
                                    downvoteBtn.dataset.userVoted = 'false';
                                }
                            }
                        }
                    } catch (error) {
                        // Error handled silently
                    }
                }

                // Handle downvote buttons
                if (e.target.closest('.downvote-btn')) {
                    e.preventDefault();
                    const button = e.target.closest('.downvote-btn');
                    const propositionId = button.dataset.id;
                    const countSpan = button.querySelector('.downvote-count');
                    const upvoteBtn = button.closest('.proposition-card').querySelector('.upvote-btn');
                    const upvoteCountSpan = upvoteBtn.querySelector('.upvote-count');
                    const svg = button.querySelector('svg');
                    const wasDownvoted = button.dataset.userVoted === 'true';

                    try {
                        const response = await fetch(`/propositions/${propositionId}/downvote`, {
                            method: 'POST',
                            headers: {
                                'Content-Type': 'application/json',
                                'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').getAttribute('content')
                            }
                        });

                        if (response.ok) {
                            const data = await response.json();
                            countSpan.textContent = data.downvotes;

                            // Update upvote count if it changed
                            if (upvoteCountSpan) {
                                upvoteCountSpan.textContent = data.upvotes;
                            }

                            // Simple animation for downvote (subtle)
                            button.classList.add('downvote-animate');
                            setTimeout(() => button.classList.remove('downvote-animate'), 300);

                            if (wasDownvoted) {
                                // User is removing their downvote
                                button.classList.remove('bg-red-500', 'text-white', 'shadow-md');
                                button.classList.add('hover:bg-red-50');
                                svg.classList.remove('text-white');
                                svg.classList.add('text-red-500');
                                countSpan.classList.remove('text-white');
                                countSpan.classList.add('text-red-500');
                                button.dataset.userVoted = 'false';
                            } else {
                                // User is adding downvote
                                button.classList.remove('hover:bg-red-50');
                                button.classList.add('bg-red-500', 'text-white', 'shadow-md');
                                svg.classList.remove('text-red-500');
                                svg.classList.add('text-white');
                                countSpan.classList.remove('text-red-500');
                                countSpan.classList.add('text-white');
                                button.dataset.userVoted = 'true';

                                // If user had upvoted before, update upvote button
                                if (upvoteBtn.dataset.userVoted === 'true') {
                                    const upvoteSvg = upvoteBtn.querySelector('svg');
                                    upvoteBtn.classList.remove('bg-green-500', 'text-white', 'shadow-md');
                                    upvoteBtn.classList.add('hover:bg-green-50');
                                    upvoteSvg.classList.remove('text-white');
                                    upvoteSvg.classList.add('text-green-500');
                                    upvoteCountSpan.classList.remove('text-white');
                                    upvoteCountSpan.classList.add('text-green-500');
                                    upvoteBtn.dataset.userVoted = 'false';
                                }
                            }
                        }
                    } catch (error) {
                        // Error handled silently
                    }
                }

                // Handle delete buttons
                if (e.target.closest('.delete-btn')) {
                    e.preventDefault();
                    const button = e.target.closest('.delete-btn');
                    const propositionId = button.dataset.id;
                    const propositionCard = button.closest('.proposition-card');

                    // Show confirmation dialog
                    if (!confirm('Are you sure you want to delete this proposition? This action cannot be undone.')) {
                        return;
                    }

                    try {
                        const response = await fetch(`/propositions/${propositionId}`, {
                            method: 'DELETE',
                            headers: {
                                'Content-Type': 'application/json',
                                'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').getAttribute('content')
                            }
                        });

                        if (response.ok) {
                            // Add fade out animation
                            propositionCard.style.transition = 'opacity 0.3s ease-out';
                            propositionCard.style.opacity = '0';

                            // Remove the card from the DOM after animation
                            setTimeout(() => {
                                propositionCard.remove();

                                // Update proposition count
                                const propositionsList = document.getElementById('propositions-list');
                                const countElement = document.getElementById('proposition-count');
                                if (countElement) {
                                    countElement.textContent = propositionsList.children.length;
                                }

                                // Check if there are no more propositions
                                if (propositionsList.children.length === 0) {
                                    propositionsList.innerHTML = '<div class="bg-white rounded-lg shadow-md p-8 text-center"><p class="text-gray-500 text-lg">No propositions yet. Be the first to share your idea!</p></div>';
                                }
                            }, 300);
                        } else {
                            const data = await response.json();
                            alert(data.error || 'Error deleting proposition');
                        }
                    } catch (error) {
                        alert('An error occurred while deleting the proposition');
                    }
                }

                // Handle comment toggle buttons
                if (e.target.closest('.comment-toggle-btn')) {
                    e.preventDefault();
                    const button = e.target.closest('.comment-toggle-btn');
                    const propositionId = button.dataset.id;
                    const card = button.closest('.proposition-card');
                    const commentsSection = card.querySelector('.comments-section');

                    if (commentsSection) {
                        commentsSection.classList.toggle('hidden');

                        if (commentsSection.classList.contains('hidden')) {
                            button.classList.remove('bg-brand', 'text-black');
                        } else {
                            button.classList.add('bg-brand', 'text-black');
                            const commentInput = commentsSection.querySelector('input[name="content"]');
                            if (commentInput) {
                                setTimeout(() => commentInput.focus(), 100);
                            }
                        }
                    }
                }

                // Handle comment delete buttons
                if (e.target.closest('.delete-comment-btn')) {
                    e.preventDefault();
                    const button = e.target.closest('.delete-comment-btn');
                    const commentId = button.dataset.commentId;

                    if (!confirm('Delete this comment?')) return;

                    try {
                        const response = await fetch(`/comments/${commentId}`, {
                            method: 'DELETE',
                            headers: {
                                'Content-Type': 'application/json',
                                'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').getAttribute('content')
                            }
                        });

                        if (response.ok) {
                            const commentItem = button.closest('.comment-item');
                            const card = button.closest('.proposition-card');

                            const countSpan = card.querySelector('.comment-count');
                            if (countSpan) {
                                const currentCount = parseInt(countSpan.textContent.replace(/[()]/g, '')) || 0;
                                countSpan.textContent = `(${Math.max(0, currentCount - 1)})`;
                            }

                            commentItem.remove();
                        }
                    } catch (error) {
                        // Error handled silently
                    }
                }
            });

            // Handle comment form submissions
            document.body.addEventListener('submit', async function(e) {
                if (e.target.classList.contains('comment-form')) {
                    e.preventDefault();
                    const form = e.target;
                    const propositionId = form.dataset.propositionId;
                    const contentInput = form.querySelector('input[name="content"]');
                    const content = contentInput.value.trim();

                    if (!content) return;

                    try {
                        const response = await fetch(`/propositions/${propositionId}/comments`, {
                            method: 'POST',
                            headers: {
                                'Content-Type': 'application/json',
                                'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').getAttribute('content')
                            },
                            body: JSON.stringify({ content })
                        });

                        if (response.ok) {
                            const data = await response.json();
                            const commentsList = form.closest('.comments-section').querySelector('.comments-list');

                            const commentHtml = `
                                <div class="comment-item flex gap-3" data-comment-id="${data.comment.id}">
                                    <img src="${data.comment.user.profile_picture_url}" alt="${data.comment.user.display_name}" class="w-8 h-8 rounded-full object-cover flex-shrink-0">
                                    <div class="flex-1">
                                        <div class="flex items-center gap-2 mb-1">
                                            <span class="font-medium text-primary text-sm">${data.comment.user.display_name}</span>
                                            <span class="text-xs text-muted">${data.comment.created_at}</span>
                                            ${data.comment.can_delete ? `
                                                <button class="delete-comment-btn text-xs text-muted hover:text-red-500 ml-auto" data-comment-id="${data.comment.id}">
                                                    <svg class="w-3 h-3" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-6v6m1-10V4a1 1 0 00-1-1h-4a1 1 0 00-1 1v3M4 7h16"></path>
                                                    </svg>
                                                </button>
                                            ` : ''}
                                        </div>
                                        <p class="text-primary text-sm">${data.comment.content}</p>
                                    </div>
                                </div>
                            `;

                            commentsList.insertAdjacentHTML('beforeend', commentHtml);

                            const card = form.closest('.proposition-card');
                            const countSpan = card.querySelector('.comment-count');
                            if (countSpan) {
                                const currentCount = parseInt(countSpan.textContent.replace(/[()]/g, '')) || 0;
                                countSpan.textContent = `(${currentCount + 1})`;
                            }

                            contentInput.value = '';
                        }
                    } catch (error) {
                        // Error handled silently
                    }
                }
            });
        });
    @endauth



    // Sorting functionality
    document.addEventListener('DOMContentLoaded', function() {
        const sortRecentBtn = document.getElementById('sort-recent');
        const sortTopBtn = document.getElementById('sort-top');
        const propositionsList = document.getElementById('propositions-list');
        let currentSort = 'recent';
        let currentPage = {{ $propositions->currentPage() }};
        let hasMorePages = {{ $propositions->hasMorePages() ? 'true' : 'false' }};
        let isLoading = false;

        function updateSortButtons(activeSort) {
            currentSort = activeSort;

            if (activeSort === 'recent') {
                sortRecentBtn.classList.remove('btn-secondary');
                sortRecentBtn.classList.add('btn-primary');
                sortTopBtn.classList.remove('btn-primary');
                sortTopBtn.classList.add('btn-secondary');
            } else {
                sortTopBtn.classList.remove('btn-secondary');
                sortTopBtn.classList.add('btn-primary');
                sortRecentBtn.classList.remove('btn-primary');
                sortRecentBtn.classList.add('btn-secondary');
            }
        }

        function loadPropositions(sort, resetList = false) {
            if (isLoading) return;

            isLoading = true;
            document.getElementById('loading-spinner').classList.remove('hidden');

            let url;
            if (resetList) {
                url = new URL('{{ route("propositions.index") }}');
                url.searchParams.set('sort', sort);
            } else {
                url = new URL('{{ route("propositions.load-more") }}');
                url.searchParams.set('sort', sort);
                url.searchParams.set('page', currentPage + 1);
            }

            fetch(url, {
                headers: {
                    'X-Requested-With': 'XMLHttpRequest'
                }
            })
            .then(response => response.json())
            .then(data => {
                if (resetList) {
                    propositionsList.innerHTML = data.html;
                    currentPage = 1;
                } else {
                    const newPropositions = document.createElement('div');
                    newPropositions.innerHTML = data.html;

                    // Append new propositions with animation
                    Array.from(newPropositions.children).forEach((proposition, index) => {
                        setTimeout(() => {
                            proposition.style.opacity = '0';
                            proposition.style.transform = 'translateY(20px)';
                            propositionsList.appendChild(proposition);

                            // Trigger animation
                            setTimeout(() => {
                                proposition.style.transition = 'opacity 0.5s ease, transform 0.5s ease';
                                proposition.style.opacity = '1';
                                proposition.style.transform = 'translateY(0)';
                            }, 50);
                        }, index * 100);
                    });

                    currentPage++;
                }

                hasMorePages = data.hasMore || false;
                
                // Update total count if provided
                if (data.total) {
                    const countElement = document.getElementById('proposition-count');
                    if (countElement) {
                        countElement.textContent = data.total;
                    }
                }

                // Show end of content message if no more pages
                const endOfContentElement = document.getElementById('end-of-content');
                if (endOfContentElement) {
                    if (!hasMorePages) {
                        endOfContentElement.classList.remove('hidden');
                    } else {
                        endOfContentElement.classList.add('hidden');
                    }
                }

                // No need to reattach event listeners with event delegation
            })
            .catch(error => {
                // Error handled silently
            })
            .finally(() => {
                isLoading = false;
                document.getElementById('loading-spinner').classList.add('hidden');
            });
        }

        // Infinite scroll
        function checkScroll() {
            if (isLoading || !hasMorePages) return;

            const scrollPosition = window.innerHeight + window.scrollY;
            const threshold = document.documentElement.offsetHeight - 1000; // Load 1000px before end

            if (scrollPosition >= threshold) {
                loadPropositions(currentSort, false);
            }
        }

        // Throttle scroll events
        let scrollTimeout;
        window.addEventListener('scroll', function() {
            if (scrollTimeout) clearTimeout(scrollTimeout);
            scrollTimeout = setTimeout(checkScroll, 100);
        });

        sortRecentBtn.addEventListener('click', function() {
            if (currentSort === 'recent') return;

            updateSortButtons('recent');
            currentPage = 0;
            hasMorePages = true;
            loadPropositions('recent', true);
        });

        sortTopBtn.addEventListener('click', function() {
            if (currentSort === 'top') return;

            updateSortButtons('top');
            currentPage = 0;
            hasMorePages = true;
            loadPropositions('top', true);
        });
    });

    // Modal functionality
    document.addEventListener('DOMContentLoaded', function() {
        const authModal = document.getElementById('auth-modal');
        const closeModal = document.getElementById('close-modal');
        const loginTab = document.getElementById('login-tab');
        const registerTab = document.getElementById('register-tab');
        const loginForm = document.getElementById('login-form');
        const registerForm = document.getElementById('register-form');

        // Fonction pour ouvrir le modal
        window.openAuthModal = function() {
            if (authModal) {
                authModal.classList.remove('hidden');
                document.body.classList.add('modal-open');
            }
        };

        // Fonction pour fermer le modal
        window.closeAuthModal = function() {
            if (authModal) {
                authModal.classList.add('hidden');
                document.body.classList.remove('modal-open');
            }
        };

        // Fermer le modal avec le bouton X
        if (closeModal) {
            closeModal.addEventListener('click', closeAuthModal);
        }

        // Fermer le modal en cliquant en dehors
        if (authModal) {
            authModal.addEventListener('click', function(e) {
                if (e.target === authModal) {
                    closeAuthModal();
                }
            });
        }

        // Basculement vers l'onglet de connexion
        if (loginTab) {
            loginTab.addEventListener('click', function() {
                loginTab.className = 'flex-1 py-2 px-4 text-center border-b-2 border-blue-500 text-blue-600 font-medium';
                if (registerTab) registerTab.className = 'flex-1 py-2 px-4 text-center border-b-2 border-gray-200 text-gray-500';
                if (loginForm) loginForm.classList.remove('hidden');
                if (registerForm) registerForm.classList.add('hidden');
            });
        }

        // Basculement vers l'onglet d'inscription
        if (registerTab) {
            registerTab.addEventListener('click', function() {
                registerTab.className = 'flex-1 py-2 px-4 text-center border-b-2 border-blue-500 text-blue-600 font-medium';
                if (loginTab) loginTab.className = 'flex-1 py-2 px-4 text-center border-b-2 border-gray-200 text-gray-500';
                if (registerForm) registerForm.classList.remove('hidden');
                if (loginForm) loginForm.classList.add('hidden');
            });
        }
    });

    // Show one-per-day modal when server indicates an error
    document.addEventListener('DOMContentLoaded', function() {
        const oneDayModal = document.getElementById('one-day-modal');
        const oneDayClose = document.getElementById('one-day-close');

        function openOneDayModal() {
            if (oneDayModal) {
                oneDayModal.classList.remove('hidden');
                document.body.classList.add('modal-open');
            }
        }

        function closeOneDayModal() {
            if (oneDayModal) {
                oneDayModal.classList.add('hidden');
                document.body.classList.remove('modal-open');
            }
        }

        if (oneDayClose) {
            oneDayClose.addEventListener('click', closeOneDayModal);
        }

        // Close when clicking the backdrop
        if (oneDayModal) {
            oneDayModal.addEventListener('click', function(e) {
                if (e.target === oneDayModal) closeOneDayModal();
            });
        }

        // Server-provided flags: show modal if session has error or validation errors for content
        const serverHasError = {!! json_encode(session()->has('error') || $errors->has('content')) !!};
        if (serverHasError) {
            openOneDayModal();
        }
    });

    // Theme Detection Script
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
