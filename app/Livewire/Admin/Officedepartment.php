<?php

namespace App\Livewire\Admin;
use App\Models\User as user;
use Livewire\WithPagination;
use WireUi\Traits\Actions;
use Livewire\Component;

class Officedepartment extends Component
{
    use WithPagination;

    public $add_modal = false;
    public $edit_modal = false;
    public $name, $username, $password;
    public $userId;

    protected $rules = [
        'name' => 'required|string|max:255',
        'username' => 'required|string|max:255|unique:users,email',
        'password' => 'required|string|min:8',
    ];

    public function render()
    {
        $users = User::where('role', 2)->get();
        return view('livewire.admin.officedepartment', compact('users'));
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

    }

    public function openEditModal($id)
    {
        $user = User::findOrFail($id);
        $this->userId = $user->id;
        $this->name = $user->name;
        $this->username = $user->email;
        $this->password = ''; // Leave empty
        $this->edit_modal = true;
    }

    public function update()
    {
        $user = User::findOrFail($this->userId);
        $this->validate([
            'name' => 'required|string|max:255',
            'username' => 'required|string|max:255|unique:users,email,' . $user->id,
            'password' => 'nullable|string|min:8',
        ]);

        $user->update([
            'name' => $this->name,
            'email' => $this->username,
            'password' => $this->password ? bcrypt($this->password) : $user->password,
        ]);

        $this->reset(['name', 'username', 'password', 'edit_modal']);

    }

    public function delete($id)
    {
        User::findOrFail($id)->delete();

    }
}
