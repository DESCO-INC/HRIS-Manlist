<div>

    <!-- Card with Top Right Buttons -->
    <div class="bg-white rounded-lg shadow-sm overflow-hidden mb-3">
        <div class="flex flex-col sm:flex-row sm:items-center sm:justify-between px-6 py-4">
            <h2 class="text-lg font-medium text-gray-800">Filter / Search</h2>
            <!-- Button Row (Right) --><!-- Filters & Search -->
            <div class="flex flex-col sm:flex-row sm:items-center sm:justify-between gap-2">
                <!-- Workbase Filter -->
                <div>
                    <select wire:model.live="selectedSite"
                        class="border border-green-500 rounded px-2 py-1 text-sm focus:ring focus:ring-green-300">
                        <option value="">All Sites</option>
                        @foreach ($sites as $site)
                            <option value="{{ $site }}">{{ $site }}</option>
                        @endforeach
                    </select>
                </div>

                <!-- Search -->
                <div>
                    <input type="text" wire:model.live="search" placeholder="Search by Name or Emp Number"
                        class="border border-green-500 rounded px-2 py-1 text-sm w-full sm:w-48
               focus:ring focus:ring-blue-300 focus:border-blue-500" />
                </div>
            </div>

        </div>
    </div>

    <!-- Table Card -->
    <div class="bg-white rounded-lg shadow-sm overflow-hidden">
        <div class="px-6 py-5 overflow-x-auto"><!-- Table -->
            <div class="overflow-x-auto border border-gray-200 rounded">
                <table class="min-w-full divide-y divide-gray-200 text-sm">
                    <thead class="bg-green-500 text-white">
                        <tr>
                            <th class="px-4 py-4 text-left">Emp #</th>
                            <th class="px-4 py-4 text-left">Name</th>
                            <th class="px-4 py-4 text-left">Department</th>
                            <th class="px-4 py-4 text-left">Position</th>
                            <th class="px-4 py-4 text-left">Workbase</th>
                            <th class="px-4 py-4 text-left">Classification</th>
                            <th class="px-4 py-4 text-left">Status</th>
                            <th class="px-4 py-4 text-left">Date Hired</th>
                            <th class="px-4 py-4 text-left">Options</th>
                        </tr>
                    </thead>
                    <tbody class="bg-white divide-y divide-gray-200">
                        @forelse($manlists as $man)
                            <tr>
                                <td class="px-4 py-4 text-xs">{{ $man->emp_number }}</td>
                                <td class="px-4 py-4 text-xs">{{ $man->firstname }} {{ $man->lastname }}</td>
                                <td class="px-4 py-4 text-xs">{{ $man->department }}</td>
                                <td class="px-4 py-4 text-xs">{{ $man->position }}</td>
                                <td class="px-4 py-4 text-xs">{{ $man->workbase }}</td>
                                <td class="px-4 py-4 text-xs">{{ $man->emp_classification }}</td>
                                @php
                                    $statusColors = [
                                        'REGULAR' => ['text' => '#166534', 'bg' => '#bbf7d0'],
                                        'RESIGNED' => ['text' => '#991b1b', 'bg' => '#fecaca'],
                                        'PROBITIONARY' => ['text' => '#78350f', 'bg' => '#fef3c7'],
                                    ];
                                    $colors = $statusColors[$man->emp_status] ?? [
                                        'text' => '#1f2937',
                                        'bg' => '#e5e7eb',
                                    ];
                                @endphp
                                <td class="px-4 py-4 flex justify-center items-center">
                                    <span class="inline-block px-2 py-1 text-xs font-semibold rounded-full"
                                        style="color: {{ $colors['text'] }}; background-color: {{ $colors['bg'] }};">
                                        {{ $man->emp_status }}
                                    </span>
                                </td>
                                <td class="px-4 py-4 text-xs">{{ $man->datehired }}</td>
                                <td class="px-4 py-2">
                                    <a href="{{ route('dashboard.edit', $man->id) }}"
                                        class="bg-green-500 text-white text-xs px-2 py-1 rounded hover:bg-green-600">
                                        Manage
                                    </a>
                                </td>
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
                {{ $manlists->links() }}
            </div>
        </div>
    </div>



</div>
