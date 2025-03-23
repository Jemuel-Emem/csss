<?php

namespace App\Livewire\Director;

use App\Models\Services as Service;
use Livewire\Component;
use WireUi\Traits\Actions;

class Services extends Component
{
    use Actions;

    public $services;
    public $service_name;
    public $serviceId;
    public $add_modal = false;
    public $edit_modal = false;

    protected $rules = [
        'service_name' => 'required|string|max:255',
    ];

    public function mount()
    {
        $this->loadServices();
    }

    public function loadServices()
    {
        $this->services = Service::all();
    }

    public function openAddModal()
    {
        $this->reset(['service_name']);
        $this->add_modal = true;
    }

    public function openEditModal($id)
    {
        $service = Service::findOrFail($id);
        $this->serviceId = $service->id;
        $this->service_name = $service->name;
        $this->edit_modal = true;
    }

    public function submit()
    {
        $this->validate();

        Service::create([
            'name' => $this->service_name,
        ]);

        $this->notification()->success('Success', 'Service added successfully!');
        $this->reset(['service_name', 'add_modal']);
        $this->loadServices();
    }

    public function update()
    {
        $this->validate();

        $service = Service::findOrFail($this->serviceId);
        $service->update([
            'name' => $this->service_name,
        ]);

        $this->notification()->success('Success', 'Service updated successfully!');
        $this->reset(['service_name', 'edit_modal']);
        $this->loadServices();
    }

    public function delete($id)
    {
        Service::findOrFail($id)->delete();
        $this->notification()->success('Success', 'Service deleted successfully!');
        $this->loadServices();
    }

    public function render()
    {
        return view('livewire.director.services', [
            'services' => $this->services,
        ]);
    }
}
