<?php

namespace App\Livewire\Forms;

use App\Models\Department;
use App\Models\Group;
use Livewire\Attributes\Validate;
use Livewire\Form;
use Illuminate\Support\Str;

class GroupForm extends Form
{
    public Group $group;

    #[Validate('required|min:1')]
    public $department_id = "";
    #[Validate('required|min:1')]
    public $name = "";
    #[Validate('required|min:1')]
    public $school_year = "";
    #[Validate('required')]
    public $year = "";


    public function setForm(Group $group)
    {
        $this->group = $group;
        $this->department_id = $group->department_id;
        $this->name = $group->name;
        $this->school_year = $group->school_year;
        $this->year = $group->year;
    }

    public function setDepartmentId(Department $department)
    {
        $this->department_id = $department->id;
    }

    public function create()
    {
        $this->validate();
        Group::create([
            'department_id' => $this->department_id,
            'name' => $this->name,
            'school_year' => $this->school_year,
            'year' => $this->year,
            'code' => Str::random(10),
        ]);
        $this->reset(['name', 'school_year', 'year']);
    }

    public function update()
    {
        $this->validate();
        $this->group->update($this->all());
    }
}
