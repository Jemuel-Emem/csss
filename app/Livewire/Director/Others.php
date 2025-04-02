<?php

namespace App\Livewire\Director;

use App\Models\ratings;
use Livewire\Component;

class Others extends Component
{
    public $genderData = [];
    public $clientTypeData = [];
    public $ageGroupData = [];

    public function mount()
    {
        // Fetch total ratings count
        $totalResponses = ratings::count();

        // Gender Breakdown
        $genderCounts = ratings::selectRaw('sex, COUNT(*) as count')
            ->groupBy('sex')
            ->pluck('count', 'sex')
            ->toArray();

        // Convert to percentage
        foreach ($genderCounts as $gender => $count) {
            $this->genderData[$gender] = round(($count / $totalResponses) * 100, 2);
        }

        // Client Type Breakdown
        $clientTypeCounts = ratings::selectRaw('customer_type, COUNT(*) as count')
            ->groupBy('customer_type')
            ->pluck('count', 'customer_type')
            ->toArray();

        foreach ($clientTypeCounts as $type => $count) {
            $this->clientTypeData[$type] = round(($count / $totalResponses) * 100, 2);
        }

        // Age Breakdown
        $ageGroupCounts = ratings::selectRaw("
            CASE
                WHEN age < 18 THEN 'Under 18'
                WHEN age BETWEEN 18 AND 29 THEN '18-29'
                WHEN age BETWEEN 30 AND 49 THEN '30-49'
                WHEN age >= 50 THEN '50+'
            END as age_group, COUNT(*) as count")
            ->groupBy('age_group')
            ->pluck('count', 'age_group')
            ->toArray();

        foreach ($ageGroupCounts as $ageGroup => $count) {
            $this->ageGroupData[$ageGroup] = round(($count / $totalResponses) * 100, 2);
        }
    }

    public function render()
    {
        return view('livewire.director.others', [
            'genderData' => $this->genderData,
            'clientTypeData' => $this->clientTypeData,
            'ageGroupData' => $this->ageGroupData,
        ]);
    }
}
