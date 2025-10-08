<x-guest-layout>
    <div class="p-6 sm:p-8">
        <div class="text-center mb-8">
            <img src="{{ asset('image/campus_voice.png') }}" alt="Campus Voice logo" class="mx-auto h-20 w-auto mb-4 opacity-90">
            <h2 class="text-2xl font-extrabold text-primary">Create Account</h2>
            <p class="mt-2 text-sm text-muted">Rejoignez la communauté SAIT Survey</p>
        </div>

        <!-- Google sign-up -->
        <div class="mb-6">
            <a href="{{ route('google.redirect') }}" class="w-full inline-flex items-center justify-center gap-3 frosted-input hover:scale-[1.02] active:scale-[0.98] transition-all py-3 px-4 rounded-lg shadow-sm">
                <!-- Google icon -->
                <svg class="h-5 w-5" viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg" aria-hidden="true">
                    <path d="M21.8 10.23H21V10.1H12v3.8h5.4c-.23 1.36-1.33 3.99-5.4 3.99-3.25 0-5.9-2.68-5.9-5.98s2.65-5.98 5.9-5.98c1.84 0 3.08.78 3.79 1.45l2.59-2.5C18.77 3.5 15.7 2 12 2 6.48 2 2 6.48 2 12s4.48 10 10 10c5.76 0 9.59-4.03 9.59-9.7 0-.65-.07-1.14-.79-2.07z" fill="#4285F4"/>
                </svg>
                <span class="text-sm font-medium text-primary">S'inscrire avec Google</span>
            </a>
        </div>

        <div class="relative mb-6">
            <div class="absolute inset-0 flex items-center">
                <div class="w-full border-t border-primary/20"></div>
            </div>
            <div class="relative flex justify-center text-sm">
                <span class="px-2 text-muted depth-layer-1">Or create an account with</span>
            </div>
        </div>

        <form method="POST" action="{{ route('register') }}" class="space-y-4">
            @csrf

            <!-- Name -->
            <div>
                <x-input-label for="name" :value="__('Name')" class="text-primary font-medium mb-2" />
                <x-text-input id="name" class="form-input w-full" type="text" name="name" :value="old('name')" required autofocus autocomplete="name" placeholder="Your name" />
                <x-input-error :messages="$errors->get('name')" class="mt-2" />
            </div>

            <!-- Email Address -->
            <div>
                <x-input-label for="email" :value="__('Email')" class="text-primary font-medium mb-2" />
                <x-text-input id="email" class="form-input w-full" type="email" name="email" :value="old('email')" required autocomplete="username" placeholder="your.email@sait.ca" />
                <x-input-error :messages="$errors->get('email')" class="mt-2" />
            </div>

            <!-- Password -->
            <div>
                <x-input-label for="password" :value="__('Password')" class="text-primary font-medium mb-2" />
                <x-text-input id="password" class="form-input w-full" type="password" name="password" required autocomplete="new-password" placeholder="••••••••" />
                <x-input-error :messages="$errors->get('password')" class="mt-2" />
            </div>

            <!-- Confirm Password -->
            <div>
                <x-input-label for="password_confirmation" :value="__('Confirm Password')" class="text-primary font-medium mb-2" />
                <x-text-input id="password_confirmation" class="form-input w-full" type="password" name="password_confirmation" required autocomplete="new-password" placeholder="••••••••" />
                <x-input-error :messages="$errors->get('password_confirmation')" class="mt-2" />
            </div>

            <div class="flex items-center justify-between pt-2">
                <a class="text-sm text-muted hover:text-brand transition-colors" href="{{ route('login') }}">
                    {{ __('Already registered?') }}
                </a>

                <x-primary-button class="btn-primary">
                    {{ __('Register') }}
                </x-primary-button>
            </div>
        </form>
    </div>
</x-guest-layout>
