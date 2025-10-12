@auth
    <form id="proposition-form" method="POST" action="{{ route('propositions.store') }}" class="flex p-3 items-center gap-3 sticky top-[4rem] z-30 -mx-4 px-4 mb-4">
        @csrf
        <div class="flex-1 relative">
            <input type="text" name="content" id="content" placeholder="Share your idea to improve SAIT..." maxlength="1000" required class="form-input !rounded-full w-full pr-12">
        </div>
        <button type="submit" class="btn-primary !p-3 !rounded-full aspect-square flex-shrink-0">
            <svg width="20px" height="20px" viewBox="0 0 24 24" fill="none" stroke="currentColor">
                <path d="M12 19l9 2-9-18-9 18 9-2zm0 0v-8" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"/>
            </svg>
        </button>
    </form>
@else
    <div class="flex items-center gap-3 sticky top-[4rem] z-30 -mx-4 px-4 py-3 mb-4">
        <input
            type="text"
            id="guest-proposition-input"
            placeholder="Share your idea to improve SAIT..."
            maxlength="1000"
            class="form-input flex-1 !rounded-full"
        >
        <button
            id="guest-send-btn"
            class="btn-primary !p-3 !rounded-full aspect-square flex-shrink-0"
        >
            <svg width="20px" height="20px" viewBox="0 0 24 24" fill="none" stroke="currentColor">
                <path d="M12 19l9 2-9-18-9 18 9-2zm0 0v-8" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"/>
            </svg>
        </button>
    </div>
@endauth
