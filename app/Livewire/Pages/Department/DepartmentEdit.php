<?php

namespace App\Livewire\Pages\Department;

use App\Livewire\Forms\DepartmentForm;
use App\Models\Department;
use App\Models\School;
use Livewire\Component;

class DepartmentEdit extends Component
{
    public DepartmentForm $form;

    public function mount(Department $department)
    {
        $this->form->setForm($department);
    }

    public function save()
    {
        $this->form->update();
        return redirect()->route('department.index', $this->form->department->id);
    }

    public function render()
    {
        return view('livewire.pages.department.department-edit', ['schools' => School::all()]);
    }
}
