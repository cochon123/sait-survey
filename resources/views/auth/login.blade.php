<x-guest-layout>
    <div class="min-h-screen flex items-center justify-center bg-gray-50 py-12 px-4 sm:px-6 lg:px-8">
        <div class="max-w-md w-full space-y-8">
            <div class="text-center">
                <img src="{{ asset('image/SAIT-logo.webp') }}" alt="SAIT logo" class="mx-auto h-20 w-auto mb-4">
                <h2 class="mt-2 text-2xl font-extrabold text-gray-900">Se connecter à SAIT Survey</h2>
                <p class="mt-1 text-sm text-gray-600">Be one of the first to join the project</p>
            </div>

            <div class="bg-white py-8 px-6 shadow rounded-lg">
                <!-- Session Status -->
                <x-auth-session-status class="mb-4" :status="session('status')" />

                <!-- Google sign-in -->
                <div class="mb-4">
                    <a href="{{ route('google.redirect') }}" class="w-full inline-flex items-center justify-center gap-3 bg-white border border-gray-300 hover:bg-gray-50 text-gray-700 py-2 px-4 rounded-md shadow-sm transition-colors">
                        <!-- simple Google icon -->
                        <svg class="h-5 w-5" viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg" aria-hidden="true">
                            <path d="M21.8 10.23H21V10.1H12v3.8h5.4c-.23 1.36-1.33 3.99-5.4 3.99-3.25 0-5.9-2.68-5.9-5.98s2.65-5.98 5.9-5.98c1.84 0 3.08.78 3.79 1.45l2.59-2.5C18.77 3.5 15.7 2 12 2 6.48 2 2 6.48 2 12s4.48 10 10 10c5.76 0 9.59-4.03 9.59-9.7 0-.65-.07-1.14-.79-2.07z" fill="#4285F4"/>
                        </svg>
                        <span class="text-sm font-medium">Se connecter avec Google</span>
                    </a>
                </div>

                <form method="POST" action="{{ route('login') }}">
                    @csrf

                    <!-- Email Address -->
                    <div class="mb-4">
                        <x-input-label for="email" :value="__('Email')" />
                        <x-text-input id="email" class="block mt-1 w-full" type="email" name="email" :value="old('email')" required autofocus autocomplete="username" />
                        <x-input-error :messages="$errors->get('email')" class="mt-2" />
                    </div>

                    <!-- Password -->
                    <div class="mb-4">
                        <x-input-label for="password" :value="__('Password')" />
                        <x-text-input id="password" class="block mt-1 w-full" type="password" name="password" required autocomplete="current-password" />
                        <x-input-error :messages="$errors->get('password')" class="mt-2" />
                    </div>

                    <!-- Remember Me -->
                    <div class="flex items-center justify-between mb-4">
                        <label for="remember_me" class="inline-flex items-center">
                            <input id="remember_me" type="checkbox" class="rounded border-gray-300 text-indigo-600 shadow-sm focus:ring-indigo-500" name="remember">
                            <span class="ms-2 text-sm text-gray-600">{{ __('Remember me') }}</span>
                        </label>

                        @if (Route::has('password.request'))
                            <a class="text-sm text-gray-600 hover:text-gray-900" href="{{ route('password.request') }}">{{ __('Forgot your password?') }}</a>
                        @endif
                    </div>

                    <div>
                        <x-primary-button class="w-full">{{ __('Log in') }}</x-primary-button>
                    </div>
                </form>
            </div>

            <p class="text-center text-sm text-gray-500">Pas encore inscrit ? <a href="{{ route('register') }}" class="font-medium text-indigo-600 hover:text-indigo-500">Créer un compte</a></p>
        </div>
    </div>
</x-guest-layout>
