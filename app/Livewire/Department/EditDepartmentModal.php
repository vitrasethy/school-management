<?php

namespace App\Livewire\Department;

use App\Livewire\Forms\DepartmentForm;
use App\Models\Department;
use App\Models\School;
use Livewire\Component;

class EditDepartmentModal extends Component
{
    public DepartmentForm $form;
    public Department $department;

    public $schools;

    public function mount(Department $department)
    {
        $this->schools = School::all();
        $this->department = $department;
        $this->form->setForm($department);
    }

    public function save()
    {
        $this->form->update();
        $this->dispatch('refresh-departments');
    }

    public function render()
    {
        return view('livewire.department.edit-department-modal');
    }
}
