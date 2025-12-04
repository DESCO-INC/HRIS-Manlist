<!-- Clean Green Navbar -->
<nav class="bg-green-500 shadow-md">
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
        <div class="flex items-center justify-between h-16">
            <!-- Left Section (Logo + Nav Links) -->
            <div class="flex items-center space-x-8">
                <!-- Logo -->
                <h1 class="text-2xl font-bold text-white">HRIS MANLIST</h1>

                <!-- Nav Links -->
                <div class="flex items-center space-x-6 ml-8">
                    @auth
                        <!-- Regular nav link -->
                        <x-nav-link href="{{ route('dashboard.index') }}" :active="request()->routeIs('dashboard.index')">
                            Manlist Dashboard
                        </x-nav-link>

                        @if (Auth::user()->credential === 'ADMIN')
                            <x-nav-link href="{{ route('maintenance.index') }}" :active="request()->routeIs('maintenance.index')">
                                System Maintenance
                            </x-nav-link>
                        @endif
                    @endauth
                </div>

            </div>

            <!-- Right Section -->
            <div class="hidden md:flex items-center ml-auto space-x-4">
                @guest
                    <a href="{{ url('/') }}"
                        class="text-white hover:text-green-100 transition mx-5 {{ request()->is('/') ? 'font-semibold' : '' }}">
                        Login
                    </a>
                @endguest

                @auth
                    <!-- Profile Dropdown -->
                    <div class="relative">
                        <!-- Profile Button -->
                        <button type="button" id="profileDropdownButton"
                            class="flex items-center gap-2 px-4 py-2 bg-white text-green-600 rounded-md hover:bg-green-50 transition font-medium">
                            <!-- Avatar -->
                            <div
                                class="w-6 h-6 rounded-full bg-green-600 text-white flex items-center justify-center font-semibold text-[10px] uppercase">
                                {{ substr(Auth::user()->name, 0, 1) }}
                            </div>

                            <!-- User Name -->
                            <span class="text-sm">{{ Auth::user()->name }}</span>
                        </button>

                        <!-- Dropdown Menu (same width, right-aligned, below button) -->
                        <div id="profileDropdownMenu"
                            class="hidden absolute top-full right-0 mt-2 w-full bg-white border border-gray-200 rounded-md shadow-lg overflow-hidden z-50">

                            <a href="{{ route('maintenance.profile') }}"
                                class="block px-4 py-2 text-sm text-gray-700 hover:bg-green-50 text-right">
                                Profile Settings
                            </a>

                            <button type="button"
                                class="w-full text-right px-4 py-2 text-sm text-gray-700 hover:bg-red-50 hover:text-red-600"
                                onclick="document.getElementById('logout-modal').classList.remove('hidden')">
                                Logout
                            </button>
                        </div>
                    </div>

                    <!-- Logout Modal -->
                    <div id="logout-modal"
                        class="hidden fixed inset-0 z-50 flex items-center justify-center backdrop-blur-sm bg-black/30">
                        <div class="bg-white rounded-lg shadow-xl w-full max-w-md p-6">
                            <h2 class="text-xl font-semibold text-gray-800">Confirm Logout</h2>
                            <p class="mt-2 text-sm text-gray-600">Are you sure you want to log out?</p>

                            <div class="mt-6 flex justify-end space-x-3">
                                <button type="button"
                                    class="px-4 py-2 bg-gray-200 text-gray-800 rounded-md hover:bg-gray-300 transition"
                                    onclick="document.getElementById('logout-modal').classList.add('hidden')">
                                    Cancel
                                </button>

                                <button type="submit" wire:click="logout()"
                                    class="px-4 py-2 bg-red-600 text-white rounded-md hover:bg-red-700 transition">
                                    Log out
                                </button>
                            </div>
                        </div>
                    </div>
                @endauth
            </div>


            <!-- Mobile Menu Button -->
            <div class="md:hidden">
                <button type="button" onclick="document.getElementById('mobile-menu').classList.toggle('hidden')"
                    class="text-white hover:text-green-100 focus:outline-none p-2">
                    <svg class="h-6 w-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                            d="M4 6h16M4 12h16M4 18h16" />
                    </svg>
                </button>
            </div>
        </div>
    </div>

    <!-- Mobile Menu -->
    <div id="mobile-menu" class="hidden md:hidden bg-green-600/95">
        <div class="px-2 pt-2 pb-3 space-y-1">
            @auth
                {{-- <x-nav-link href="{{ route('hbo.list') }}" :active="request()->routeIs('hbo.list')" class="block text-white hover:bg-green-700 rounded-md">
                            HBO List
                        </x-nav-link> --}}
            @endauth

            @guest
                <a href="{{ url('/') }}" class="block px-3 py-2 text-white hover:bg-green-700 rounded-md">
                    Login
                </a>
                <a href="{{ url('/register') }}" class="block px-3 py-2 text-white hover:bg-green-700 rounded-md">
                    Register
                </a>
            @endguest
        </div>
    </div>
</nav>
