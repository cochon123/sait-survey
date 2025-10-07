<div class="sticky-filter p-4 mb-6 sticky top-[8.5rem] z-20">
    <div class="flex justify-between items-center gap-3">
        <div class="flex gap-2">
            <button id="sort-recent" class="btn-primary px-3 py-1.5 text-xs font-medium whitespace-nowrap">Recent</button>
            <button id="sort-top" class="btn-secondary px-3 py-1.5 text-xs font-medium whitespace-nowrap">Top</button>
        </div>
        <div class="text-xs text-muted whitespace-nowrap">
            <span id="proposition-count">{{ $propositions->total() }}</span> ideas
        </div>
    </div>
</div>
