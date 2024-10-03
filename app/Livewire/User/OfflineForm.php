<?php

namespace App\Livewire\User;

use App\Models\ratings as Rating;
use Livewire\Component;

class OfflineForm extends Component
{
    public $age;
    public $sex;
    public $region;
    public $agency_visited;
    public $service_availed;
    public $customer_type;
    public $cc1;
    public $cc2;
    public $cc3;
    public $sqd1;
    public $sqd2;
    public $sqd3;
    public $sqd4;
    public $sqd5;
    public $sqd6;
    public $sqd7;
    public $sqd8;
    public $remarks;

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
        'sqd1' => 'required|in:1,2,3,4,5',
        'sqd2' => 'required|in:1,2,3,4,5',
        'sqd3' => 'required|in:1,2,3,4,5',
        'sqd4' => 'required|in:1,2,3,4,5',
        'sqd5' => 'required|in:1,2,3,4,5',
        'sqd6' => 'required|in:1,2,3,4,5',
        'sqd7' => 'required|in:1,2,3,4,5',
        'sqd8' => 'required|in:1,2,3,4,5',
        'remarks' => 'nullable|string|max:500',
    ];


    public function submit()
    {

$this->validate();

        Rating::create([
            'age' => $this->age,
            'sex' => $this->sex,
            'region' => $this->region,
            'agency_visited' => $this->agency_visited,
            'service_availed' => $this->service_availed,
            'customer_type' => $this->customer_type,
            'cc1' => $this->cc1,
            'cc2' => $this->cc2,
            'cc3' => $this->cc3,
            'sqd1' => $this->sqd1,
            'sqd2' => $this->sqd2,
            'sqd3' => $this->sqd3,
            'sqd4' => $this->sqd4,
            'sqd5' => $this->sqd5,
            'sqd6' => $this->sqd6,
            'sqd7' => $this->sqd7,
            'sqd8' => $this->sqd8,
            'remarks' => $this->remarks,
        ]);


        $this->reset();

        // Show a success message
        session()->flash('message', 'Thank you for your feedback!');

        // Redirect if necessary
        // return redirect()->to('/thank-you'); // Uncomment if you have a thank-you page
    }

    public function render()
    {
        return view('livewire.user.offline-form');
    }
}
