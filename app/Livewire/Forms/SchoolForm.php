<?php

namespace App\Livewire\Forms;

use App\Models\School;
use Livewire\Attributes\Validate;
use Livewire\Form;

class SchoolForm extends Form
{
    public School $school;

    #[Validate('required|min:1')]
    public $name = "";

    #[Validate('required|min:1')]
    public $khmer_name = "";

    public function setForm(School $school)
    {
        $this->school = $school;
        $this->name = $school->name;
        $this->khmer_name = $school->khmer_name;
    }

    public function create()
    {
        $this->validate();
        School::create($this->all());
    }

    public function update()
    {
        $this->validate();
        $this->school->update($this->all());
    }

    public function delete() {}
}
