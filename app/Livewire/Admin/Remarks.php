<?php

namespace App\Livewire\Admin;

use App\Models\ratings;
use Livewire\Component;

class Remarks extends Component
{
    public $ratings;
    public function mount()
    {

        $this->ratings = ratings::select('age', 'sex', 'region', 'agency_visited', 'service_availed', 'customer_type', 'remarks')->get();
    }

    public function render()
    {
        // Pass the ratings data to the view
        return view('livewire.admin.remarks', [
            'ratings' => $this->ratings,
        ]);
    }
}
