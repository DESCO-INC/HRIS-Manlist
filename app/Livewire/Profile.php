<?php

namespace App\Livewire;

use Livewire\Component;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;

class Profile extends Component
{
    public $name;
    public $email;
    public $credential;
    public $password;
    public $isEditing = false;

    public function mount()
    {
        $user = Auth::user();
        $this->name = $user->name;
        $this->email = $user->email;
        $this->credential = $user->credential;
    }

    public function enableEdit()
    {
        $this->isEditing = true;
    }

    public function saveProfile()
    {
        $user = Auth::user(); // Ensure we are updating the current logged-in user

        $this->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|email|unique:users,email,' . $user->id,
            'credential' => 'required|string|max:255',
            'password' => 'nullable|min:5',
        ]);

        $user->name = $this->name;
        $user->email = $this->email;
        $user->credential = $this->credential;

        if ($this->password) {
            $user->password = Hash::make($this->password);
        }

        $user->save();

        $this->password = null;
        $this->isEditing = false;
        
        return redirect()->route('maintenance.profile')->with('success', 'Profile updated successfully!');
    }

    public function render()
    {
        return view('livewire.profile');
    }
}
