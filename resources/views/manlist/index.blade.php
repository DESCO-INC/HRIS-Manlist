<x-layout>
    <h1 class="text-xl font-semibold text-white mb-5">Welcome, {{ Auth::user()->name }}</h1>

    <!-- Card with Top Right Buttons -->
    <div class="bg-white rounded-lg shadow-sm overflow-hidden mb-3">
        <div class="flex flex-col sm:flex-row sm:items-center sm:justify-between px-6 py-4">
            <h2 class="text-lg font-medium text-gray-800">Employee Management</h2>
            <!-- Button Row (Right) -->
            <div class="flex gap-2 mt-4 sm:mt-0">
                <a href="{{ route('manlist.create') }}"
                    class="bg-green-500 text-white text-xs px-3 py-2 rounded hover:bg-green-600">
                    Add Employee
                </a>
                <a href="{{ route('manlist.export') }}"
                    class="bg-blue-500 text-white text-xs px-3 py-2 rounded hover:bg-blue-600">
                    Export
                </a>
                @if (Auth::user()->credential === 'ADMIN')
                    <button class="bg-blue-500 text-white text-xs px-3 py-2 rounded hover:bg-blue-600"
                        onclick="document.getElementById('import-modal').classList.remove('hidden')">
                        Import
                    </button>
                    <a href="{{ route('download.manlist.template') }}"
                        class="bg-blue-500 text-white text-xs px-3 py-2 rounded hover:bg-blue-600">
                        Download Template
                    </a>
                @endif
            </div>
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
                    <x-table.th>Emp #</x-table.th>
                    <x-table.th>Name</x-table.th>
                    <x-table.th>Department</x-table.th>
                    <x-table.th>Position</x-table.th>
                    <x-table.th>Workbase</x-table.th>
                    <x-table.th>Classification</x-table.th>
                    <x-table.th>Status</x-table.th>
                    <x-table.th>Date Hired</x-table.th>
                    <x-table.th>Options</x-table.th>
                </thead>
                <tbody>
                    @forelse ($manlists as $manlist)
                        <tr>
                            @php
                                $emp_status = match ($manlist->emp_status) {
                                    'REGULAR' => 'success',
                                    'PROBITIONARY' => 'warning',
                                    'RESIGNED' => 'error',
                                    default => 'info',
                                };
                            @endphp
                            <x-table.td>{{ $manlist->emp_number }}</x-table.td>
                            <x-table.td>{{ $manlist->firstname }} {{ $manlist->lastname }}</x-table.td>
                            <x-table.td>{{ $manlist->department }}</x-table.td>
                            <x-table.td>{{ $manlist->position }}</x-table.td>
                            <x-table.td>{{ $manlist->workbase }}</x-table.td>
                            <x-table.td>{{ $manlist->emp_classification }}</x-table.td>
                            <x-table.td>{{ $manlist->position }}</x-table.td>
                            <x-table.td class="text-center">
                                <x-basic.badge variant="{{ $emp_status }}">
                                    {{ $manlist->emp_status }}
                                </x-basic.badge>
                            </x-table.td>
                            <x-table.td class="text-center">
                                <a href="{{ route('manlist.edit', $manlist->id) }}"
                                    class="bg-green-500 text-white text-xs px-2 py-1 rounded hover:bg-green-600 inline-block">
                                    Manage
                                </a>
                            </x-table.td>
                        </tr>
                    @empty
                        <tr>
                            <x-table.td colspan="9" class="text-center text-gray-500">
                                No records found
                            </x-table.td>
                        </tr>
                    @endforelse
                </tbody>

            </x-table.main>

            <!-- Pagination -->
            <div class="mt-4">
                {{ $manlists->appends(['search' => $search])->links() }}
            </div>
        </div>
    </div>

    <!-- Import Excel Modal -->
    <div id="import-modal"
        class="hidden fixed inset-0 z-50 flex items-center justify-center backdrop-blur-sm bg-black/30">

        <div class="bg-white rounded-lg shadow-xl w-full max-w-md p-6">
            <h2 class="text-xl font-semibold text-gray-800">Import Excel File</h2>
            <p class="mt-2 text-sm text-gray-600">Upload your Excel (.xlsx) file below.</p>

            <form action="{{ route('manlist.import') }}" method="POST" enctype="multipart/form-data" class="mt-4">
                @csrf

                <input type="file" name="excel_file" accept=".xlsx,.xls" required
                    class="w-full px-3 py-2 border border-gray-300 rounded-md focus:ring-2 
                       focus:ring-green-500 focus:border-green-500 outline-none">

                <div class="mt-6 flex justify-end space-x-3">
                    <!-- Cancel -->
                    <button type="button"
                        class="px-4 py-2 bg-gray-200 text-gray-800 rounded-md hover:bg-gray-300 transition"
                        onclick="document.getElementById('import-modal').classList.add('hidden')">
                        Cancel
                    </button>

                    <!-- Import Button -->
                    <button type="submit"
                        class="px-4 py-2 bg-blue-600 text-white rounded-md hover:bg-blue-700 transition">
                        Import
                    </button>
                </div>
            </form>
        </div>

    </div>


</x-layout>
