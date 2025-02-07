<?php

namespace App\Livewire\Director;

use Livewire\Component;
use App\Models\ratings as Rate;
use App\Models\User;

class Index extends Component
{
    public $meanSAByDepartment = [];

    public function mount()
{
    // Get all departments (assuming department is a 'role' or user group)
    $departments = User::where('role', 1)->pluck('name', 'id');  // Adjust this if role or department is stored differently

    foreach ($departments as $departmentId => $departmentName) {
        // Get all ratings for the department (based on users in that department)
        $ratings = Rate::whereHas('user', function ($query) use ($departmentId) {
            $query->where('id', $departmentId);  // Assuming 'department_id' stores department info
        })->get();

        // Total number of responses in this department
        $totalResponses = $ratings->count();

        // Sum of 'sa' (Strongly Agree) responses in this department
        $totalSA = $ratings->where('sa', 1)->count();  // Count only the "Strongly Agree" responses (assuming 'sa' is a rating value from 1-5)

        // Calculate the percentage of 'sa' responses for the department
        $meanSA = $totalResponses > 0 ? ($totalSA / $totalResponses) * 100 : 0;

        // Store the results
        $this->meanSAByDepartment[$departmentId] = [
            'name' => $departmentName,
            'meanSA' => $meanSA,
            'totalResponses' => $totalResponses,
        ];
    }
}

    public function render()
    {
        return view('livewire.director.index', [
            'meanSAByDepartment' => $this->meanSAByDepartment,
        ]);
    }
}
