<?php

namespace App\Livewire\School;

use App\Livewire\Forms\SchoolForm;
use Livewire\Component;

class SchoolCreate extends Component
{
    public SchoolForm $form;

    public function save()
    {
        $this->form->create();
        return $this->redirect('/school');
    }

    public function render()
    {
        return view('livewire.school.school-create');
    }
}
