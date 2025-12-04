<?php

namespace App\Livewire;

use Livewire\Component;
use Livewire\WithPagination;
use App\Models\User;

class UserTable extends Component
{
    use WithPagination;
    public $name, $email, $password, $password_confirmation;
    public $deleteUserId;
    public $editUserId;
    public $search = '';
    public $credential;

    public $showAddModal = false;
    public $showDeleteModal = false;
    public $showEditModal = false;

    protected $paginationTheme = 'tailwind';
    protected $updatesQueryString = ['search'];

    public function updatingSearch()
    {
        $this->resetPage();
    }

    public function render()
    {
        $query = User::query();

        // Search by name or email
        if ($this->search) {
            $query->where(function ($q) {
                $q->where('name', 'like', '%' . $this->search . '%')->orWhere('email', 'like', '%' . $this->search . '%');
            });
        }

        $users = $query->orderBy('id', 'desc')->paginate(5);

        return view('livewire.user-table', [
            'users' => $users,
        ]);
    }

    public function openAddModal()
    {
        $this->showAddModal = true;
    }

    public function closeAddModal()
    {
        $this->showAddModal = false;
    }

    public function saveUser()
    {
        $this->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|email|unique:users,email',
            'credential' => 'required|string|max:255',
            'password' => 'required|min:5|confirmed',
        ]);

        User::create([
            'name' => $this->name,
            'email' => $this->email,
            'credential' => $this->credential,
            'password' => bcrypt($this->password),
        ]);

        $this->reset(['name', 'email', 'credential', 'password', 'password_confirmation']);
        $this->showAddModal = false;
        return redirect()->route('maintenance.index')->with('success', 'User added successfully.');
    }

    public function confirmDelete($id)
    {
        $this->deleteUserId = $id;
        $this->showDeleteModal = true;
    }

    public function cancelDelete()
    {
        $this->showDeleteModal = false;
        $this->deleteUserId = null;
    }

    public function deleteUser()
    {
        try {
            User::findOrFail($this->deleteUserId)->delete();
            $this->showDeleteModal = false;
            $this->deleteUserId = null;

            // Redirect with success message
            return redirect()->route('maintenance.index')->with('success', 'User deleted successfully.');
        } catch (\Exception $e) {
            \Log::error('Error deleting user: ' . $e->getMessage());
            session()->flash('error', 'Something went wrong while deleting the user.');
            $this->showDeleteModal = false;
        }
    }

    public function editUser($id)
    {
        $user = User::findOrFail($id);
        $this->editUserId = $id;
        $this->name = $user->name;
        $this->email = $user->email;
        $this->password = '';
        $this->password_confirmation = '';
        $this->showEditModal = true;
    }

    public function closeEditModal()
    {
        $this->showEditModal = false;
        $this->reset(['name', 'email', 'password', 'password_confirmation']);
    }

    public function updateUser()
    {
        try {
            $this->validate([
                'name' => 'required|string|max:255',
                'email' => 'required|email|unique:users,email,' . $this->editUserId,
                'password' => 'nullable|min:6|confirmed',
            ]);

            $user = User::findOrFail($this->editUserId);
            $user->name = $this->name;
            $user->email = $this->email;

            if ($this->password) {
                $user->password = bcrypt($this->password);
            }

            $user->save();

            $this->closeEditModal();

            return redirect()->route('maintenance.index')->with('success', 'User updated successfully.');
        } catch (\Exception $e) {
            \Log::error('Error updating user: ' . $e->getMessage());
            session()->flash('error', 'Something went wrong while updating the user.');
        }
    }
}
