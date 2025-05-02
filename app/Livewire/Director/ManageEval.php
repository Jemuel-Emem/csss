<?php

namespace App\Livewire\Director;

use Livewire\Component;
use App\Models\ratings;
use App\Models\User;

class ManageEval extends Component
{
    public $officeScores = [];

    // public function mount()
    // {
    //     $adminUsers = User::where('role', 1)->get();

    //     foreach ($adminUsers as $admin) {
    //         $ratings = ratings::where('user_id', $admin->id)->get();

    //         $totalSA = $ratings->sum('sa');
    //         $totalA  = $ratings->sum('a');
    //         $totalNAD = $ratings->sum('nad');
    //         $totalD  = $ratings->sum('d');
    //         $totalSD = $ratings->sum('sd');
    //         $totalNA = $ratings->sum('na');
    //         $totalResponses = $ratings->count();



    //         $totalValid = $totalSA + $totalA + $totalNAD + $totalD + $totalSD;

    //         $score = ($totalValid > 0)
    //             ? (($totalSA + $totalA) / $totalValid) * 100
    //             : 0;

    //         $naPercentage = ($totalResponses > 0)
    //             ? round(($totalNA / $totalResponses) * 100, 2)
    //             : 0;

    //         $this->officeScores[$admin->name] = [
    //             'score' => round($score, 2),
    //             'na'    => $naPercentage
    //         ];
    //     }

    // }
    private function getInterpretation($score)
    {
        if ($score < 60) return 'Poor';
        if ($score >= 60 && $score <= 79.9) return 'Fair';
        if ($score >= 80 && $score <= 89.9) return 'Satisfactory';
        if ($score >= 90 && $score <= 94.9) return 'Very Satisfactory';
        return 'Outstanding';
    }

    public function mount()
    {
        $adminUsers = User::where('role', 1)->get();

        foreach ($adminUsers as $admin) {
            $ratings = ratings::where('user_id', $admin->id)->get();

            $totalSA = $ratings->sum('sa');
            $totalA  = $ratings->sum('a');
            $totalNAD = $ratings->sum('nad');
            $totalD  = $ratings->sum('d');
            $totalSD = $ratings->sum('sd');
            $totalNA = $ratings->sum('na');
            $totalResponses = $ratings->count();

            $totalValid = $totalSA + $totalA + $totalNAD + $totalD + $totalSD;

            $score = ($totalValid > 0)
                ? (($totalSA + $totalA) / $totalValid) * 100
                : 0;

            $naPercentage = ($totalResponses > 0)
                ? round(($totalNA / $totalResponses) * 100, 2)
                : 0;

            $this->officeScores[$admin->name] = [
                'score' => round($score, 2),
                'na'    => $naPercentage,
                'label' => $this->getInterpretation($score)
            ];
        }
    }

    public function render()
    {
        // Prepare interpretations as an associative array with office names as keys
        $interpretations = [];
        foreach ($this->officeScores as $office => $data) {
            $interpretations[$office] = $data['label'];
        }

        return view('livewire.director.manage-eval', [
            'officeLabels' => array_keys($this->officeScores),
            'scoreValues' => array_column($this->officeScores, 'score'),
            'interpretations' => $interpretations, // Proper associative array
        ]);
    }


}
