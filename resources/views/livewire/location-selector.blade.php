<div class="grid grid-cols-1 sm:grid-cols-3 gap-4">
    <!-- Province -->
    <div>
        <label for="province" class="block mb-1 font-medium text-green-500">Province *</label>
        <select wire:model.live="selectedProvince" id="province" name="province" required
            class="w-full px-3 py-2 border border-gray-300 rounded-md focus:ring-2 focus:ring-green-500 focus:border-green-500 outline-none">
            <option value="">SELECT PROVINCE</option>
            @foreach ($provinces as $province)
                <option value="{{ $province }}" {{ $province == $selectedProvince ? 'selected' : '' }}>
                    {{ strtoupper($province) }}
                </option>
            @endforeach
        </select>
        @error('province')
            <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
        @enderror
    </div>

    <!-- Municipality -->
    <div>
        <label for="municipality" class="block mb-1 font-medium text-green-500">Municipality *</label>
        <select wire:model.live="selectedMunicipality" id="municipality" name="municipality" required
            class="w-full px-3 py-2 border border-gray-300 rounded-md focus:ring-2 focus:ring-green-500 focus:border-green-500 outline-none"
            @if (!$municipalities) disabled @endif>
            @if (!$municipalities) 
                <option value="">LOADING ...</option>
            @else
                <option value="">SELECT MUNICIPALITY</option>
            @endif>
            @foreach ($municipalities as $municipality)
                <option value="{{ $municipality }}">{{ strtoupper($municipality) }}</option>
            @endforeach
        </select>
        @error('municipality')
            <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
        @enderror
    </div>

    <!-- Barangay -->
    <div>
        <label for="barangay" class="block mb-1 font-medium text-green-500">Barangay *</label>
        <select wire:model.live="selectedBarangay" id="barangay" name="barangay" required
            class="w-full px-3 py-2 border border-gray-300 rounded-md focus:ring-2 focus:ring-green-500 focus:border-green-500 outline-none"
            @if (!$barangays) disabled @endif>
            @if (!$barangays)   
                <option value="">LOADING ...</option>
            @else
                <option value="">SELECT BARANGAY</option>
            @endif>
            @foreach ($barangays as $barangay)
                <option value="{{ $barangay }}">{{ strtoupper($barangay) }}</option>
            @endforeach
        </select>
        @error('barangay')
            <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
        @enderror
    </div>

    
</div>
