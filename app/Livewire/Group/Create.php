<?php

namespace App\Livewire\Group;

use App\Livewire\Forms\GroupForm;
use App\Models\Department;
use Livewire\Component;

class Create extends Component
{
    public GroupForm $form;

    public function mount(Department $department)
    {
        $this->form->setDepartmentId($department);
    }

    public function save()
    {
        $this->form->createGroup();
        $this->form->name = "";
        $this->form->school_year = "";
        $this->dispatch('created-group');
    }

    public function render()
    {
        return view('livewire.group.create');
    }
}
