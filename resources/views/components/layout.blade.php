<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>{{ config('app.name', 'Laravel') }}</title>
    <link rel="icon" href="{{ asset('images/icon.png') }}" type="image/png">

    <!-- Fonts -->
    <link rel="preconnect" href="https://fonts.bunny.net">
    <link href="https://fonts.bunny.net/css?family=instrument-sans:400,500,600" rel="stylesheet" />

    {{-- Vite + Livewire --}}
    @vite(['resources/css/app.css', 'resources/js/app.js'])

    <style>
        body {
            font-family: -apple-system, BlinkMacSystemFont, 'Segoe UI', Roboto, Oxygen, Ubuntu, Cantarell,
                sans-serif;
        }

        /* Background Image with Blur and Gradient Overlay */
        .bg-wrapper {
            position: fixed;
            top: 0;
            left: 0;
            width: 100%;
            height: 100%;
            z-index: -1;
        }

        .bg-image {
            position: absolute;
            top: 0;
            left: 0;
            width: 100%;
            height: 100%;
            background-image: url('{{ asset('images/background.jpg') }}');
            background-size: cover;
            background-position: center;
            background-repeat: no-repeat;
            filter: blur(3px);
        }

        .bg-overlay {
            position: absolute;
            top: 0;
            left: 0;
            width: 100%;
            height: 100%;
            background: linear-gradient(135deg, rgba(34, 197, 94, 0.75) 0%, rgba(16, 185, 129, 0.65) 50%, rgba(5, 150, 105, 0.75) 100%);
        }
    </style>

    @livewireStyles
</head>

<body class="min-h-screen">
    <!-- Background Image with Effects -->
    <div class="bg-wrapper">
        <div class="bg-image"></div>
        <div class="bg-overlay"></div>
    </div>

    <!-- Toast Message -->
    <!-- Success Toast -->
    @if (session('success'))
        <div id="toast-success"
            class="fixed top-4 right-4 z-50 flex items-center w-full max-w-xs p-4 text-gray-500 bg-white rounded-lg shadow-lg border border-green-400"
            role="alert">
            <svg class="flex-shrink-0 w-5 h-5 text-green-500" fill="currentColor" viewBox="0 0 20 20">
                <path fill-rule="evenodd"
                    d="M16.707 5.293a1 1 0 01.083 1.32l-.083.094L9 14.414 4.707 10.12a1 1 0 011.32-1.497l.094.083L9 11.586l7.293-7.293a1 1 0 011.414 0z"
                    clip-rule="evenodd" />
            </svg>
            <div class="ml-3 text-sm font-medium text-green-700">{{ session('success') }}</div>
            <button type="button"
                class="ml-auto -mx-1.5 -my-1.5 text-gray-400 hover:text-gray-600 rounded-lg focus:ring-2 focus:ring-gray-300 p-1.5 hover:bg-gray-100 inline-flex items-center justify-center h-8 w-8"
                onclick="this.parentElement.remove()">✖</button>
        </div>
        <script>
            setTimeout(() => {
                const toast = document.getElementById('toast-success');
                if (toast) toast.remove();
            }, 4000);
        </script>
    @endif

    <!-- Error Toast -->
    @if (session('error'))
        <div id="toast-error"
            class="fixed top-4 right-4 z-50 flex items-center w-full max-w-xs p-4 text-gray-500 bg-white rounded-lg shadow-lg border border-red-400"
            role="alert">
            <svg class="flex-shrink-0 w-5 h-5 text-red-500" fill="currentColor" viewBox="0 0 20 20">
                <path fill-rule="evenodd"
                    d="M10 18a8 8 0 100-16 8 8 0 000 16zm-1-9V7a1 1 0 112 0v2h2a1 1 0 110 2h-2v2a1 1 0 11-2 0v-2H7a1 1 0 110-2h2z"
                    clip-rule="evenodd" />
            </svg>
            <div class="ml-3 text-sm font-medium text-red-700">{{ session('error') }}</div>
            <button type="button"
                class="ml-auto -mx-1.5 -my-1.5 text-gray-400 hover:text-gray-600 rounded-lg focus:ring-2 focus:ring-gray-300 p-1.5 hover:bg-gray-100 inline-flex items-center justify-center h-8 w-8"
                onclick="this.parentElement.remove()">✖</button>
        </div>
        <script>
            setTimeout(() => {
                const toast = document.getElementById('toast-error');
                if (toast) toast.remove();
            }, 4000);
        </script>
    @endif


    <!-- Navbar -->
    <livewire:Navbar />

    <!-- Main Content -->
    <main class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-8">
        {{ $slot }}
    </main>

    <!-- Script -->
    <script>
        document.addEventListener('DOMContentLoaded', function() {
            const btn = document.getElementById('profileDropdownButton');
            const menu = document.getElementById('profileDropdownMenu');

            btn.addEventListener('click', (e) => {
                e.stopPropagation();
                menu.classList.toggle('hidden');
            });

            document.addEventListener('click', (e) => {
                if (!btn.contains(e.target) && !menu.contains(e.target)) {
                    menu.classList.add('hidden');
                }
            });
        });
    </script>

    @livewireScripts
</body>

</html>
