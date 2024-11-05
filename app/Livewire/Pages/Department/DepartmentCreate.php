<?php

namespace App\Livewire\Pages\Department;

use App\Livewire\Forms\DepartmentForm;
use App\Models\School;
use Livewire\Component;

class DepartmentCreate extends Component
{
    public DepartmentForm $form;

    public function save()
    {
        $this->form->create();
        return $this->redirect('/department');
    }

    public function render()
    {
        return view('livewire.pages.department.department-create', ['schools' => School::get()]);
    }
}
