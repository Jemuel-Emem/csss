<?php

namespace App\Livewire\Director;

use Livewire\Component;
use App\Models\ratings as Rate;
use Carbon\Carbon;

class Index extends Component
{
    public $dailyData = [];
    public $weeklyData = [];
    public $yearlyData = [];

    public function mount()
    {
        // Get survey data for different time ranges
        $this->dailyData = $this->calculateSurveyData(Carbon::today());
        $this->weeklyData = $this->calculateSurveyData(Carbon::now()->startOfWeek());
        $this->yearlyData = $this->calculateSurveyData(Carbon::now()->startOfYear());
    }

    private function calculateSurveyData($startDate)
    {
        // Fetch filtered responses
        $totalResponses = Rate::whereDate('created_at', '>=', $startDate)->count();
        $totalSA = Rate::whereDate('created_at', '>=', $startDate)->sum('sa');
        $totalA = Rate::whereDate('created_at', '>=', $startDate)->sum('a');
        $totalNAD = Rate::whereDate('created_at', '>=', $startDate)->sum('nad');
        $totalD = Rate::whereDate('created_at', '>=', $startDate)->sum('d');
        $totalSD = Rate::whereDate('created_at', '>=', $startDate)->sum('sd');
        $totalNA = Rate::whereDate('created_at', '>=', $startDate)->sum('na');

        // ✅ Exclude NA responses from calculations
        $validResponses = $totalResponses - $totalNA;
        $overallScore = ($validResponses > 0) ? (($totalSA + $totalA) / $validResponses) * 100 : 0;

        // ✅ Calculate category percentages
        $totalValidRatings = $totalSA + $totalA + $totalNAD + $totalD + $totalSD;
        $percentages = [
            'Strongly Agree' => ($totalValidRatings > 0) ? round(($totalSA / $totalValidRatings) * 100, 2) : 0,
            'Agree' => ($totalValidRatings > 0) ? round(($totalA / $totalValidRatings) * 100, 2) : 0,
            'Neither Agree Nor Disagree' => ($totalValidRatings > 0) ? round(($totalNAD / $totalValidRatings) * 100, 2) : 0,
            'Disagree' => ($totalValidRatings > 0) ? round(($totalD / $totalValidRatings) * 100, 2) : 0,
            'Strongly Disagree' => ($totalValidRatings > 0) ? round(($totalSD / $totalValidRatings) * 100, 2) : 0,
            'Not Applicable' => ($totalResponses > 0) ? round(($totalNA / $totalResponses) * 100, 2) : 0
        ];

        return [
            'score' => round($overallScore, 2),
            'interpretation' => $this->getInterpretation($overallScore),
            'percentages' => $percentages
        ];
    }

    private function getInterpretation($score)
    {
        if ($score < 60) return 'Poor';
        if ($score >= 60 && $score <= 79.9) return 'Fair';
        if ($score >= 80 && $score <= 89.9) return 'Satisfactory';
        if ($score >= 90 && $score <= 94.9) return 'Very Satisfactory';
        return 'Outstanding';
    }

    public function render()
    {
        return view('livewire.director.index', [
            'dailyData' => $this->dailyData,
            'weeklyData' => $this->weeklyData,
            'yearlyData' => $this->yearlyData,
        ]);
    }
}
