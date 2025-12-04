<?php

namespace App\Livewire;

use Livewire\Component;
use Livewire\WithPagination;
use App\Models\Manlist;

class ManlistTable extends Component
{
    use WithPagination;

    public $selectedSite = null;
    public $search = '';

    // Customize pagination theme if using Tailwind
    protected $paginationTheme = 'tailwind';

    // Reset pagination when search or filter changes
    protected $updatesQueryString = ['search', 'selectedSite'];

    public function updatingSearch()
    {
        $this->resetPage();
    }

    public function updatingSelectedSite()
    {
        $this->resetPage();
    }

    public function render()
    {
        $query = Manlist::query();

        // Filter by workbase/site
        if ($this->selectedSite) {
            $query->where('workbase', $this->selectedSite);
        }

        // Search by name or emp_number
        if ($this->search) {
            $query->where(function ($q) {
                $q->where('firstname', 'like', '%' . $this->search . '%')
                    ->orWhere('lastname', 'like', '%' . $this->search . '%')
                    ->orWhere('emp_number', 'like', '%' . $this->search . '%');
            });
        }

        $query->orderBy('id', 'desc');

        $manlists = $query->orderBy('lastname', 'asc')->paginate(10);

        // Get unique sites for filter dropdown
        $sites = Manlist::select('workbase')->distinct()->pluck('workbase');

        return view('livewire.manlist-table', [
            'manlists' => $manlists,
            'sites' => $sites,
        ]);
    }
}
