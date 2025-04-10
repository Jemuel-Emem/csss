<?php

namespace App\Livewire\Admin;

use App\Models\ratings;
use Livewire\Component;

class Remarks extends Component
{
    public $ratings;
    public function mount()
    {
        $this->ratings = ratings::where('user_id', auth()->id())
        ->select('age', 'sex', 'region', 'office_id', 'service_id', 'customer_type', 'remarks')
            ->get();
    }

    public function render()
    {
        // Pass the ratings data to the view
        return view('livewire.admin.remarks', [
            'ratings' => $this->ratings,
        ]);
    }
}
