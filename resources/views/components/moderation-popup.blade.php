<!-- Popup de modération -->
<div id="moderation-popup" class="fixed inset-0 bg-black bg-opacity-50 flex items-center justify-center z-50 hidden">
    <div class="frosted-card max-w-md w-full mx-4 p-6 rounded-xl">
        <div class="flex items-center mb-4">
            <div class="w-12 h-12 bg-red-100 rounded-full flex items-center justify-center mr-4">
                <svg class="w-6 h-6 text-red-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 9v2m0 4h.01m-6.938 4h13.856c1.54 0 2.502-1.667 1.732-2.5L13.732 4c-.77-.833-1.732-.833-2.464 0L4.35 16.5c-.77.833.192 2.5 1.732 2.5z"></path>
                </svg>
            </div>
            <div>
                <h3 class="text-lg font-semibold text-text">Content Rejected</h3>
                <p class="text-sm text-text-muted">Your content does not meet our guidelines</p>
            </div>
        </div>
        
        <div class="mb-6">
            <p class="text-sm text-text-muted mb-2">Raison du rejet :</p>
            <p id="moderation-reason" class="text-sm text-text bg-bg-light p-3 rounded-lg"></p>
        </div>
        
        <div class="flex gap-3">
            <button id="moderation-edit-btn" class="flex-1 bg-brand text-black px-4 py-2 rounded-lg hover:bg-yellow-400 transition-colors">
                Edit
            </button>
            <button id="moderation-close-btn" class="flex-1 bg-bg-light text-text px-4 py-2 rounded-lg hover:bg-opacity-80 transition-colors">
                Fermer
            </button>
        </div>
    </div>
</div>