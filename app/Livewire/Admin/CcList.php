<?php

namespace App\Livewire\Admin;
use App\Models\ratings;
use Livewire\Component;

class CcList extends Component
{
    public $ratings;

    public function mount()
    {

        $this->ratings = ratings::all();
    }

    public function render()
    {
        return view('livewire.admin.cc-list', [
            'ratings' => $this->ratings,
        ]);
    }
}
