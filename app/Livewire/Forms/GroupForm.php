<?php

namespace App\Livewire\Forms;

use App\Models\Department;
use App\Models\Group;
use Livewire\Attributes\Validate;
use Livewire\Form;

class GroupForm extends Form
{
    public Group $group;

    #[Validate('required|min:1')]
    public $department_id = "";
    #[Validate('required|min:1')]
    public $name = "";
    #[Validate('required|min:1')]
    public $school_year = "";

    public function setDepartmentId(Department $department)
    {
        $this->department_id = $department->id;
    }

    public function createGroup()
    {
        $this->validate();
        Group::create($this->all());
    }

    public function updateGroup()
    {
        $this->validate();
        $this->group->update($this->all());
    }
}
