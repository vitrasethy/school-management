<?php

namespace App\Livewire\School;

use App\Livewire\Forms\SchoolForm;
use App\Models\School;
use Livewire\Component;

class SchoolEditModal extends Component
{
    public SchoolForm $form;
    public School $school;

    public function mount(School $school)
    {
        $this->school = $school;
        $this->form->setForm($school);
    }

    public function save()
    {
        $this->form->update();
        $this->dispatch('refresh-schools');
    }

    public function render()
    {
        return view('livewire.school.school-edit-modal');
    }
}
