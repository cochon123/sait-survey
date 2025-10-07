@forelse($propositions as $proposition)
    <x-proposition-card :proposition="$proposition" />
@empty
    <div class="frosted-card p-12 text-center">
        <svg class="w-16 h-16 mx-auto mb-4 text-muted opacity-50" fill="none" stroke="currentColor" viewBox="0 0 24 24">
            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9.663 17h4.673M12 3v1m6.364 1.636l-.707.707M21 12h-1M4 12H3m3.343-5.657l-.707-.707m2.828 9.9a5 5 0 117.072 0l-.548.547A3.374 3.374 0 0014 18.469V19a2 2 0 11-4 0v-.531c0-.895-.356-1.754-.988-2.386l-.548-.547z"></path>
        </svg>
        <p class="text-muted text-lg mb-2">No propositions yet</p>
        <p class="text-muted text-sm">Be the first to share your idea!</p>
    </div>
@endforelse