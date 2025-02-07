<?php

namespace App\Livewire\Director;

use App\Models\User;
use Livewire\Component;
use Illuminate\Support\Facades\Hash;

class AddAccount extends Component
{
    public $name, $email, $password, $userId;
    public $showModal = false, $showEditModal = false;
    public $users;

    protected $rules = [
        'name' => 'required|string|max:255',
        'email' => 'required|email|unique:users,email',
        'password' => 'required|min:6',
    ];

    public function mount()
    {
        $this->fetchUsers();
    }

    public function fetchUsers()
    {
        $this->users = User::where('role', 1)->get();
    }

    public function openModal()
    {
        $this->reset(['name', 'email', 'password']);
        $this->showModal = true;
    }

    public function closeModal()
    {
        $this->showModal = false;
        $this->showEditModal = false;
    }

    public function createAccount()
    {
        $this->validate();

        User::create([
            'name' => $this->name,
            'email' => $this->email,
            'password' => Hash::make($this->password),
            'role' => 1,
        ]);

        session()->flash('message', 'Account created successfully!');
        $this->closeModal();
        $this->fetchUsers();
    }

    public function edit($id)
    {
        $user = User::findOrFail($id);
        $this->userId = $id;
        $this->name = $user->name;
        $this->email = $user->email;
        $this->showEditModal = true;
    }

    public function updateAccount()
    {
        $this->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|email|unique:users,email,' . $this->userId,
        ]);

        $user = User::findOrFail($this->userId);
        $user->update([
            'name' => $this->name,
            'email' => $this->email,
        ]);

        session()->flash('message', 'Account updated successfully!');
        $this->closeModal();
        $this->fetchUsers();
    }

    public function deleteAccount($id)
    {
        User::findOrFail($id)->delete();
        session()->flash('message', 'Account deleted successfully!');
        $this->fetchUsers();
    }

    public function render()
    {
        return view('livewire.director.add-account');
    }
}
