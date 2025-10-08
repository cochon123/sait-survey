<x-guest-layout>
    <div class="p-6 sm:p-8">
        <div class="text-center mb-8">
            <img src="{{ asset('image/campus_voice.png') }}" alt="Campus Voice logo" class="mx-auto h-20 w-auto mb-4 opacity-90">
            <h2 class="text-2xl font-extrabold text-primary mb-3">Forgot Password</h2>
            <p class="text-sm text-muted">
                {{ __('Forgot your password? No problem. Just let us know your email address and we will email you a password reset link that will allow you to choose a new one.') }}
            </p>
        </div>

        <!-- Session Status -->
        <x-auth-session-status class="mb-4" :status="session('status')" />

        <form method="POST" action="{{ route('password.email') }}" class="space-y-4">
            @csrf

            <!-- Email Address -->
            <div>
                <x-input-label for="email" :value="__('Email')" class="text-primary font-medium mb-2" />
                <x-text-input id="email" class="form-input w-full" type="email" name="email" :value="old('email')" required autofocus placeholder="your.email@sait.ca" />
                <x-input-error :messages="$errors->get('email')" class="mt-2" />
            </div>

            <div class="pt-2">
                <x-primary-button class="w-full justify-center">
                    {{ __('Email Password Reset Link') }}
                </x-primary-button>
            </div>

            <div class="text-center">
                <a href="{{ route('login') }}" class="text-sm text-muted hover:text-brand transition-colors">
                    Back to Login
                </a>
            </div>
        </form>
    </div>
</x-guest-layout>
