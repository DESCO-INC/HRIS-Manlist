<div>
    <!-- Profile Card -->
    <div class="bg-white rounded-lg shadow-lg overflow-hidden relative">

        <!-- Edit Button -->
        @if (!$isEditing)
            <button wire:click="enableEdit"
                class="absolute top-4 right-4 bg-green-500 text-white px-3 py-1 rounded hover:bg-green-600 transition">
                Edit
            </button>
        @endif

        <!-- Avatar -->
        <div class="flex justify-start m-6">
            <div
                class="w-24 h-24 rounded-full flex items-center justify-center bg-green-500 text-white text-3xl font-bold border-4 border-green-500">
                {{ collect(explode(' ', Auth::user()->name))->map(fn($n) => $n[0])->take(2)->join('') }}
            </div>
        </div>

        <!-- Profile Details -->
        <div class="px-6 py-6">

            <!-- Name -->
            <div class="mb-4">
                <label class="block text-gray-700 font-medium mb-1">Name</label>
                <input type="text" wire:model="name" @if (!$isEditing) disabled @endif
                    class="w-full px-3 py-2 border border-gray-300 rounded-md focus:ring-2 focus:ring-green-500 focus:border-green-500 outline-none bg-white @if (!$isEditing) bg-gray-100 cursor-not-allowed @endif">
            </div>

            <!-- Email -->
            <div class="mb-4">
                <label class="block text-gray-700 font-medium mb-1">Email</label>
                <input type="email" wire:model="email" @if (!$isEditing) disabled @endif
                    class="w-full px-3 py-2 border border-gray-300 rounded-md focus:ring-2 focus:ring-green-500 focus:border-green-500 outline-none bg-white @if (!$isEditing) bg-gray-100 cursor-not-allowed @endif">
                <x-form-error name='email' />
            </div>

            <!-- Credential -->
            <div class="mb-4">
                <label class="block text-gray-700 font-medium mb-1">Credential</label>
                <select wire:model="credential" id="credential" name="credential"
                    @if (!$isEditing) disabled @endif required
                    class="w-full px-3 py-2 border border-gray-300 rounded-md focus:ring-2 focus:ring-green-500 focus:border-green-500 outline-none bg-white @if (!$isEditing) bg-gray-100 cursor-not-allowed @endif">
                    <option value="">-Select-</option>
                    <option value="STAFF">STAFF</option>
                    <option value="ADMIN">ADMIN</option>
                </select>

                <x-form-error name='credential' />
            </div>

            <!-- Password -->
            @if ($isEditing)
                <div class="mb-4">
                    <label class="block text-gray-700 font-medium mb-1">New Password (optional)</label>
                    <input type="password" wire:model="password"
                        class="w-full px-3 py-2 border border-gray-300 rounded-md focus:ring-2 focus:ring-green-500 focus:border-green-500 outline-none">
                    <x-form-error name='password' />
                </div>
            @endif

            <!-- Save Button -->
            @if ($isEditing)
                <div class="flex justify-end">
                    <button wire:click="saveProfile"
                        class="px-4 py-2 bg-green-500 text-white rounded-md hover:bg-green-600 transition">
                        Save
                    </button>
                </div>
            @endif
        </div>
    </div>
</div>
