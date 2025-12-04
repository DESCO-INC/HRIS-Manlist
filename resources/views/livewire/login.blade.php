<div class="flex justify-center py-10">
    <div class="relative flex flex-col my-6 bg-white shadow-xl border border-slate-200 rounded-lg w-96">
        <div class="p-4">
            <div class="flex flex-col items-center">
                <p class="text-6xl font-bold text-green-500">DESCO</p>
                <p class="text-2xl font-bold text-green-500 mb-5">HRIS MANLIST</p>
            </div>
            <form wire:submit.prevent="login">
                <div class="mb-2">
                    <x-form-label>Email</x-form-label>
                    <div class="mt-2">
                        <x-form-input wire:model.defer="email" id="email" type="email" required />
                        <x-form-error name='email' />
                    </div>
                </div>

                <div class="mb-2">
                    <x-form-label>Password</x-form-label>
                    <div class="mt-2">
                        <x-form-input wire:model.defer="password" id="password" type="password" required />
                        <x-form-error name='password' />
                    </div>
                </div>

        </div>
        <div class="px-4 pb-4 pt-0">
            <button
                class="w-full rounded-md bg-green-500 py-2 px-4 border border-transparent text-center text-sm text-white transition-all shadow-md hover:shadow-lg focus:bg-slate-700 focus:shadow-none active:bg-slate-700 hover:bg-slate-700 active:shadow-none disabled:pointer-events-none disabled:opacity-50 disabled:shadow-none"
                type="submit">
                Login
            </button>
            </form>

            <!-- Footer -->
            <div class="text-center text-sm text-slate-400 mt-4 pb-2">
                &copy; DESCO 2025
            </div>
        </div>
    </div>
</div>
