<?php

namespace App\Livewire\Department;

use App\Livewire\Forms\DepartmentForm;
use App\Models\School;
use Livewire\Component;

class Create extends Component
{
    public DepartmentForm $form;

    public function mount(School $school)
    {
        $this->form->setSchoolId($school);
    }

    public function save()
    {
        $this->form->create();
        $this->form->name = "";
        $this->dispatch('created-department');
    }

    public function render()
    {
        return view('livewire.department.create');
    }
}
