<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <meta name="csrf-token" content="{{ csrf_token() }}">

        <title>Complete Your Profile - {{ config('app.name', 'Campus Voice') }}</title>

        <!-- Fonts -->
        <link rel="preconnect" href="https://fonts.bunny.net">
        <link href="https://fonts.bunny.net/css?family=figtree:400,500,600&display=swap" rel="stylesheet" />

        <!-- Scripts -->
        @vite(['resources/css/app.css', 'resources/js/app.js'])
    </head>
    <body class="antialiased font-sans">
        <div class="min-h-screen flex flex-col sm:justify-center items-center pt-6 sm:pt-0" style="background: var(--bg-dark);">
            <div class="w-full sm:max-w-md mt-6 px-6 py-8 frosted-card">
                <div class="text-center mb-8">
                    <img src="{{ asset('image/campus_voice.png') }}" alt="Campus Voice logo" class="mx-auto h-20 w-auto mb-4 opacity-90">
                    <h2 class="text-2xl font-bold" style="color: var(--text);">Complete Your Profile</h2>
                    <p class="mt-2 text-sm" style="color: var(--text-muted);">Choose a unique nickname and profile picture</p>
                </div>

                @if ($errors->any())
                    <div class="mb-4 p-4 rounded-lg" style="background: hsla(0, 70%, 50%, 0.1); border: 1px solid hsla(0, 70%, 50%, 0.3);">
                        <ul class="list-disc list-inside text-sm" style="color: hsl(0, 70%, 60%);">
                            @foreach ($errors->all() as $error)
                                <li>{{ $error }}</li>
                            @endforeach
                        </ul>
                    </div>
                @endif

                <form method="POST" action="{{ route('profile.complete.store') }}" enctype="multipart/form-data" class="space-y-6">
                    @csrf

                    <!-- Nickname -->
                    <div>
                        <label for="nickname" class="block text-sm font-medium mb-2" style="color: var(--text);">
                            Nickname <span style="color: var(--brand);">*</span>
                        </label>
                        <input id="nickname"
                               type="text"
                               name="nickname"
                               value="{{ old('nickname') }}"
                               required
                               autofocus
                               maxlength="50"
                               class="frosted-input w-full px-4 py-2 rounded-lg focus:outline-none focus:ring-2 transition-all"
                               style="color: var(--text); --tw-ring-color: var(--brand);"
                               placeholder="Choose a unique nickname">
                        <p class="mt-1 text-xs" style="color: var(--text-muted);">
                            This is how other students will see you
                        </p>
                    </div>

                    <!-- Profile Picture -->
                    <div>
                        <label for="profile_picture" class="block text-sm font-medium mb-2" style="color: var(--text);">
                            Profile Picture (Optional)
                        </label>

                        <!-- Preview Area -->
                        <div class="mb-3 flex justify-center">
                            <div class="relative">
                                <img id="preview"
                                     src="{{ asset('image/default-avatar.svg') }}"
                                     alt="Profile preview"
                                     class="w-32 h-32 rounded-full object-cover frosted-card">
                                <label for="profile_picture"
                                       class="absolute bottom-0 right-0 p-2 rounded-full cursor-pointer hover:scale-110 transition-transform"
                                       style="background: var(--brand); color: hsl(0, 0%, 10%);">
                                    <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 9a2 2 0 012-2h.93a2 2 0 001.664-.89l.812-1.22A2 2 0 0110.07 4h3.86a2 2 0 011.664.89l.812 1.22A2 2 0 0018.07 7H19a2 2 0 012 2v9a2 2 0 01-2 2H5a2 2 0 01-2-2V9z"></path>
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 13a3 3 0 11-6 0 3 3 0 016 0z"></path>
                                    </svg>
                                </label>
                            </div>
                        </div>

                        <input id="profile_picture"
                               type="file"
                               name="profile_picture"
                               accept="image/*"
                               class="hidden">

                        <p class="mt-1 text-xs text-center" style="color: var(--text-muted);">
                            Click the camera icon to upload a photo (Max 2MB, JPG/PNG)
                        </p>
                    </div>

                    <!-- Submit Button -->
                    <div class="flex items-center justify-end mt-8">
                        <button type="submit"
                                class="w-full py-3 px-6 rounded-lg font-semibold text-center transition-all hover:scale-[1.02] active:scale-[0.98]"
                                style="background: var(--brand); color: hsl(0, 0%, 10%); box-shadow: var(--shadow-s);">
                            Complete Profile & Continue
                        </button>
                    </div>
                </form>
            </div>
        </div>

        <script>
            // Image preview
            const input = document.getElementById('profile_picture');
            const preview = document.getElementById('preview');

            input.addEventListener('change', function(e) {
                const file = e.target.files[0];
                if (file) {
                    const reader = new FileReader();
                    reader.onload = function(e) {
                        preview.src = e.target.result;
                    };
                    reader.readAsDataURL(file);
                }
            });
        </script>
    </body>
</html>
