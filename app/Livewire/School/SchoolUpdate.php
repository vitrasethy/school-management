<?php

namespace App\Livewire\School;

use App\Livewire\Forms\SchoolForm;
use App\Models\School;
use Livewire\Component;

class SchoolUpdate extends Component
{
    public SchoolForm $form;

    public function mount(School $school)
    {
        $this->form->setForm($school);
    }

    public function save()
    {
        $this->form->update();
        return $this->redirect('/school');
    }

    public function render()
    {
        return view('livewire.school.school-update');
    }
}
