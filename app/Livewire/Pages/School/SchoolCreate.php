<?php

namespace App\Livewire\Pages\School;

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
        return view('livewire.pages.school.school-create');
    }
}
