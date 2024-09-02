<?php

namespace App\Livewire\User;

use App\Models\Survey as Question;
use App\Models\rates as Rate;
use Livewire\Component;
use WireUi\Traits\Actions;
use Livewire\WithPagination;

class Takesurvey extends Component
{
    use WithPagination;
    use Actions;

    public $questions;
    public $answers = [];

    public function mount()
    {
        $this->questions = Question::all();
    }

    public function submitSurvey()
    {
        $this->validate([
            'answers' => 'required|array',
            'answers.*' => 'required|integer|between:0,4',
        ], [
            'answers.required' => 'All fields must be filled out before proceeding.',
            'answers.*.required' => 'Each question must have an answer.',
            'answers.*.integer' => 'Each answer must be a valid integer.',
            'answers.*.between' => 'Each answer must be between 0 and 4.',
        ]);


        $surveyData = [
            'name' => auth()->user()->name,
            'verysatisfied' => 0,
            'satisfied' => 0,
            'neithersatisfied' => 0,
            'dissatisfied' => 0,
            'notapplicable' => 0,
        ];


        foreach ($this->answers as $answer) {
            switch ($answer) {
                case 4:
                    $surveyData['verysatisfied'] = 1;
                    break;
                case 3:
                    $surveyData['satisfied'] = 1;
                    break;
                case 2:
                    $surveyData['neithersatisfied'] = 1;
                    break;
                case 1:
                    $surveyData['dissatisfied'] = 1;
                    break;
                case 0:
                    $surveyData['notapplicable'] = 1;
                    break;
            }
        }


        Rate::create($surveyData);


        $this->dialog()->success(
            $title = 'Survey saved',
            $description = 'Survey submitted successfully'
        );
        $this->resetForm();
    }

    public function resetForm()
    {
        $this->reset(['answers']);
        $this->resetValidation();
    }

    public function render()
    {
        return view('livewire.user.takesurvey', [
            'questions' => $this->questions,
        ]);
    }
}
