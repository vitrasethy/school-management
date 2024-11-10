<?php

namespace App\Livewire\School;

use App\Livewire\Forms\SchoolForm;
use Livewire\Component;

class SchoolCreateModal extends Component
{
    public SchoolForm $form;

    public function save()
    {
        $this->form->create();
        $this->dispatch('refresh-schools');
    }

    public function render()
    {
        return view('livewire.school.school-create-modal');
    }
}
