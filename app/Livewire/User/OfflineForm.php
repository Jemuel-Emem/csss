<?php

namespace App\Livewire\User;
use App\Models\User;
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
    public $departments;
    public $user_id;
    public $department;
    public $users;

    // public function mount()
    // {
    //     // Fetch questions or initialize as empty array if no questions found
    //     $this->questions = Question::all() ?? [];
    // }

    public function mount()
    {
        $this->questions = Question::all() ?? [];
        $this->departments = User::where('role', 1)->pluck('name', 'id')->toArray() ?? [];

    }

    public function updatedDepartment($department)
    {


        // Fetch users belonging to the selected department
        $this->users = User::where('role', 1)->where('id', $department)->get();



        // If there's only one user in the department, auto-select their ID
        if ($this->users->count() == 1) {
            $this->user_id = $this->users->first()->id;
        } else {
            $this->user_id = null; // Reset user_id if multiple users or none
        }
    }
    protected $rules = [
        'user_id' => 'required',
        'age' => 'required|integer|min:0',
        'sex' => 'required|string|max:10',
        'region' => 'required|string|max:100',
        'agency_visited' => 'required|string|max:100',
        'service_availed' => 'required|string|max:100',
        'customer_type' => 'required',
        'cc1' => 'required|in:1,2,3',
        'cc2' => 'required|in:1,2,3',
        'cc3' => 'required|in:1,2',
        'answers' => 'required|array',  // Validate that answers must be an array
        'answers.*' => 'required|integer|in:1,2,3,4,5',  // Validate each item inside the array
        'remarks' => 'nullable|string|max:500',
    ];


    public function submit()
    {
        $this->validate();
       // dd($this->answers);
        $surveyData = [
            'user_id' => $this->user_id,
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

        $sdCount = 0;
        $dCount = 0;
        $nadCount = 0;
        $aCount = 0;
        $saCount = 0;


        foreach ($this->answers as $answer) {
            switch ($answer) {
                case 1:
                    $sdCount++;
                    break;
                case 2:
                    $dCount++;
                    break;
                case 3:
                    $nadCount++;
                    break;
                case 4:
                    $aCount++;
                    break;
                case 5:
                    $saCount++;
                    break;
            }
        }


        $surveyData['sd'] = $sdCount;
        $surveyData['d'] = $dCount;
        $surveyData['nad'] = $nadCount;
        $surveyData['a'] = $aCount;
        $surveyData['sa'] = $saCount;


        Rating::create($surveyData);

        $this->reset();
        session()->flash('message', 'Thank you for your feedback!');
    }
//     public function submit()
// {

//    // $this->validate();
//     // $this->validate([
//     //     'answers' => 'required|array',
//     //     'answers.*' => 'required|integer|between:0,4',
//     // ], [
//     //     'answers.required' => 'All fields must be filled out before proceeding.',
//     //     'answers.*.required' => 'Each question must have an answer.',
//     //     'answers.*.integer' => 'Each answer must be a valid integer.',
//     //     'answers.*.between' => 'Each answer must be between 0 and 4.',
//     // ]);

//     $surveyData = [
//         'user_id' => $this->user_id,
//         'age' => $this->age,
//         'sex' => $this->sex,
//         'region' => $this->region,
//         'agency_visited' => $this->agency_visited,
//         'service_availed' => $this->service_availed,
//         'customer_type' => $this->customer_type,
//         'cc1' => $this->cc1,
//         'cc2' => $this->cc2,
//         'cc3' => $this->cc3,
//         'sd' => 0,
//         'd' => 0,
//         'nad' => 0,
//         'a' => 0,
//         'sa' => 0,
//         'remarks' => $this->remarks,
//     ];

//     foreach ($this->answers as $answer) {
//         switch ($answer) {
//             case 1:
//                 $surveyData['sd'] = 1;
//                 break;
//             case 2:
//                 $surveyData['d'] = 1;
//                 break;
//             case 3:
//                 $surveyData['nad'] = 1;
//                 break;
//             case 4:
//                 $surveyData['a'] = 1;
//                 break;
//             case 5:
//                 $surveyData['sa'] = 1;
//                 break;
//         }
//     }

//     Rating::create($surveyData);

//     $this->reset();
//     session()->flash('message', 'Thank you for your feedback!');
// }

    public function render()
    {
        return view('livewire.user.offline-form');
    }
}
