<div id="propositions-list" class="space-y-4">
    @include('propositions.partials._propositions-list', ['propositions' => $propositions])
</div>

<!-- Loading Spinner -->
<div id="loading-spinner" class="hidden text-center py-8">
    <div class="inline-flex items-center gap-3">
        <div class="animate-spin rounded-full h-8 w-8 border-b-2 border-brand"></div>
        <span class="text-muted">Loading more ideas...</span>
    </div>
</div>

<!-- End of content indicator -->
<div id="end-of-content" class="hidden text-center py-8">
    <div class="frosted-card p-6">
        <p class="text-muted">You've reached the end! 🎉</p>
        <p class="text-muted text-sm mt-1">All ideas have been loaded.</p>
    </div>
</div>
