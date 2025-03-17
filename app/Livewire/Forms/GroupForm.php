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
    public $school_year_id = '';

    #[Validate('required')]
    public $year_id = '';

    #[Validate('required')]
    public $semester_id = '';

    public function setForm(Group $group): void
    {
        $this->group = $group;
        $this->department_id = $group->department_id;
        $this->name = $group->name;
        $this->semester_id = $group->semester_id;
        $this->school_year_id = $group->academic_year;
        $this->year_id = $group->year_id;
    }

    public function create(): void
    {
        $this->validate();
        Group::create([
            'department_id' => $this->department_id,
            'name' => $this->name,
            'school_year_id' => $this->school_year_id,
            'year_id' => $this->year_id,
            'code' => Str::random(10),
            'semester_id' => $this->semester_id,
        ]);
        $this->reset(['name', 'school_year_id', 'year_id', 'semester_id']);
    }

    public function update(): void
    {
        $this->validate();
        $this->group->update($this->all());
    }
}
