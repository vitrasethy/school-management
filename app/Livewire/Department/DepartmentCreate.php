<?php

namespace App\Livewire\Department;

use App\Livewire\Forms\DepartmentForm;
use App\Models\School;
use Livewire\Component;

class DepartmentCreate extends Component
{
    public DepartmentForm $form;

    public function mount(School $school)
    {
        $this->form->setSchoolId($school);
    }

    public function save()
    {
        $this->form->create();
    }

    public function render()
    {
        return view('livewire.department.department-create');
    }
}
