<?php

namespace App\Livewire\Forms;

use App\Models\Department;
use App\Models\Faculty;
use Livewire\Attributes\Validate;
use Livewire\Form;

class DepartmentForm extends Form
{
    public Department $department;

    #[Validate('required|min:1')]
    public $name = '';

    #[Validate('required|min:1')]
    public $faculty_id = '';

    #[Validate('required')]
    public $abbr = '';

    public function setForm(Department $department): void
    {
        $this->department = $department;
        $this->name = $department->name;
        $this->faculty_id = $department->faculty_id;
        $this->abbr = $department->abbr;
    }

    public function setSchoolId(Faculty $faculty): void
    {
        $this->faculty_id = $faculty->id;
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
