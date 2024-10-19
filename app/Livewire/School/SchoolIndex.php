<?php

namespace App\Livewire\School;

use App\Models\Department;
use App\Models\School;
use Livewire\Component;

class SchoolIndex extends Component
{
    public School $school;

    

    public function render()
    {
        return view('livewire.school.school-index', [
            'departments' => Department::where('school_id', $this->school->id)->get()
        ]);
    }
}
