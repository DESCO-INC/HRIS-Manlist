<div>
    <!-- Table Card -->
    <div class="bg-white rounded-lg shadow-sm overflow-hidden">
        <div class="px-6 py-5 overflow-x-auto">

            <!-- Title -->
            <h2 class="text-lg font-semibold text-gray-800 mb-4">User Maintenance</h2>

            <!-- Toolbar: Search + Add User -->
            <div class="flex flex-col sm:flex-row sm:items-center sm:justify-between mb-5 gap-2">
                <!-- Search input -->
                <input type="text" wire:model.live="search" placeholder="Search"
                    class="border border-green-500 rounded px-2 py-1 text-sm w-full sm:w-48 focus:ring focus:ring-blue-300 focus:border-blue-500" />

                <!-- Add User button -->
                <button wire:click="openAddModal"
                    class="bg-green-500 text-white text-xs px-3 py-2 rounded hover:bg-green-600 text-center sm:ml-2 cursor-pointer transition">
                    Add User
                </button>
            </div>

            <!-- Table -->
            <div class="overflow-x-auto border border-gray-200 rounded">
                <table class="min-w-full divide-y divide-gray-200 text-sm">
                    <thead class="bg-green-500 text-white">
                        <tr>
                            <th class="px-4 py-4 text-left">Name</th>
                            <th class="px-4 py-4 text-left">Email</th>
                            <th class="px-4 py-4 text-left">Date Created</th>
                            <th class="px-4 py-4 text-left">Date Updated</th>
                            <th class="px-4 py-4 text-left">Option</th>
                        </tr>
                    </thead>
                    <tbody class="bg-white divide-y divide-gray-200">
                        @forelse($users as $user)
                            <tr>
                                <td class="px-4 py-4 text-xs">{{ $user->name }}</td>
                                <td class="px-4 py-4 text-xs">{{ $user->email }}</td>
                                <td class="px-4 py-4 text-xs">{{ $user->created_at }}</td>
                                <td class="px-4 py-4 text-xs">{{ $user->updated_at }}</td>
                                @if ($user->id != Auth::id())
                                    <td class="px-4 py-4 text-xs flex gap-2">
                                        <!-- Update Button -->
                                        <button wire:click="editUser({{ $user->id }})"
                                            class="px-2 py-1 bg-blue-500 text-white rounded text-xs hover:bg-blue-600 cursor-pointer transition">
                                            Update
                                        </button>

                                        <!-- Delete Button -->
                                        <button wire:click="confirmDelete({{ $user->id }})"
                                            class="px-2 py-1 bg-red-500 text-white rounded text-xs hover:bg-red-600 cursor-pointer transition">
                                            Delete
                                        </button>
                                    </td>
                                @endif
                            </tr>
                        @empty
                            <tr>
                                <td colspan="6" class="px-4 py-2 text-center text-gray-500">No records found</td>
                            </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>

            <!-- Pagination -->
            <div class="mt-4">
                {{ $users->links() }}
            </div>
        </div>
    </div>

    <!-- Add User Modal -->
    <div @if (!$showAddModal) style="display: none;" @endif
        class="fixed inset-0 z-50 flex items-center justify-center backdrop-blur-sm bg-black/30">

        <div class="bg-white rounded-lg shadow-xl w-full max-w-md p-6">
            <h2 class="text-xl font-semibold text-gray-800 mb-2">Add New User</h2>
            <p class="text-sm text-gray-600 mb-4">Fill out the information below to add a new user.</p>

            <form wire:submit.prevent="saveUser">
                <!-- Name -->
                <div class="mb-3">
                    <label class="block text-sm font-medium text-gray-700">Name</label>
                    <input type="text" wire:model="name" required
                        class="mt-1 block w-full border border-gray-300 rounded-md px-3 py-2 text-sm focus:ring-2 focus:ring-green-500 focus:border-green-500 outline-none">
                    @error('name')
                        <span class="text-red-600 text-sm">{{ $message }}</span>
                    @enderror
                </div>

                <!-- Email -->
                <div class="mb-3">
                    <label class="block text-sm font-medium text-gray-700">Email</label>
                    <input type="email" wire:model="email" required
                        class="mt-1 block w-full border border-gray-300 rounded-md px-3 py-2 text-sm focus:ring-2 focus:ring-green-500 focus:border-green-500 outline-none">
                    @error('email')
                        <span class="text-red-600 text-sm">{{ $message }}</span>
                    @enderror
                </div>

                <!-- Credential -->
                <div class="mb-3">
                    <label class="block text-sm font-medium text-gray-700">Credentials</label>
                    <select wire:model="credential" id="credential" name="credential" required
                        class="w-full px-3 py-2 border border-gray-300 rounded-md focus:ring-2 focus:ring-green-500 focus:border-green-500 outline-none">
                        <option value="">-Select-</option>
                        <option value="STAFF">STAFF</option>
                        <option value="ADMIN">ADMIN</option>
                    </select>
                    @error('credential')
                        <span class="text-red-600 text-sm">{{ $message }}</span>
                    @enderror
                </div>

                <!-- Password -->
                <div class="mb-3">
                    <label class="block text-sm font-medium text-gray-700">Password</label>
                    <input type="password" wire:model="password" required
                        class="mt-1 block w-full border border-gray-300 rounded-md px-3 py-2 text-sm focus:ring-2 focus:ring-green-500 focus:border-green-500 outline-none">
                    @error('password')
                        <span class="text-red-600 text-sm">{{ $message }}</span>
                    @enderror
                </div>

                <!-- Confirm Password -->
                <div class="mb-3">
                    <label class="block text-sm font-medium text-gray-700">Confirm Password</label>
                    <input type="password" wire:model="password_confirmation" required
                        class="mt-1 block w-full border border-gray-300 rounded-md px-3 py-2 text-sm focus:ring-2 focus:ring-green-500 focus:border-green-500 outline-none">
                    @error('password_confirmation')
                        <span class="text-red-600 text-sm">{{ $message }}</span>
                    @enderror
                </div>

                <!-- Buttons -->
                <div class="mt-6 flex justify-end space-x-3">
                    <button type="button" wire:click="closeAddModal"
                        class="px-4 py-2 bg-gray-200 text-gray-800 rounded-md hover:bg-gray-300 transition">
                        Cancel
                    </button>
                    <button type="submit"
                        class="px-4 py-2 bg-green-500 text-white rounded-md hover:bg-green-600 transition">
                        Save
                    </button>
                </div>
            </form>
        </div>
    </div>

    <!-- Delete Confirmation Modal -->
    <div @if (!$showDeleteModal) style="display: none;" @endif
        class="fixed inset-0 z-50 flex items-center justify-center backdrop-blur-sm bg-black/30">

        <div class="bg-white rounded-lg shadow-xl w-full max-w-md p-6">
            <h2 class="text-xl font-semibold text-gray-800">Confirm Delete</h2>
            <p class="mt-2 text-sm text-gray-600">
                Are you sure you want to delete this user? This action cannot be undone.
            </p>

            <div class="mt-6 flex justify-end space-x-3">
                <button type="button" wire:click="cancelDelete"
                    class="px-4 py-2 bg-gray-200 text-gray-800 rounded-md hover:bg-gray-300 transition">
                    Cancel
                </button>

                <button type="button" wire:click="deleteUser"
                    class="px-4 py-2 bg-red-600 text-white rounded-md hover:bg-red-700 transition">
                    Delete
                </button>
            </div>
        </div>
    </div>

    <!-- Update User Modal -->
<div @if(!$showEditModal) style="display: none;" @endif
    class="fixed inset-0 z-50 flex items-center justify-center backdrop-blur-sm bg-black/30">

    <div class="bg-white rounded-lg shadow-xl w-full max-w-md p-6">
        <h2 class="text-xl font-semibold text-gray-800 mb-2">Update User</h2>
        <p class="text-sm text-gray-600 mb-4">Edit the information below to update the user.</p>

        <form wire:submit.prevent="updateUser">
            <!-- Name -->
            <div class="mb-3">
                <label class="block text-sm font-medium text-gray-700">Name</label>
                <input type="text" wire:model="name" required
                    class="mt-1 block w-full border border-gray-300 rounded-md px-3 py-2 text-sm focus:ring-2 focus:ring-green-500 focus:border-green-500 outline-none">
                @error('name') <span class="text-red-600 text-sm">{{ $message }}</span> @enderror
            </div>

            <!-- Email -->
            <div class="mb-3">
                <label class="block text-sm font-medium text-gray-700">Email</label>
                <input type="email" wire:model="email" required
                    class="mt-1 block w-full border border-gray-300 rounded-md px-3 py-2 text-sm focus:ring-2 focus:ring-green-500 focus:border-green-500 outline-none">
                @error('email') <span class="text-red-600 text-sm">{{ $message }}</span> @enderror
            </div>

            <!-- Password (optional) -->
            <div class="mb-3">
                <label class="block text-sm font-medium text-gray-700">Password (Leave blank if not changing)</label>
                <input type="password" wire:model="password"
                    class="mt-1 block w-full border border-gray-300 rounded-md px-3 py-2 text-sm focus:ring-2 focus:ring-green-500 focus:border-green-500 outline-none">
                @error('password') <span class="text-red-600 text-sm">{{ $message }}</span> @enderror
            </div>

            <!-- Confirm Password -->
            <div class="mb-3">
                <label class="block text-sm font-medium text-gray-700">Confirm Password</label>
                <input type="password" wire:model="password_confirmation"
                    class="mt-1 block w-full border border-gray-300 rounded-md px-3 py-2 text-sm focus:ring-2 focus:ring-green-500 focus:border-green-500 outline-none">
                @error('password_confirmation') <span class="text-red-600 text-sm">{{ $message }}</span> @enderror
            </div>

            <!-- Buttons -->
            <div class="mt-6 flex justify-end space-x-3">
                <button type="button" wire:click="closeEditModal"
                    class="px-4 py-2 bg-gray-200 text-gray-800 rounded-md hover:bg-gray-300 transition">
                    Cancel
                </button>
                <button type="submit"
                    class="px-4 py-2 bg-blue-500 text-white rounded-md hover:bg-blue-600 transition">
                    Update
                </button>
            </div>
        </form>
    </div>
</div>



</div>
