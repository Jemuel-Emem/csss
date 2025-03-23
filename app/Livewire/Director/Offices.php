<?php

namespace App\Livewire\Director;

use App\Models\Offices as Office;
use Livewire\Component;
use WireUi\Traits\Actions;

class Offices extends Component
{
    use Actions;

    public $add_modal = false;
    public $edit_modal = false;
    public $name;
    public $officeId;

    protected $rules = [
        'name' => 'required|string|max:255',
    ];

    public function render()
    {
        $offices = Office::all();
        return view('livewire.director.offices', compact('offices'));
    }

    public function submit()
    {
        $this->validate();

        Office::create([
            'name' => $this->name,
        ]);

        $this->notification()->success(
            $title = 'Success',
            $description = 'Office added successfully!'
        );

        $this->reset(['name', 'add_modal']);
    }

    public function openEditModal($id)
    {
        $office = Office::findOrFail($id);
        $this->officeId = $office->id;
        $this->name = $office->name;
        $this->edit_modal = true;
    }

    public function update()
    {
        $this->validate();

        $office = Office::findOrFail($this->officeId);
        $office->update([
            'name' => $this->name,
        ]);

        $this->notification()->success(
            $title = 'Success',
            $description = 'Office updated successfully!'
        );

        $this->reset(['name', 'edit_modal']);
    }

    public function delete($id)
    {
        Office::findOrFail($id)->delete();

        $this->notification()->success(
            $title = 'Success',
            $description = 'Office deleted successfully!'
        );
    }
}
