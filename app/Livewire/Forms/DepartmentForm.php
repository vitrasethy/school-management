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

    public function setForm(Department $department)
    {
        $this->department = $department;
        $this->name = $department->name;
        $this->school_id = $department->school_id;
    }

    public function setSchoolId(School $school)
    {
        $this->school_id = $school->id;
    }

    public function create()
    {
        $this->validate();
        Department::create($this->all());
    }

    public function update()
    {
        $this->validate();
        $this->department->update($this->all());
    }
}
