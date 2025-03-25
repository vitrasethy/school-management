<?php

namespace App\Livewire\Department;

use App\Livewire\Forms\DepartmentForm;
use App\Models\School;
use Illuminate\View\View;
use Livewire\Component;

class Create extends Component
{
    public DepartmentForm $form;

    public function mount(School $school): void
    {
        $this->form->setSchoolId($school);
    }

    public function save(): void
    {
        $this->form->create();
        $this->form->name = '';
        $this->dispatch('created-department');
    }

    public function render(): View
    {
        return view('livewire.department.create');
    }
}
