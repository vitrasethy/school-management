<?php

namespace App\Livewire\Forms;

use App\Models\Department;
use App\Models\School;
use Livewire\Attributes\Validate;
use Livewire\Form;

class DepartmentForm extends Form
{
    public Department $department;

    #[Validate('required|min:1')]
    public $name = "";
    #[Validate('required|min:1')]
    public $school_id = "";
    #[Validate('required')]
    public $abbr = "";

    public function setForm(Department $department): void
    {
        $this->department = $department;
        $this->name = $department->name;
        $this->school_id = $department->school_id;
    }

    public function setSchoolId(School $school): void
    {
        $this->school_id = $school->id;
    }

    public function create(): void
    {
        $this->validate();
        Department::create($this->all());
        $this->reset('name', 'abbr');
    }

    public function update(): void
    {
        $this->validate();
        $this->department->update($this->all());
    }
}
