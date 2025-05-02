<?php

namespace App\Livewire\User;
use App\Models\User;
use App\Models\Services;
use App\Models\offices;
use App\Models\Survey as Question;
use App\Models\ratings as Rating;
use Livewire\Component;

class OfflineForm extends Component
{
    public $email;
    public $date;

    public $questions;
    public $answers = [];
    public $age;
    public $name;
    public $sex;
    public $region;
    public $office_id;
    public $service_id;
    public $customer_type;
    public $cc1;
    public $cc2;
    public $cc3;
    public $sd;
    public $d;
    public $nad;
    public $a;
    public $sa;
    public $na;
    public $remarks;
    public $departments;
    public $user_id;
    public $department;
    public $users;
    public $offices = [];
    public $services = [];


    public function mount()
    {
        $this->questions = Question::all() ?? [];
        $this->departments = User::where('role', 1)->pluck('name', 'id')->toArray() ?? [];
        $this->offices = Offices::pluck('name', 'id')->toArray();
        $this->services = Services::pluck('name', 'id')->toArray();
    }

    public function updatedDepartment($department)
    {

        $this->users = User::where('role', 1)->where('id', $department)->get();

        if ($this->users->count() == 1) {
            $this->user_id = $this->users->first()->id;
        } else {
            $this->user_id = null;
        }
    }
    protected $rules = [
        'user_id' => 'required',
        'age' => 'required|integer|min:0',
        'name' => 'nullable',
        'sex' => 'required|string|max:10',
        'email' => 'nullable',
        'date' => 'required|date',
        'region' => 'required|string|max:100',
       'office_id' => 'required|exists:offices,id',
       'service_id' => 'required|exists:services,id',
        'customer_type' => 'required',
        'cc1' => 'required|in:1,2,3',
        'cc2' => 'required|in:1,2,3',
        'cc3' => 'required|in:1,2',
        'answers' => 'required|array',  // Validate that answers must be an array
        'answers.*' => 'required|integer|in:1,2,3,4,5,6',  // Validate each item inside the array
        'remarks' => 'nullable|string|max:500',
    ];


    public function submit()
    {
        $this->validate();
       // dd($this->answers);
        $surveyData = [
            'user_id' => $this->user_id,
            'name' => $this->name,
            'age' => $this->age,
            'sex' => $this->sex,
            'region' => $this->region,
            'email' => $this->email,
             'date' => $this->date,
            'office_id' => $this->office_id,
            'service_id' => $this->service_id,
            'customer_type' => $this->customer_type,
            'cc1' => $this->cc1,
            'cc2' => $this->cc2,
            'cc3' => $this->cc3,
            'sd' => 0,
            'd' => 0,
            'nad' => 0,
            'a' => 0,
            'sa' => 0,
            'na' => 0,
            'remarks' => $this->remarks,
        ];

        $sdCount = 0;
        $dCount = 0;
        $nadCount = 0;
        $aCount = 0;
        $saCount = 0;
        $naCount = 0;


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

                    case 6:
                        $naCount++;
                        break;
            }
        }


        $surveyData['sd'] = $sdCount;
        $surveyData['d'] = $dCount;
        $surveyData['nad'] = $nadCount;
        $surveyData['a'] = $aCount;
        $surveyData['sa'] = $saCount;
        $surveyData['na'] = $naCount;


        Rating::create($surveyData);

        $this->reset();
        return redirect()->route('notif');
    }


    public function render()
    {
        return view('livewire.user.offline-form');
    }
}
