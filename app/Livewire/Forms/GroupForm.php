<?php

namespace App\Livewire\Forms;

use App\Models\Group;
use Illuminate\Support\Str;
use Livewire\Attributes\Validate;
use Livewire\Form;

class GroupForm extends Form
{
    public Group $group;

    #[Validate('required|min:1')]
    public $department_id = '';

    #[Validate('required|min:1')]
    public $name = '';

    #[Validate('required|min:1')]
    public $school_year = '';

    #[Validate('required')]
    public $year = '';

    #[Validate('required')]
    public $semester = 0;

    public function setForm(Group $group): void
    {
        $this->group = $group;
        $this->department_id = $group->department_id;
        $this->name = $group->name;
        $this->school_year = $group->school_year;
        $this->year = $group->year;
    }

    public function create(): void
    {
        $this->validate();
        Group::create([
            'department_id' => $this->department_id,
            'name' => $this->name,
            'academic_year' => $this->school_year,
            'year' => $this->year,
            'code' => Str::random(10),
            'semester' => $this->semester,
        ]);
        $this->reset(['name', 'school_year', 'year']);
    }

    public function update(): void
    {
        $this->validate();
        $this->group->update($this->all());
    }
}
