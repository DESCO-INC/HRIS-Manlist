<div>
    <h1 class="text-xl font-semibold text-white mb-5">Welcome, {{ Auth::user()->name }}</h1>

    <div class="bg-white rounded-lg shadow-sm overflow-hidden">
        <!-- Table -->
        <div class="px-6 py-5 overflow-x-auto">
            <div>
                <p>Search: {{ $search }}</p>
                <input type="text" wire:model.live="search" placeholder="Type something..." />
            </div>
        </div>
    </div>
</div>
