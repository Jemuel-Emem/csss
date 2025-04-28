<?php

namespace App\Livewire\Admin;

use Livewire\Component;
use App\Models\ratings as Rate;
use Carbon\Carbon;

class Index extends Component
{
    public $dailyData = [];
    public $weeklyData = [];
    public $monthlyData = [];
    public $yearlyData = [];

    public $categoryLabels = [
        'sa' => 'Strongly Agree',
        'a' => 'Agree',
        'nad' => 'Neither Agree Nor Disagree',
        'd' => 'Disagree',
        'sd' => 'Strongly Disagree',
        'na' => 'Not Applicable'
    ];

    public function mount()
    {
        $userId = auth()->id();

        $this->dailyData = $this->calculateSurveyData(Carbon::today(), $userId);
        $this->weeklyData = $this->calculateSurveyData(Carbon::now()->startOfWeek(), $userId);
        $this->monthlyData = $this->calculateSurveyData(Carbon::now()->startOfMonth(), $userId); // ✅ Monthly added
        $this->yearlyData = $this->calculateSurveyData(Carbon::now()->startOfYear(), $userId);
    }

    private function calculateSurveyData($startDate, $userId)
    {
        $totalResponses = Rate::where('user_id', $userId)
            ->whereDate('created_at', '>=', $startDate)
            ->count();

        $totalSA = Rate::where('user_id', $userId)
            ->whereDate('created_at', '>=', $startDate)
            ->sum('sa');
        $totalA = Rate::where('user_id', $userId)
            ->whereDate('created_at', '>=', $startDate)
            ->sum('a');
        $totalNAD = Rate::where('user_id', $userId)
            ->whereDate('created_at', '>=', $startDate)
            ->sum('nad');
        $totalD = Rate::where('user_id', $userId)
            ->whereDate('created_at', '>=', $startDate)
            ->sum('d');
        $totalSD = Rate::where('user_id', $userId)
            ->whereDate('created_at', '>=', $startDate)
            ->sum('sd');
        $totalNA = Rate::where('user_id', $userId)
            ->whereDate('created_at', '>=', $startDate)
            ->sum('na');

        // Only valid ratings (excluding Not Applicable)
        $totalValidRatings = $totalSA + $totalA + $totalNAD + $totalD + $totalSD;

        $overallScore = ($totalValidRatings > 0)
            ? (($totalSA + $totalA) / $totalValidRatings) * 100
            : 0;

        $percentages = [];
        if ($totalValidRatings > 0) {
            $percentages = [
                'Strongly Agree' => round(($totalSA / $totalValidRatings) * 100, 2),
                'Agree' => round(($totalA / $totalValidRatings) * 100, 2),
                'Neither Agree Nor Disagree' => round(($totalNAD / $totalValidRatings) * 100, 2),
                'Disagree' => round(($totalD / $totalValidRatings) * 100, 2),
                'Strongly Disagree' => round(($totalSD / $totalValidRatings) * 100, 2),
            ];

            // Final adjustment to make sure total = 100%
            $sum = array_sum($percentages);
            if ($sum != 100) {
                end($percentages);
                $lastKey = key($percentages);
                $percentages[$lastKey] += (100 - $sum);
                $percentages[$lastKey] = round($percentages[$lastKey], 2);
            }
        } else {
            $percentages = [
                'Strongly Agree' => 0,
                'Agree' => 0,
                'Neither Agree Nor Disagree' => 0,
                'Disagree' => 0,
                'Strongly Disagree' => 0,
            ];
        }

        $naPercentage = ($totalResponses > 0) ? round(($totalNA / $totalResponses) * 100, 2) : 0;

        return [
            'score' => round($overallScore, 2),
            'interpretation' => $this->getInterpretation($overallScore),
            'percentages' => $percentages,
            'naPercentage' => $naPercentage
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
        return view('livewire.admin.index', [
            'dailyData' => $this->dailyData,
            'weeklyData' => $this->weeklyData,
            'monthlyData' => $this->monthlyData, // ✅ added to view
            'yearlyData' => $this->yearlyData,
        ]);
    }
}
