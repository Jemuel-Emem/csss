<?php

namespace App\Livewire\Admin;

use Livewire\Component;
use App\Models\ratings as Rate;
use Carbon\Carbon;

class Index extends Component
{
    public $dailyData = [];
    public $weeklyData = [];
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

        // Get survey data for different time ranges for the specific user
        $this->dailyData = $this->calculateSurveyData(Carbon::today(), $userId);
        $this->weeklyData = $this->calculateSurveyData(Carbon::now()->startOfWeek(), $userId);
        $this->yearlyData = $this->calculateSurveyData(Carbon::now()->startOfYear(), $userId);
    }

    private function calculateSurveyData($startDate, $userId)
    {
        // Fetch filtered responses for the specific user
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

        // Calculate percentages differently
        $percentages = [];
        $totalPossiblePoints = $totalResponses * 5; // Assuming 5 is the max points per response

        if ($totalPossiblePoints > 0) {
            $percentages = [
                'Strongly Agree' => round(($totalSA / $totalPossiblePoints) * 100, 2),
                'Agree' => round(($totalA / $totalPossiblePoints) * 100, 2),
                'Neither Agree Nor Disagree' => round(($totalNAD / $totalPossiblePoints) * 100, 2),
                'Disagree' => round(($totalD / $totalPossiblePoints) * 100, 2),
                'Strongly Disagree' => round(($totalSD / $totalPossiblePoints) * 100, 2),
                'Not Applicable' => round(($totalNA / $totalPossiblePoints) * 100, 2)
            ];
        } else {
            $percentages = [
                'Strongly Agree' => 0,
                'Agree' => 0,
                'Neither Agree Nor Disagree' => 0,
                'Disagree' => 0,
                'Strongly Disagree' => 0,
                'Not Applicable' => 0
            ];
        }

        // Calculate overall score differently
        $positiveResponses = $totalSA + $totalA;
        $totalValidResponses = $totalSA + $totalA + $totalNAD + $totalD + $totalSD;
        $overallScore = ($totalValidResponses > 0) ? ($positiveResponses / $totalValidResponses) * 100 : 0;

        return [
            'score' => round($overallScore, 2),
            'interpretation' => $this->getInterpretation($overallScore),
            'percentages' => $percentages,
            'naPercentage' => ($totalResponses > 0) ? round(($totalNA / $totalResponses) * 100, 2) : 0
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
            'yearlyData' => $this->yearlyData,
        ]);
    }
}
