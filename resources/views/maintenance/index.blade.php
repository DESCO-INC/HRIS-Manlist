<x-layout>
    <h1 class="text-xl font-semibold text-white mb-5">System Maintenance</h1>

    <!-- Card with Top Right Buttons -->
    <div class="bg-white rounded-lg shadow-sm overflow-hidden mb-3">
        <div class="flex flex-col sm:flex-row sm:items-center sm:justify-between px-6 py-4">
            <h2 class="text-lg font-medium text-gray-800">User Maintenance</h2>
            <!-- Button Row (Right) -->
            <button type="button" onclick="openAddUserModal()"
                class="bg-green-500 text-white text-xs px-2 py-1 rounded hover:bg-green-600">
                Add User
            </button>
        </div>
    </div>

    <div class="bg-white rounded-lg shadow-sm overflow-hidden">
        <div class="px-6 py-5 overflow-x-auto">
            <!-- Search -->
            <form method="GET" class="mb-4 flex items-center gap-2">
                <x-basic.input type="text" name="search" value="{{ $search }}" placeholder="Search" />
                <x-basic.button variant="success">Search</x-basic.button>
            </form>

            <x-table.main class="">
                <thead class="bg-green-600 text-white">
                    <x-table.th>Name</x-table.th>
                    <x-table.th>Email</x-table.th>
                    <x-table.th>Credential</x-table.th>
                    <x-table.th>Date Created</x-table.th>
                    <x-table.th>Date Updated</x-table.th>
                    <x-table.th>Option</x-table.th>
                </thead>
                <tbody>
                    @forelse ($users as $user)
                        <tr>
                            <x-table.td>{{ $user->name }}</x-table.td>
                            <x-table.td>{{ $user->email }}</x-table.td>
                            <x-table.td>{{ $user->credential }}</x-table.td>
                            <x-table.td>{{ $user->created_at }}</x-table.td>
                            <x-table.td>{{ $user->updated_at }}</x-table.td>
                            <x-table.td class="text-center">
                                @if ($user->id != Auth::id())
                                    <button type="button"
                                        onclick="openUpdateUserModal({{ $user->id }}, '{{ $user->name }}', '{{ $user->email }}', '{{ $user->credential }}')"
                                        class="bg-green-500 text-white text-xs px-2 py-1 rounded hover:bg-green-600 inline-block">
                                        Update
                                    </button>
                                    <button type="button" onclick="openDeleteUserModal({{ $user->id }})"
                                        class="bg-red-500 text-white text-xs px-2 py-1 rounded hover:bg-red-600 inline-block">
                                        Delete
                                    </button>
                                @endif
                            </x-table.td>
                        </tr>
                    @empty
                        <tr>
                            <x-table.td colspan="6" class="text-center text-gray-500">
                                No records found
                            </x-table.td>
                        </tr>
                    @endforelse
                </tbody>

            </x-table.main>

            <!-- Pagination -->
            <div class="mt-4">
                {{ $users->appends(['search' => $search])->links() }}
            </div>
        </div>
    </div>

    <!-- Add User Modal -->
    <div id="addUserModal" class="fixed inset-0 z-50 hidden items-center justify-center backdrop-blur-sm bg-black/30">

        <div class="bg-white rounded-lg shadow-xl w-full max-w-md p-6">
            <h2 class="text-xl font-semibold text-gray-800 mb-2">Add New User</h2>
            <p class="text-sm text-gray-600 mb-4">
                Fill out the information below to add a new user.
            </p>

            <form method="POST" action="{{ route('maintenance.store_user') }}">
                @csrf

                <!-- Name -->
                <div class="mb-3">
                    <label class="block text-sm font-medium text-gray-700">Name</label>
                    <input type="text" name="name" value="{{ old('name') }}" required
                        class="mt-1 block w-full border border-gray-300 rounded-md px-3 py-2 text-sm focus:ring-2 focus:ring-green-500 focus:border-green-500 outline-none">
                    @error('name')
                        <span class="text-red-600 text-sm">{{ $message }}</span>
                    @enderror
                </div>

                <!-- Email -->
                <div class="mb-3">
                    <label class="block text-sm font-medium text-gray-700">Email</label>
                    <input type="email" name="email" value="{{ old('email') }}" required
                        class="mt-1 block w-full border border-gray-300 rounded-md px-3 py-2 text-sm focus:ring-2 focus:ring-green-500 focus:border-green-500 outline-none">
                    @error('email')
                        <span class="text-red-600 text-sm">{{ $message }}</span>
                    @enderror
                </div>

                <!-- Credential -->
                <div class="mb-3">
                    <label class="block text-sm font-medium text-gray-700">Credentials</label>
                    <select name="credential" required
                        class="w-full px-3 py-2 border border-gray-300 rounded-md focus:ring-2 focus:ring-green-500 focus:border-green-500 outline-none">
                        <option value="">- Select -</option>
                        <option value="STAFF" {{ old('credential') == 'STAFF' ? 'selected' : '' }}>STAFF</option>
                        <option value="ADMIN" {{ old('credential') == 'ADMIN' ? 'selected' : '' }}>ADMIN</option>
                    </select>
                    @error('credential')
                        <span class="text-red-600 text-sm">{{ $message }}</span>
                    @enderror
                </div>

                <!-- Password -->
                <div class="mb-3">
                    <label class="block text-sm font-medium text-gray-700">Password</label>
                    <input type="password" name="password" required
                        class="mt-1 block w-full border border-gray-300 rounded-md px-3 py-2 text-sm focus:ring-2 focus:ring-green-500 focus:border-green-500 outline-none">
                    @error('password')
                        <span class="text-red-600 text-sm">{{ $message }}</span>
                    @enderror
                </div>

                <!-- Confirm Password -->
                <div class="mb-3">
                    <label class="block text-sm font-medium text-gray-700">Confirm Password</label>
                    <input type="password" name="password_confirmation" required
                        class="mt-1 block w-full border border-gray-300 rounded-md px-3 py-2 text-sm focus:ring-2 focus:ring-green-500 focus:border-green-500 outline-none">
                </div>

                <!-- Buttons -->
                <div class="mt-6 flex justify-end space-x-3">
                    <button type="button" onclick="closeAddUserModal()"
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
    <div id="deleteUserModal"
        class="fixed inset-0 z-50 hidden items-center justify-center backdrop-blur-sm bg-black/30">

        <div class="bg-white rounded-lg shadow-xl w-full max-w-md p-6">
            <h2 class="text-xl font-semibold text-gray-800">Confirm Delete</h2>
            <p class="mt-2 text-sm text-gray-600">
                Are you sure you want to delete this user? This action cannot be undone.
            </p>

            <form id="deleteUserForm" method="POST">
                @csrf
                @method('DELETE')

                <div class="mt-6 flex justify-end space-x-3">
                    <button type="button" onclick="closeDeleteUserModal()"
                        class="px-4 py-2 bg-gray-200 text-gray-800 rounded-md hover:bg-gray-300 transition">
                        Cancel
                    </button>

                    <button type="submit"
                        class="px-4 py-2 bg-red-600 text-white rounded-md hover:bg-red-700 transition">
                        Yes, Delete
                    </button>
                </div>
            </form>
        </div>
    </div>


    <!-- Update User Modal -->
    <div id="updateUserModal"
        class="fixed inset-0 z-50 hidden items-center justify-center backdrop-blur-sm bg-black/30">

        <div class="bg-white rounded-lg shadow-xl w-full max-w-md p-6">
            <h2 class="text-xl font-semibold text-gray-800 mb-2">Update User</h2>
            <p class="text-sm text-gray-600 mb-4">
                Edit the information below to update the user.
            </p>

            <!-- Use a placeholder action; JS will replace it -->
            <form id="updateUserForm" method="POST">
                @csrf
                @method('PUT')

                <!-- Name -->
                <div class="mb-3">
                    <label class="block text-sm font-medium text-gray-700">Name</label>
                    <input type="text" id="edit_name" name="name" required
                        class="mt-1 block w-full border border-gray-300 rounded-md px-3 py-2 text-sm focus:ring-2 focus:ring-green-500 focus:border-green-500 outline-none">
                </div>

                <!-- Email -->
                <div class="mb-3">
                    <label class="block text-sm font-medium text-gray-700">Email</label>
                    <input type="email" id="edit_email" name="email" required
                        class="mt-1 block w-full border border-gray-300 rounded-md px-3 py-2 text-sm focus:ring-2 focus:ring-green-500 focus:border-green-500 outline-none">
                </div>

                <!-- Credential -->
                <div class="mb-3">
                    <label class="block text-sm font-medium text-gray-700">Credentials</label>
                    <select id="edit_credential" name="credential" required
                        class="w-full px-3 py-2 border border-gray-300 rounded-md focus:ring-2 focus:ring-green-500 focus:border-green-500 outline-none">
                        <option value="">- Select -</option>
                        <option value="STAFF">STAFF</option>
                        <option value="ADMIN">ADMIN</option>
                    </select>
                </div>

                <!-- Password -->
                <div class="mb-3">
                    <label class="block text-sm font-medium text-gray-700">
                        Password (leave blank if not changing)
                    </label>
                    <input type="password" name="password"
                        class="mt-1 block w-full border border-gray-300 rounded-md px-3 py-2 text-sm focus:ring-2 focus:ring-green-500 focus:border-green-500 outline-none">
                </div>

                <!-- Confirm Password -->
                <div class="mb-3">
                    <label class="block text-sm font-medium text-gray-700">Confirm Password</label>
                    <input type="password" name="password_confirmation"
                        class="mt-1 block w-full border border-gray-300 rounded-md px-3 py-2 text-sm focus:ring-2 focus:ring-green-500 focus:border-green-500 outline-none">
                </div>

                <!-- Buttons -->
                <div class="mt-6 flex justify-end space-x-3">
                    <button type="button" onclick="closeUpdateUserModal()"
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


    <script>
        // Open/close Add User Modal
        function openAddUserModal() {
            const modal = document.getElementById('addUserModal');
            modal.classList.remove('hidden');
            modal.classList.add('flex');
        }
        function closeAddUserModal() {
            const modal = document.getElementById('addUserModal');
            modal.classList.add('hidden');
            modal.classList.remove('flex');
        }

        // Open/close Update User Modal
        function openUpdateUserModal(id, name, email, credential) {
            document.getElementById('edit_name').value = name;
            document.getElementById('edit_email').value = email;
            document.getElementById('edit_credential').value = credential;

            const form = document.getElementById('updateUserForm');
            form.action = "{{ route('maintenance.update_user', ':id') }}".replace(':id', id);

            const modal = document.getElementById('updateUserModal');
            modal.classList.remove('hidden');
            modal.classList.add('flex');
        }
        function closeUpdateUserModal() {
            const modal = document.getElementById('updateUserModal');
            modal.classList.add('hidden');
            modal.classList.remove('flex');
        }

        // Open/close Delete User Modal
        function openDeleteUserModal(id) {
            const form = document.getElementById('deleteUserForm');
            form.action = "{{ route('maintenance.delete_user', ':id') }}".replace(':id', id);

            const modal = document.getElementById('deleteUserModal');
            modal.classList.remove('hidden');
            modal.classList.add('flex');
        }
        function closeDeleteUserModal() {
            const modal = document.getElementById('deleteUserModal');
            modal.classList.add('hidden');
            modal.classList.remove('flex');
        }
    </script>


    @if ($errors->any())
        <script>
            document.addEventListener('DOMContentLoaded', () => {
                openAddUserModal();
            });
        </script>
    @endif

    @if ($errors->any() && old('_method') === 'PUT')
        <script>
            document.addEventListener('DOMContentLoaded', () => {
                openUpdateUserModal(
                    {{ old('user_id', 'null') }},
                    "{{ old('name') }}",
                    "{{ old('email') }}"
                );
            });
        </script>
    @endif

</x-layout>
