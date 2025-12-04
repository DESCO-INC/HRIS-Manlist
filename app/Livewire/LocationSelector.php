<?php

namespace App\Livewire;

use Livewire\Component;

class LocationSelector extends Component
{
    public $manlistEntry;

    public $locations = [];
    public $provinces = [];
    public $municipalities = [];
    public $barangays = [];

    public $selectedProvince = null;
    public $selectedMunicipality = null;
    public $selectedBarangay = null;

    public function mount($manlistEntry = null)
    {
        $this->manlistEntry = $manlistEntry;

        // Load JSON file
        $jsonPath = storage_path('app/ph_locations.json');
        $this->locations = json_decode(file_get_contents($jsonPath), true);

        // Extract all provinces
        $this->provinces = collect($this->locations)
            ->flatMap(fn($region) => array_keys($region['province_list']))
            ->sort()
            ->toArray();

        // Pre-select values if editing
        if ($this->manlistEntry && $this->manlistEntry->personalInfo) {
            $this->selectedProvince = $this->manlistEntry->personalInfo->province ?? null;
            $this->selectedMunicipality = $this->manlistEntry->personalInfo->municipality ?? null;
            $this->selectedBarangay = $this->manlistEntry->personalInfo->barangay ?? null;
        }

        // Load initial municipalities and barangays
        $this->municipalities = $this->selectedProvince ? $this->getMunicipalities($this->selectedProvince) : [];
        $this->barangays = $this->selectedMunicipality ? $this->getBarangays($this->selectedProvince, $this->selectedMunicipality) : [];
    }

    public function updatedSelectedProvince($province)
    {
        $this->municipalities = $this->getMunicipalities($province);
        $this->selectedMunicipality = null;

        $this->barangays = [];
        $this->selectedBarangay = null;
    }

    public function updatedSelectedMunicipality($municipality)
    {
        $this->barangays = $this->getBarangays($this->selectedProvince, $municipality);
        $this->selectedBarangay = null;
    }

    // Get municipalities for a province
    private function getMunicipalities($province): array
    {
        foreach ($this->locations as $region) {
            if (isset($region['province_list'][$province])) {
                return array_keys($region['province_list'][$province]['municipality_list']);
            }
        }
        return [];
    }

    // Get barangays for a municipality
    private function getBarangays($province, $municipality): array
    {
        foreach ($this->locations as $region) {
            if (isset($region['province_list'][$province]['municipality_list'][$municipality])) {
                return $region['province_list'][$province]['municipality_list'][$municipality]['barangay_list'] ?? [];
            }
        }
        return [];
    }

    public function render()
    {
        return view('livewire.location-selector');
    }
}
