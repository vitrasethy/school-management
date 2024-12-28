<?php

namespace App\Livewire\Faculty;

use App\Livewire\Forms\FacultyForm;
use Illuminate\View\View;
use Livewire\Component;
use Livewire\WithFileUploads;

class FacultyCreateModal extends Component
{
    use WithFileUploads;

    public FacultyForm $form;

    public function save(): void
    {
        $this->form->create();
        $this->dispatch('refresh-faculties');
    }

    public function render(): View
    {
        return view('livewire.faculty.faculty-create-modal');
    }
}
