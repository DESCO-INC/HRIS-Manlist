<x-layout>
    <h1 class="text-xl font-semibold text-white mb-5">Other Maintenance</h1>

    {{-- CLASSIFICATION LIST --}}
    <div class="bg-white rounded-lg shadow-sm overflow-hidden mb-5">
        <div class="px-6 py-5 overflow-x-auto">
            <div class="flex flex-col sm:flex-row sm:items-center sm:justify-between pb-4">
                <h2 class="text-lg font-medium text-gray-800">Classification List</h2>
                <!-- Button Row (Right) -->
                <button type="button" data-modal="addClassList_Modal"
                    class="bg-green-500 text-white text-xs px-2 py-1 rounded hover:bg-green-600">
                    Add Item
                </button>
            </div>

            <x-table.main class="">
                <thead class="bg-green-600 text-white">
                    <x-table.th>ID</x-table.th>
                    <x-table.th>Name</x-table.th>
                    <x-table.th>Date Created</x-table.th>
                    <x-table.th>Option</x-table.th>
                </thead>
                <tbody>
                    @forelse ($classlist as $clist)
                        <tr>
                            <x-table.td>{{ $clist->id }}</x-table.td>
                            <x-table.td>{{ $clist->name }}</x-table.td>
                            <x-table.td>{{ $clist->created_at }}</x-table.td>
                            <x-table.td class="text-center">
                                <button type="button"
                                    data-delete-action="{{ route('maintenance.delete_classList', $clist->id) }}"
                                    data-delete-modal="deleteModal"
                                    class="bg-red-500 text-white text-xs px-2 py-1 rounded hover:bg-red-600">
                                    Delete
                                </button>
                            </x-table.td>
                        </tr>
                    @empty
                        <tr>
                            <x-table.td colspan="4" class="text-center text-gray-500">
                                No records found
                            </x-table.td>
                        </tr>
                    @endforelse
                </tbody>

            </x-table.main>

            <!-- Pagination -->
            <div class="mt-4">
                {{ $classlist->links() }}
            </div>
        </div>
    </div>

    {{-- DEPARTMENT LIST --}}
    <div class="bg-white rounded-lg shadow-sm overflow-hidden mb-5">
        <div class="px-6 py-5 overflow-x-auto">
            <div class="flex flex-col sm:flex-row sm:items-center sm:justify-between pb-4">
                <h2 class="text-lg font-medium text-gray-800">Department List</h2>
                <!-- Button Row (Right) -->
                <button type="button" data-modal="addDeptList_Modal"
                    class="bg-green-500 text-white text-xs px-2 py-1 rounded hover:bg-green-600">
                    Add Item
                </button>
            </div>

            <x-table.main class="">
                <thead class="bg-green-600 text-white">
                    <x-table.th>Code</x-table.th>
                    <x-table.th>Name</x-table.th>
                    <x-table.th>Description</x-table.th>
                    <x-table.th>Date Created</x-table.th>
                    <x-table.th>Option</x-table.th>
                </thead>
                <tbody>
                    @forelse ($deptlist as $dept)
                        <tr>
                            <x-table.td>{{ $dept->code }}</x-table.td>
                            <x-table.td>{{ $dept->name }}</x-table.td>
                            <x-table.td>{{ $dept->description }}</x-table.td>
                            <x-table.td>{{ $dept->created_at }}</x-table.td>
                            <x-table.td class="text-center">
                                <button type="button"
                                    data-delete-action="{{ route('maintenance.delete_deptList', $dept->id) }}"
                                    data-delete-modal="deleteModal"
                                    class="bg-red-500 text-white text-xs px-2 py-1 rounded hover:bg-red-600">
                                    Delete
                                </button>
                            </x-table.td>
                        </tr>
                    @empty
                        <tr>
                            <x-table.td colspan="5" class="text-center text-gray-500">
                                No records found
                            </x-table.td>
                        </tr>
                    @endforelse
                </tbody>

            </x-table.main>

            <!-- Pagination -->
            <div class="mt-4">
                {{ $deptlist->links() }}
            </div>
        </div>
    </div>

    {{-- EMP STATUS LIST --}}
    <div class="bg-white rounded-lg shadow-sm overflow-hidden mb-5">
        <div class="px-6 py-5 overflow-x-auto">
            <div class="flex flex-col sm:flex-row sm:items-center sm:justify-between pb-4">
                <h2 class="text-lg font-medium text-gray-800">Employment Status List</h2>
                <!-- Button Row (Right) -->
                <button type="button" data-modal="addStatusList_Modal"
                    class="bg-green-500 text-white text-xs px-2 py-1 rounded hover:bg-green-600">
                    Add Item
                </button>
            </div>

            <x-table.main class="">
                <thead class="bg-green-600 text-white">
                    <x-table.th>ID</x-table.th>
                    <x-table.th>Name</x-table.th>
                    <x-table.th>Date Created</x-table.th>
                    <x-table.th>Option</x-table.th>
                </thead>
                <tbody>
                    @forelse ($statuslist as $slist)
                        <tr>
                            <x-table.td>{{ $slist->id }}</x-table.td>
                            <x-table.td>{{ $slist->name }}</x-table.td>
                            <x-table.td>{{ $slist->created_at }}</x-table.td>
                            <x-table.td class="text-center">
                                <button type="button"
                                    data-delete-action="{{ route('maintenance.delete_statusList', $slist->id) }}"
                                    data-delete-modal="deleteModal"
                                    class="bg-red-500 text-white text-xs px-2 py-1 rounded hover:bg-red-600">
                                    Delete
                                </button>
                            </x-table.td>
                        </tr>
                    @empty
                        <tr>
                            <x-table.td colspan="4" class="text-center text-gray-500">
                                No records found
                            </x-table.td>
                        </tr>
                    @endforelse
                </tbody>

            </x-table.main>

            <!-- Pagination -->
            <div class="mt-4">
                {{ $statuslist->links() }}
            </div>
        </div>
    </div>

    {{-- LICENSURE LIST --}}
    <div class="bg-white rounded-lg shadow-sm overflow-hidden mb-5">
        <div class="px-6 py-5 overflow-x-auto">
            <div class="flex flex-col sm:flex-row sm:items-center sm:justify-between pb-4">
                <h2 class="text-lg font-medium text-gray-800">Licensure List</h2>
                <!-- Button Row (Right) -->
                <button type="button" data-modal="addLicenseList_Modal"
                    class="bg-green-500 text-white text-xs px-2 py-1 rounded hover:bg-green-600">
                    Add Item
                </button>
            </div>

            <x-table.main class="">
                <thead class="bg-green-600 text-white">
                    <x-table.th>ID</x-table.th>
                    <x-table.th>Name</x-table.th>
                    <x-table.th>Date Created</x-table.th>
                    <x-table.th>Option</x-table.th>
                </thead>
                <tbody>
                    @forelse ($licenselist as $llist)
                        <tr>
                            <x-table.td>{{ $llist->id }}</x-table.td>
                            <x-table.td>{{ $llist->name }}</x-table.td>
                            <x-table.td>{{ $llist->created_at }}</x-table.td>
                            <x-table.td class="text-center">
                                <button type="button"
                                    data-delete-action="{{ route('maintenance.delete_licenseList', $llist->id) }}"
                                    data-delete-modal="deleteModal"
                                    class="bg-red-500 text-white text-xs px-2 py-1 rounded hover:bg-red-600">
                                    Delete
                                </button>
                            </x-table.td>
                        </tr>
                    @empty
                        <tr>
                            <x-table.td colspan="4" class="text-center text-gray-500">
                                No records found
                            </x-table.td>
                        </tr>
                    @endforelse
                </tbody>

            </x-table.main>

            <!-- Pagination -->
            <div class="mt-4">
                {{ $licenselist->links() }}
            </div>
        </div>
    </div>

    {{-- PROJECT LIST --}}
    <div class="bg-white rounded-lg shadow-sm overflow-hidden mb-5">
        <div class="px-6 py-5 overflow-x-auto">
            <div class="flex flex-col sm:flex-row sm:items-center sm:justify-between pb-4">
                <h2 class="text-lg font-medium text-gray-800">Project Assigned List</h2>
                <!-- Button Row (Right) -->
                <button type="button" data-modal="addProjectList_Modal"
                    class="bg-green-500 text-white text-xs px-2 py-1 rounded hover:bg-green-600">
                    Add Item
                </button>
            </div>

            <x-table.main class="">
                <thead class="bg-green-600 text-white">
                    <x-table.th>ID</x-table.th>
                    <x-table.th>Name</x-table.th>
                    <x-table.th>Date Created</x-table.th>
                    <x-table.th>Option</x-table.th>
                </thead>
                <tbody>
                    @forelse ($projectlist as $plist)
                        <tr>
                            <x-table.td>{{ $plist->id }}</x-table.td>
                            <x-table.td>{{ $plist->name }}</x-table.td>
                            <x-table.td>{{ $plist->created_at }}</x-table.td>
                            <x-table.td class="text-center">
                                <button type="button"
                                    data-delete-action="{{ route('maintenance.delete_projectList', $plist->id) }}"
                                    data-delete-modal="deleteModal"
                                    class="bg-red-500 text-white text-xs px-2 py-1 rounded hover:bg-red-600">
                                    Delete
                                </button>
                            </x-table.td>
                        </tr>
                    @empty
                        <tr>
                            <x-table.td colspan="4" class="text-center text-gray-500">
                                No records found
                            </x-table.td>
                        </tr>
                    @endforelse
                </tbody>

            </x-table.main>

            <!-- Pagination -->
            <div class="mt-4">
                {{ $projectlist->links() }}
            </div>
        </div>
    </div>

    {{-- SITE LIST --}}
    <div class="bg-white rounded-lg shadow-sm overflow-hidden mb-5">
        <div class="px-6 py-5 overflow-x-auto">
            <div class="flex flex-col sm:flex-row sm:items-center sm:justify-between pb-4">
                <h2 class="text-lg font-medium text-gray-800">Site List</h2>
                <!-- Button Row (Right) -->
                <button type="button" data-modal="addSiteList_Modal"
                    class="bg-green-500 text-white text-xs px-2 py-1 rounded hover:bg-green-600">
                    Add Item
                </button>
            </div>

            <x-table.main class="">
                <thead class="bg-green-600 text-white">
                    <x-table.th>ID</x-table.th>
                    <x-table.th>Name</x-table.th>
                    <x-table.th>Date Created</x-table.th>
                    <x-table.th>Option</x-table.th>
                </thead>
                <tbody>
                    @forelse ($sitelist as $slist)
                        <tr>
                            <x-table.td>{{ $slist->id }}</x-table.td>
                            <x-table.td>{{ $slist->name }}</x-table.td>
                            <x-table.td>{{ $slist->created_at }}</x-table.td>
                            <x-table.td class="text-center">
                                <button type="button"
                                    data-delete-action="{{ route('maintenance.delete_siteList', $slist->id) }}"
                                    data-delete-modal="deleteModal"
                                    class="bg-red-500 text-white text-xs px-2 py-1 rounded hover:bg-red-600">
                                    Delete
                                </button>
                            </x-table.td>
                        </tr>
                    @empty
                        <tr>
                            <x-table.td colspan="4" class="text-center text-gray-500">
                                No records found
                            </x-table.td>
                        </tr>
                    @endforelse
                </tbody>

            </x-table.main>

            <!-- Pagination -->
            <div class="mt-4">
                {{ $sitelist->links() }}
            </div>
        </div>
    </div>

    <!-- Add Classification Modal -->
    <div id="addClassList_Modal"
        class="fixed inset-0 z-50 hidden items-center justify-center backdrop-blur-sm bg-black/30 modal">

        <div class="bg-white rounded-lg shadow-xl w-full max-w-md p-6">
            <h2 class="text-xl font-semibold text-gray-800 mb-2">Add Item</h2>
            <p class="text-sm text-gray-600 mb-4">
                Fill out the information below to add a new item.
            </p>

            <form method="POST" action="{{ route('maintenance.store_classList') }}">
                @csrf
                <input type="hidden" name="modal" value="addClassList_Modal">

                <!-- Name -->
                <div class="mb-3">
                    <label class="block text-sm font-medium text-gray-700">Name</label>
                    <input type="text" name="name" required
                        class="mt-1 block w-full border border-gray-300 rounded-md px-3 py-2 text-sm focus:ring-2 focus:ring-green-500 focus:border-green-500 outline-none">
                    @error('name')
                        <span class="text-red-600 text-sm">{{ $message }}</span>
                    @enderror
                </div>

                <!-- Buttons -->
                <div class="mt-6 flex justify-end space-x-3">
                    <button type="button" data-close class="px-4 py-2 bg-gray-200 rounded-md">
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

    <!-- Add Department Modal -->
    <div id="addDeptList_Modal"
        class="fixed inset-0 z-50 hidden items-center justify-center backdrop-blur-sm bg-black/30 modal">

        <div class="bg-white rounded-lg shadow-xl w-full max-w-md p-6">
            <h2 class="text-xl font-semibold text-gray-800 mb-2">Add Item</h2>
            <p class="text-sm text-gray-600 mb-4">
                Fill out the information below to add a new item.
            </p>

            <form method="POST" action="{{ route('maintenance.store_deptList') }}">
                @csrf
                <input type="hidden" name="modal" value="addDeptList_Modal">

                <!-- Code -->
                <div class="mb-3">
                    <label class="block text-sm font-medium text-gray-700">Code</label>
                    <input type="text" name="code" required
                        class="mt-1 block w-full border border-gray-300 rounded-md px-3 py-2 text-sm focus:ring-2 focus:ring-green-500 focus:border-green-500 outline-none">
                    @error('code')
                        <span class="text-red-600 text-sm">{{ $message }}</span>
                    @enderror
                </div>

                <!-- Name -->
                <div class="mb-3">
                    <label class="block text-sm font-medium text-gray-700">Name</label>
                    <input type="text" name="name" required
                        class="mt-1 block w-full border border-gray-300 rounded-md px-3 py-2 text-sm focus:ring-2 focus:ring-green-500 focus:border-green-500 outline-none">
                    @error('name')
                        <span class="text-red-600 text-sm">{{ $message }}</span>
                    @enderror
                </div>

                <!-- Description -->
                <div class="mb-3">
                    <label class="block text-sm font-medium text-gray-700">Description</label>
                    <input type="text" name="description" required
                        class="mt-1 block w-full border border-gray-300 rounded-md px-3 py-2 text-sm focus:ring-2 focus:ring-green-500 focus:border-green-500 outline-none">
                    @error('description')
                        <span class="text-red-600 text-sm">{{ $message }}</span>
                    @enderror
                </div>

                <!-- Buttons -->
                <div class="mt-6 flex justify-end space-x-3">
                    <button type="button" data-close class="px-4 py-2 bg-gray-200 rounded-md">
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

    <!-- Add Employement Status Modal -->
    <div id="addStatusList_Modal"
        class="fixed inset-0 z-50 hidden items-center justify-center backdrop-blur-sm bg-black/30 modal">

        <div class="bg-white rounded-lg shadow-xl w-full max-w-md p-6">
            <h2 class="text-xl font-semibold text-gray-800 mb-2">Add Item</h2>
            <p class="text-sm text-gray-600 mb-4">
                Fill out the information below to add a new item.
            </p>

            <form method="POST" action="{{ route('maintenance.store_statusList') }}">
                @csrf
                <input type="hidden" name="modal" value="addStatusList_Modal">

                <!-- Name -->
                <div class="mb-3">
                    <label class="block text-sm font-medium text-gray-700">Name</label>
                    <input type="text" name="name" required
                        class="mt-1 block w-full border border-gray-300 rounded-md px-3 py-2 text-sm focus:ring-2 focus:ring-green-500 focus:border-green-500 outline-none">
                    @error('name')
                        <span class="text-red-600 text-sm">{{ $message }}</span>
                    @enderror
                </div>

                <!-- Buttons -->
                <div class="mt-6 flex justify-end space-x-3">
                    <button type="button" data-close class="px-4 py-2 bg-gray-200 rounded-md">
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

    <!-- Add LICENSURE Modal -->
    <div id="addLicenseList_Modal"
        class="fixed inset-0 z-50 hidden items-center justify-center backdrop-blur-sm bg-black/30 modal">

        <div class="bg-white rounded-lg shadow-xl w-full max-w-md p-6">
            <h2 class="text-xl font-semibold text-gray-800 mb-2">Add Item</h2>
            <p class="text-sm text-gray-600 mb-4">
                Fill out the information below to add a new item.
            </p>

            <form method="POST" action="{{ route('maintenance.store_licenseList') }}">
                @csrf
                <input type="hidden" name="modal" value="addLicenseList_Modal">

                <!-- Name -->
                <div class="mb-3">
                    <label class="block text-sm font-medium text-gray-700">Name</label>
                    <input type="text" name="name" required
                        class="mt-1 block w-full border border-gray-300 rounded-md px-3 py-2 text-sm focus:ring-2 focus:ring-green-500 focus:border-green-500 outline-none">
                    @error('name')
                        <span class="text-red-600 text-sm">{{ $message }}</span>
                    @enderror
                </div>

                <!-- Buttons -->
                <div class="mt-6 flex justify-end space-x-3">
                    <button type="button" data-close class="px-4 py-2 bg-gray-200 rounded-md">
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

    <!-- Add Project assigned Modal -->
    <div id="addProjectList_Modal"
        class="fixed inset-0 z-50 hidden items-center justify-center backdrop-blur-sm bg-black/30 modal">

        <div class="bg-white rounded-lg shadow-xl w-full max-w-md p-6">
            <h2 class="text-xl font-semibold text-gray-800 mb-2">Add Item</h2>
            <p class="text-sm text-gray-600 mb-4">
                Fill out the information below to add a new item.
            </p>

            <form method="POST" action="{{ route('maintenance.store_licenseList') }}">
                @csrf
                <input type="hidden" name="modal" value="addProjectList_Modal">

                <!-- Name -->
                <div class="mb-3">
                    <label class="block text-sm font-medium text-gray-700">Name</label>
                    <input type="text" name="name" required
                        class="mt-1 block w-full border border-gray-300 rounded-md px-3 py-2 text-sm focus:ring-2 focus:ring-green-500 focus:border-green-500 outline-none">
                    @error('name')
                        <span class="text-red-600 text-sm">{{ $message }}</span>
                    @enderror
                </div>

                <!-- Buttons -->
                <div class="mt-6 flex justify-end space-x-3">
                    <button type="button" data-close class="px-4 py-2 bg-gray-200 rounded-md">
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

    <!-- Add Site Modal -->
    <div id="addSiteList_Modal"
        class="fixed inset-0 z-50 hidden items-center justify-center backdrop-blur-sm bg-black/30 modal">

        <div class="bg-white rounded-lg shadow-xl w-full max-w-md p-6">
            <h2 class="text-xl font-semibold text-gray-800 mb-2">Add Item</h2>
            <p class="text-sm text-gray-600 mb-4">
                Fill out the information below to add a new item.
            </p>

            <form method="POST" action="{{ route('maintenance.store_siteList') }}">
                @csrf
                <input type="hidden" name="modal" value="addSiteList_Modal">

                <!-- Name -->
                <div class="mb-3">
                    <label class="block text-sm font-medium text-gray-700">Name</label>
                    <input type="text" name="name" required
                        class="mt-1 block w-full border border-gray-300 rounded-md px-3 py-2 text-sm focus:ring-2 focus:ring-green-500 focus:border-green-500 outline-none">
                    @error('name')
                        <span class="text-red-600 text-sm">{{ $message }}</span>
                    @enderror
                </div>

                <!-- Buttons -->
                <div class="mt-6 flex justify-end space-x-3">
                    <button type="button" data-close class="px-4 py-2 bg-gray-200 rounded-md">
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

    <!-- Reusable Delete Confirmation Modal -->
    <div id="deleteModal"
        class="fixed inset-0 z-50 hidden items-center justify-center backdrop-blur-sm bg-black/30 modal">

        <div class="bg-white rounded-lg shadow-xl w-full max-w-md p-6">
            <h2 class="text-xl font-semibold text-gray-800">Confirm Delete</h2>
            <p class="mt-2 text-sm text-gray-600">
                Are you sure you want to delete this item? This action cannot be undone.
            </p>

            <form id="deleteForm" method="POST">
                @csrf
                @method('DELETE')

                <div class="mt-6 flex justify-end space-x-3">
                    <button type="button" data-close class="px-4 py-2 bg-gray-200 rounded-md">
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


    <script>
        const toggleModal = (id, show = true) => {
            const modal = document.getElementById(id);
            modal.classList.toggle('hidden', !show);
            modal.classList.toggle('flex', show);
        };

        document.addEventListener('click', e => {
            // Open Add Modals
            if (e.target.matches('[data-modal]')) {
                toggleModal(e.target.dataset.modal, true);
            }

            // Open Delete Modal
            if (e.target.matches('[data-delete-action]')) {
                const form = document.getElementById('deleteForm');
                form.action = e.target.dataset.deleteAction; // Set the correct route
                toggleModal(e.target.dataset.deleteModal, true);
            }

            // Close any modal
            if (e.target.matches('[data-close]')) {
                toggleModal(e.target.closest('.modal').id, false);
            }
        });
    </script>

    @if ($errors->any())
        <script>
            document.addEventListener('DOMContentLoaded', () => {
                const modalId = "{{ old('modal') }}";
                if (modalId) {
                    toggleModal(modalId, true);
                }
            });
        </script>
    @endif

</x-layout>
