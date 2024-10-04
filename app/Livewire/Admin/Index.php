<?php

namespace App\Livewire\Admin;

use App\Models\ratings as Rate;
use Livewire\Component;

class Index extends Component
{
    public $rates;
    public $totals;
    public $percentages;
    public $mostChosenCategory;
    public $totalUsers;

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
        $this->totalUsers = $this->rates->count(); // Total number of responses or users
        $this->calculateTotals();
        $this->calculatePercentages();
        $this->determineMostChosenCategory();
    }

    public function calculateTotals()
    {
        $this->totals = [
            'verysatisfied' => $this->rates->sum('sd'),
            'satisfied' => $this->rates->sum('d'),
            'neithersatisfied' => $this->rates->sum('nad'),
            'dissatisfied' => $this->rates->sum('a'),
            'notapplicable' => $this->rates->sum('sa'),
        ];
    }

    public function calculatePercentages()
    {
        if ($this->totalUsers > 0) {
            $this->percentages = [
                'verysatisfied' => ($this->totals['verysatisfied'] / $this->totalUsers) * 100,
                'satisfied' => ($this->totals['satisfied'] / $this->totalUsers) * 100,
                'neithersatisfied' => ($this->totals['neithersatisfied'] / $this->totalUsers) * 100,
                'dissatisfied' => ($this->totals['dissatisfied'] / $this->totalUsers) * 100,
                'notapplicable' => ($this->totals['notapplicable'] / $this->totalUsers) * 100,
            ];
        } else {
            // If there are no users, set percentages to 0
            $this->percentages = [
                'verysatisfied' => 0,
                'satisfied' => 0,
                'neithersatisfied' => 0,
                'dissatisfied' => 0,
                'notapplicable' => 0,
            ];
        }
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
            'percentages' => $this->percentages,
            'mostChosenCategory' => $this->mostChosenCategory,
        ]);
    }
}
