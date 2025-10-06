<!-- Bottom Navigation -->
<nav class="fixed bottom-0 left-0 right-0 frosted-card border-t border-primary/20 z-50 rounded-none">
    <div class="flex justify-between items-center px-8 py-2">
        <!-- Home (Left) -->
        <a href="{{ route('home') }}" class="flex items-center justify-center p-3 rounded-full transition-all {{ request()->routeIs('home') ? 'depth-layer-3 text-primary shadow-sm scale-110' : 'text-muted hover:depth-layer-2 hover:text-primary hover:scale-105' }}">
            <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 12l2-2m0 0l7-7 7 7M5 10v10a1 1 0 001 1h3m10-11l2 2m-2-2v10a1 1 0 01-1 1h-3m-6 0a1 1 0 001-1v-4a1 1 0 011-1h2a1 1 0 011 1v4a1 1 0 001 1m-6 0h6"/>
            </svg>
        </a>

        <!-- Propositions/Ideas (Center) - Featured -->
        <a href="{{ route('propositions.index') }}" class="flex items-center justify-center p-3 rounded-full transition-all {{ request()->routeIs('propositions.*') || request()->routeIs('propositions.index') ? 'depth-layer-3 text-primary shadow-md scale-110' : 'text-muted hover:depth-layer-2 hover:text-primary hover:scale-105' }}">
            <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9.663 17h4.673M12 3v1m6.364 1.636l-.707.707M21 12h-1M4 12H3m3.343-5.657l-.707-.707m2.828 9.9a5 5 0 117.072 0l-.548.547A3.374 3.374 0 0014 18.469V19a2 2 0 11-4 0v-.531c0-.895-.356-1.754-.988-2.386l-.548-.547z"/>
            </svg>
        </a>

        <!-- Profile (Right) -->
        @auth
            <a href="{{ route('profile.edit') }}" class="flex items-center justify-center p-3 rounded-full transition-all {{ request()->routeIs('profile.*') ? 'depth-layer-3 shadow-sm scale-110' : 'hover:depth-layer-2 hover:scale-105' }}">
                <img src="{{ Auth::user()->profile_picture_url }}" alt="Profile" class="w-6 h-6 rounded-full object-cover">
            </a>
        @else
            <a href="{{ route('login') }}" class="flex items-center justify-center p-3 rounded-full transition-all text-muted hover:depth-layer-2 hover:text-primary hover:scale-105">
                <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M16 7a4 4 0 11-8 0 4 4 0 018 0zM12 14a7 7 0 00-7 7h14a7 7 0 00-7-7z"/>
                </svg>
            </a>
        @endauth
    </div>
</nav>

<!-- Bottom padding to prevent content from being hidden behind the navigation -->
<div class="h-16"></div>