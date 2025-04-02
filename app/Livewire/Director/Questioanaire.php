<?php
namespace App\Livewire\Director;

use App\Models\Survey;
use App\Models\Ratings;
use Livewire\Component;

class Questionnaire extends Component
{
    public $surveyQuestions;
    public $ratingsData;

    public function mount()
    {
        // Get all survey questions
        $this->surveyQuestions = Survey::orderBy('id')->get();

        // Initialize ratings data structure
        $this->ratingsData = [];

        // Since ratings aren't connected to questions, we'll assume:
        // - Each question corresponds to its position in the survey
        // - Ratings table has columns sd, d, nad, a, sa, na for each question

        foreach ($this->surveyQuestions as $index => $question) {
            // For this example, we'll just get all ratings counts
            // In a real app, you'd need to map questions to specific rating columns
            $this->ratingsData[$question->id] = [
                'sd_count' => Ratings::sum('sd'),
                'd_count' => Ratings::sum('d'),
                'nad_count' => Ratings::sum('nad'),
                'a_count' => Ratings::sum('a'),
                'sa_count' => Ratings::sum('sa'),
                'na_count' => Ratings::sum('na'),
            ];
        }
    }

    public function render()
    {
        return view('livewire.director.questionnaire', [
            'surveyQuestions' => $this->surveyQuestions,
            'ratingsData' => $this->ratingsData
        ]);
    }
}