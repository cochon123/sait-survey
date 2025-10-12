{{-- Auth Modal --}}
<div id="auth-modal" class="fixed inset-0 backdrop-blur-sm flex items-center justify-center z-50 hidden" style="background: hsla(250, 5%, 5%, 0.7);">
  <div class="frosted-card max-w-md w-full mx-4 overflow-hidden">
    <div class="flex justify-between items-center p-6 border-b border-muted/20">
      <h2 class="text-xl font-bold text-primary">Authentication Required</h2>
      <button id="close-modal" class="text-muted hover:text-primary transition-colors">
        <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
          <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12"></path>
        </svg>
      </button>
    </div>

    <div class="p-6">
      <div class="flex border-b border-muted/20 mb-6">
        <button id="login-tab" class="flex-1 py-3 px-4 text-center border-b-2 border-transparent bg-brand text-black font-medium transition-all">Login</button>
        <button id="register-tab" class="flex-1 py-3 px-4 text-center border-b-2 border-transparent text-muted font-medium transition-all hover:text-primary">Register</button>
      </div>

      <div id="login-form" class="space-y-4">
        <form id="login-form-element" method="POST" action="{{ route('login') }}">
          @csrf
          <div class="mb-4">
            <label for="login-email" class="block text-sm font-medium text-primary mb-2">Email</label>
            <input id="login-email" type="email" name="email" class="form-input w-full" required>
          </div>
          <div class="mb-6">
            <label for="login-password" class="block text-sm font-medium text-primary mb-2">Password</label>
            <input id="login-password" type="password" name="password" class="form-input w-full" required>
          </div>
          <button type="submit" class="btn-primary w-full mb-4">Login</button>
        </form>
        <div class="relative">
          <div class="absolute inset-0 flex items-center">
            <div class="w-full border-t border-muted/20"></div>
          </div>
          <div class="relative flex justify-center text-sm">
            <span class="px-2 text-muted" style="background: var(--bg);">Or continue with</span>
          </div>
        </div>
        <a href="{{ route('google.redirect') }}" class="frosted-input flex items-center justify-center w-full py-3 px-4 rounded-xl hover:shadow-frosted-s transition-all group">
          <img alt="Google Logo" src="https://pngimg.com/uploads/google/google_PNG19635.png" class="w-7 h-7 mr-3">
          <span class="text-[var(--text)] font-medium">Continue with Google</span>
        </a>
      </div>

      <div id="register-form" class="space-y-4 hidden">
        <form id="register-form-element" method="POST" action="{{ route('register') }}">
          @csrf
          <div class="mb-4">
            <label for="register-name" class="block text-sm font-medium text-primary mb-2">Name</label>
            <input id="register-name" type="text" name="name" class="form-input w-full" required>
          </div>
          <div class="mb-4">
            <label for="register-email" class="block text-sm font-medium text-primary mb-2">Email</label>
            <input id="register-email" type="email" name="email" class="form-input w-full" required>
          </div>
          <div class="mb-6">
            <label for="register-password" class="block text-sm font-medium text-primary mb-2">Password</label>
            <input id="register-password" type="password" name="password" class="form-input w-full" required>
          </div>
          <button type="submit" class="btn-primary w-full mb-4">Register</button>
        </form>
        <div class="relative">
          <div class="absolute inset-0 flex items-center">
            <div class="w-full border-t border-muted/20"></div>
          </div>
          <div class="relative flex justify-center text-sm">
            <span class="px-2 text-muted" style="background: var(--bg);">Or continue with</span>
          </div>
        </div>
        <a href="{{ route('google.redirect') }}" class="frosted-input flex items-center justify-center w-full py-3 px-4 rounded-xl hover:shadow-frosted-s transition-all group">
          <img alt="Google Logo" src="https://pngimg.com/uploads/google/google_PNG19635.png" class="w-7 h-7 mr-3">
          <span class="text-[var(--text)] font-medium">Continue with Google</span>
        </a>
      </div>
    </div>
  </div>
</div>


