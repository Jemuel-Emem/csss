<?php

namespace App\Livewire\Admin;

use App\Models\rates as Result;
use Livewire\Component;
use Livewire\WithPagination;

class Results extends Component
{
    use WithPagination;

    public $search = '';

    public function render()
    {
        $search = '%' . $this->search . '%';

        return view('livewire.admin.results', [
            'results' => Result::where('name', 'like', $search)
                                ->orWhere('verysatisfied', 'like', $search)
                                ->orWhere('satisfied', 'like', $search)
                                ->orWhere('neithersatisfied', 'like', $search)
                                ->orWhere('dissatisfied', 'like', $search)
                                ->orWhere('notapplicable', 'like', $search)
                                ->paginate(10),
        ]);
    }
}
