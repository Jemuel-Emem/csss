<?php

namespace App\Livewire\Director;

use Livewire\Component;
use App\Models\ratings as Rate;

class Index extends Component
{
    public $overallScore = 0;
    public $interpretation = '';
    public $percentages = [];

    public function mount()
    {
        // Fetch total responses
        $totalResponses = Rate::count();
        $totalSA = Rate::sum('sa'); // Strongly Agree
        $totalA = Rate::sum('a');   // Agree
        $totalNAD = Rate::sum('nad'); // Neither Agree Nor Disagree
        $totalD = Rate::sum('d');   // Disagree
        $totalSD = Rate::sum('sd'); // Strongly Disagree
        $totalNA = Rate::sum('na'); // Not Applicable

        // ✅ Exclude NA responses from calculations
        $validResponses = $totalResponses - $totalNA;

        // ✅ Prevent division by zero
        if ($validResponses > 0) {
            $this->overallScore = (($totalSA + $totalA) / $validResponses) * 100;

            // ✅ Calculate percentages ensuring they sum to 100%
            $totalValidRatings = $totalSA + $totalA + $totalNAD + $totalD + $totalSD;

            if ($totalValidRatings > 0) {
                $this->percentages = [
                    'Strongly Agree' => round(($totalSA / $totalValidRatings) * 100, 2),
                    'Agree' => round(($totalA / $totalValidRatings) * 100, 2),
                    'Neither Agree Nor Disagree' => round(($totalNAD / $totalValidRatings) * 100, 2),
                    'Disagree' => round(($totalD / $totalValidRatings) * 100, 2),
                    'Strongly Disagree' => round(($totalSD / $totalValidRatings) * 100, 2),
                ];
            } else {
                // Set default percentages if no valid ratings
                $this->percentages = [
                    'Strongly Agree' => 0,
                    'Agree' => 0,
                    'Neither Agree Nor Disagree' => 0,
                    'Disagree' => 0,
                    'Strongly Disagree' => 0,
                ];
            }
        } else {
            // Set all to zero if no valid responses
            $this->percentages = [
                'Strongly Agree' => 0,
                'Agree' => 0,
                'Neither Agree Nor Disagree' => 0,
                'Disagree' => 0,
                'Strongly Disagree' => 0,
            ];
        }

        // ✅ NA is separate and based on total responses
        $this->percentages['Not Applicable'] = $totalResponses > 0 ? round(($totalNA / $totalResponses) * 100, 2) : 0;

        // ✅ Interpretation based on overall score
        $this->interpretation = $this->getInterpretation($this->overallScore);
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
            'overallScore' => round($this->overallScore, 2),
            'interpretation' => $this->interpretation,
            'percentages' => $this->percentages,
        ]);
    }
}
