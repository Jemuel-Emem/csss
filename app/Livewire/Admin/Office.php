<?php

namespace App\Livewire\Admin;
use App\Models\User as user;
use Livewire\Component;

class Office extends Component
{
    public $add_modal = false;
    public $name;
    public $username;
    public $password;

    protected $rules = [
        'name' => 'required|string|max:255',
        'username' => 'required|string|max:255|unique:users,email',
        'password' => 'required|string|min:8',
    ];
    public function render()
    {
        $users = User::where('role', 2)->get();
        return view('livewire.admin.office', compact('users'));
    }

    public function openAddModal()
    {
        $this->reset(['name', 'username', 'password']);
        $this->add_modal = true;
    }

    public function submit()
    {
        $this->validate();

        User::create([
            'name' => $this->name,
            'email' => $this->username,
            'password' => bcrypt($this->password),
            'role' => 2,
        ]);

        $this->reset(['name', 'username', 'password', 'add_modal']);

        $this->notification([
            'title'       => 'Success!',
            'description' => 'Director added successfully!',
            'icon'        => 'success'
        ]);
    }
}
