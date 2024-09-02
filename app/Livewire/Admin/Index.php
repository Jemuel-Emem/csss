<?php

namespace App\Livewire\Admin;

use App\Models\rates as Rate;
use Livewire\Component;

class Index extends Component
{
    public $rates;
    public $totals;
    public $mostChosenCategory;
    public $categoryLabels = [
        'verysatisfied' => 'Very Satisfied',
        'satisfied' => 'Satisfied',
        'neithersatisfied' => 'Neither Satisfied nor Dissatisfied',
        'dissatisfied' => 'Dissatisfied',
        'notapplicable' => 'Not Applicable',
    ];

    public function mount()
    {
        $this->rates = Rate::all();
        $this->calculateTotals();
        $this->determineMostChosenCategory();
    }

    public function calculateTotals()
    {
        $this->totals = [
            'verysatisfied' => $this->rates->sum('verysatisfied'),
            'satisfied' => $this->rates->sum('satisfied'),
            'neithersatisfied' => $this->rates->sum('neithersatisfied'),
            'dissatisfied' => $this->rates->sum('dissatisfied'),
            'notapplicable' => $this->rates->sum('notapplicable'),
        ];
    }

    public function determineMostChosenCategory()
    {
        $maxValue = max($this->totals);
        $mostChosen = array_search($maxValue, $this->totals);
        $this->mostChosenCategory = $this->categoryLabels[$mostChosen] ?? 'None';
    }

    public function render()
    {
        return view('livewire.admin.index', [
            'rates' => $this->rates,
            'totals' => $this->totals,
            'mostChosenCategory' => $this->mostChosenCategory,
        ]);
    }
}
