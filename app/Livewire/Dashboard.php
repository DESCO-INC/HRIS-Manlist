<?php

namespace App\Livewire;

use Livewire\Component;

class Dashboard extends Component
{
    public $search = 'asd';
    public function render()
    {
        return view('livewire.dashboard');
    }
}
