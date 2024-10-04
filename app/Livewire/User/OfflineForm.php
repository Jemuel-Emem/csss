<?php

namespace App\Livewire\User;
use App\Models\Survey as Question;
use App\Models\ratings as Rating;
use Livewire\Component;

class OfflineForm extends Component
{
    public $questions;
    public $answers = [];
    public $age;
    public $sex;
    public $region;
    public $agency_visited;
    public $service_availed;
    public $customer_type;
    public $cc1;
    public $cc2;
    public $cc3;
    public $sd;
    public $d;
    public $nad;
    public $a;
    public $sa;
    public $remarks;

    public function mount()
    {
        // Fetch questions or initialize as empty array if no questions found
        $this->questions = Question::all() ?? [];
    }



    protected $rules = [
        'age' => 'required|integer|min:0',
        'sex' => 'required|string|max:10', // Adjust the max length as necessary
        'region' => 'required|string|max:100', // Adjust as necessary
        'agency_visited' => 'required|string|max:100', // Adjust as necessary
        'service_availed' => 'required|string|max:100', // Adjust as necessary
        'customer_type' => 'required', // Ensure these values match your options
        'cc1' => 'required|in:1,2,3',
        'cc2' => 'required|in:1,2,3',
        'cc3' => 'required|in:1,2',
        'sd' => 'required|in:1,2,3,4,5',
        'd' => 'required|in:1,2,3,4,5',
        'nad' => 'required|in:1,2,3,4,5',
        'a' => 'required|in:1,2,3,4,5',
        'sa' => 'required|in:1,2,3,4,5',
        'remarks' => 'nullable|string|max:500',
    ];


    public function submit()
{
    $this->validate();
    // $this->validate([
    //     'answers' => 'required|array',
    //     'answers.*' => 'required|integer|between:0,4',
    // ], [
    //     'answers.required' => 'All fields must be filled out before proceeding.',
    //     'answers.*.required' => 'Each question must have an answer.',
    //     'answers.*.integer' => 'Each answer must be a valid integer.',
    //     'answers.*.between' => 'Each answer must be between 0 and 4.',
    // ]);

    $surveyData = [
        'age' => $this->age,
        'sex' => $this->sex,
        'region' => $this->region,
        'agency_visited' => $this->agency_visited,
        'service_availed' => $this->service_availed,
        'customer_type' => $this->customer_type,
        'cc1' => $this->cc1,
        'cc2' => $this->cc2,
        'cc3' => $this->cc3,
        'sd' => 0,
        'd' => 0,
        'nad' => 0,
        'a' => 0,
        'sa' => 0,
        'remarks' => $this->remarks,
    ];

    foreach ($this->answers as $answer) {
        switch ($answer) {
            case 4:
                $surveyData['sd'] = 1;
                break;
            case 3:
                $surveyData['d'] = 1;
                break;
            case 2:
                $surveyData['nad'] = 1;
                break;
            case 1:
                $surveyData['a'] = 1;
                break;
            case 0:
                $surveyData['sa'] = 1;
                break;
        }
    }

    Rating::create($surveyData);

    $this->reset();
    session()->flash('message', 'Thank you for your feedback!');
}

    public function render()
    {
        return view('livewire.user.offline-form');
    }
}
