<?php

namespace App\Livewire\Forms;

use App\Models\Subject;
use Livewire\Attributes\Validate;
use Livewire\Form;

class SubjectForm extends Form
{
    public Subject $subject;

    #[Validate('required')]
    public $name = "";
    #[Validate('required')]
    public $department_id = "";

    public function setForm(Subject $subject)
    {
        $this->subject = $subject;
        $this->name = $subject->name;
        $this->department_id = $subject->department_id;
    }

    public function create()
    {
        $this->validate();
        Subject::create([
            'department_id' => $this->department_id,
            'name' => $this->name,
        ]);

        $this->reset(['name']);
    }

    public function update()
    {
        $this->validate();
        $this->subject->update($this->all());
    }
}
