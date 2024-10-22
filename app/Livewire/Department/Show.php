<?php

namespace App\Livewire\Department;

use App\Models\Department;
use App\Models\School;
use Illuminate\Database\Eloquent\Collection;
use Livewire\Attributes\On;
use Livewire\Component;
use Livewire\WithPagination;

class Show extends Component
{
    use WithPagination;

    public School $school;
    public Collection $departments;

    public function mount()
    {
        $this->getDepartment();
    }

    #[On('created-department')]
    #[On('deleted-department')]
    public function getDepartment()
    {
        $this->departments = Department::where('school_id', $this->school->id)->get();
    }

    #[On('confirmed-delete')]
    public function delete($department_id)
    {
        $department = Department::find($department_id);
        $department->delete();
        $this->dispatch('deleted-department');
    }

    public function render()
    {
        return view('livewire.department.show');
    }
}
