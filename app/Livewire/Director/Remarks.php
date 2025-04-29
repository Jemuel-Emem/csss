<?php

namespace App\Livewire\Director;
use App\Models\ratings;
use Livewire\Component;

class Remarks extends Component
{
    public $ratings;
    public function mount()
    {
        $this->ratings = ratings::all();
    }


    public function render()
    {


        return view('livewire.director.remarks', [
            'ratings' => $this->ratings,
        ]);
    }
}
