<?php

namespace App\Livewire\School;

use App\Livewire\Forms\SchoolForm;
use Illuminate\View\View;
use Livewire\Component;
use Livewire\WithFileUploads;

class SchoolCreateModal extends Component
{
    use WithFileUploads;

    public SchoolForm $form;

    public function save(): void
    {
        $this->form->create();
        $this->dispatch('refresh-schools');
    }

    public function render(): View
    {
        return view('livewire.school.school-create-modal');
    }
}
