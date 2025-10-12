<x-guest-layout>
    <div class="p-6 sm:p-8">
        <div class="text-center mb-8">
            <img src="{{ asset('image/campus_voice.png') }}" alt="Campus Voice logo" class="mx-auto h-20 w-auto mb-4 opacity-90">
            <h2 class="text-2xl font-extrabold text-primary">Se connecter à SAIT Survey</h2>
            <p class="mt-2 text-sm text-muted">Be one of the first to join the project</p>
        </div>

        <!-- Session Status -->
        <x-auth-session-status class="mb-4" :status="session('status')" />

        <!-- Google sign-in -->
        <div class="mb-6">
            <a href="{{ route('google.redirect') }}" class="w-full inline-flex items-center justify-center gap-3 frosted-input hover:scale-[1.02] active:scale-[0.98] transition-all py-3 px-4 rounded-lg shadow-sm">
                <!-- Google icon -->
                <img alt="Google Logo" src="https://pngimg.com/uploads/google/google_PNG19635.png" class="w-7 h-7">
                <span class="text-sm font-medium text-primary">Connect with Google</span>
            </a>
        </div>

        <div class="relative mb-6">
            <div class="absolute inset-0 flex items-center">
                <div class="w-full border-t border-primary/20"></div>
            </div>
            <div class="relative flex justify-center text-sm">
                <span class="px-2 text-muted depth-layer-1">Or use email</span>
            </div>
        </div>

        <form method="POST" action="{{ route('login') }}" class="space-y-4">
            @csrf

            <!-- Email Address -->
            <div>
                <x-input-label for="email" :value="__('Email')" class="text-primary font-medium mb-2" />
                <x-text-input id="email" class="form-input w-full" type="email" name="email" :value="old('email')" required autofocus autocomplete="username" placeholder="your.email@sait.ca" />
                <x-input-error :messages="$errors->get('email')" class="mt-2" />
            </div>

            <!-- Password -->
            <div>
                <x-input-label for="password" :value="__('Password')" class="text-primary font-medium mb-2" />
                <x-text-input id="password" class="form-input w-full" type="password" name="password" required autocomplete="current-password" placeholder="••••••••" />
                <x-input-error :messages="$errors->get('password')" class="mt-2" />
            </div>

            <!-- Remember Me & Forgot Password -->
            <div class="flex items-center justify-between">
                <label for="remember_me" class="inline-flex items-center cursor-pointer">
                    <input id="remember_me" type="checkbox" class="rounded border-primary/30 text-brand focus:ring-brand focus:ring-offset-0 shadow-sm" name="remember">
                    <span class="ms-2 text-sm text-muted">{{ __('Remember me') }}</span>
                </label>

                @if (Route::has('password.request'))
                    <a class="text-sm text-brand hover:underline" href="{{ route('password.request') }}">{{ __('Forgot your password?') }}</a>
                @endif
            </div>

            <div class="pt-2">
                <x-primary-button class="btn-primary w-full justify-center">{{ __('Log in') }}</x-primary-button>
            </div>
        </form>

        <p class="text-center text-sm text-muted mt-6">
            Pas encore inscrit ?
            <a href="{{ route('register') }}" class="font-medium text-brand hover:underline">Create Account</a>
        </p>
    </div>
</x-guest-layout>
