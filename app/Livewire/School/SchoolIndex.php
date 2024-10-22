<?php

namespace App\Livewire\School;

use App\Models\Department;
use App\Models\School;
use Illuminate\Database\Eloquent\Collection;
use Livewire\Attributes\On;
use Livewire\Component;

class SchoolIndex extends Component
{
    public School $school;
    public Collection $departments;

    public function mount()
    {
        $this->getDepartment();
    }

    #[On('created-department')]
    public function getDepartment()
    {
        $this->departments = Department::where('school_id', $this->school->id)->get();
    }

    public function render()
    {
        return view('livewire.school.school-index');
    }
}
