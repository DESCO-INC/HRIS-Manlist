<?php

namespace App\Livewire;

use Livewire\Component;
use App\Models\User;
use Illuminate\Support\Facades\Auth;
use Illuminate\Validation\ValidationException;

class Login extends Component
{
    public $email = '';
    public $password = '';

    public function login()
    {
        // ✅ 1. Validate input (same rules as your controller)
        $credentials = $this->validate([
            'email' => ['required', 'email'],
            'password' => ['required'],
        ]);

        // ✅ 2. Attempt authentication
        if (!Auth::attempt($credentials)) {
            throw ValidationException::withMessages([
                'email' => 'Email or password is incorrect. Please try again.',
            ]);
        }

        // ✅ 3. Regenerate session
        session()->regenerate();

        // ✅ 4. Redirect (Livewire way)
        return redirect()->to('/dashboard');
    }

    public function render()
    {
        return view('livewire.login');
    }
}
