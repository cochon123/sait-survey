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
            <div class="flex items-center justify-center">
                <img src="{{ asset('image/campus_voice.png') }}" alt="Campus Voice Logo" class="h-12 w-auto mr-4">
                <div>
                    <h1 class="text-2xl font-bold text-primary">My Profile</h1>
                    <p class="text-muted text-sm">Manage your account settings</p>
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
            <div class="grid grid-cols-1 md:grid-cols-3 gap-6">
                <div class="frosted-card p-6 text-center">
                    <div class="text-3xl font-bold mb-2" style="color: var(--brand);">{{ $user->propositions->count() }}</div>
                    <div class="text-sm" style="color: var(--text-muted);">Propositions</div>
                </div>
                <div class="frosted-card p-6 text-center">
                    <div class="text-3xl font-bold mb-2" style="color: var(--brand);">{{ $user->votes->count() }}</div>
                    <div class="text-sm" style="color: var(--text-muted);">Votes Cast</div>
                </div>
                <div class="frosted-card p-6 text-center">
                    <div class="text-3xl font-bold mb-2" style="color: var(--brand);">{{ $user->created_at->diffInDays(now()) }}</div>
                    <div class="text-sm" style="color: var(--text-muted);">Days Member</div>
                </div>
            </div>

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
