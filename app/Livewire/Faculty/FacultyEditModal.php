<?php

namespace App\Livewire\Faculty;

use App\Livewire\Forms\FacultyForm;
use App\Models\Faculty;
use Illuminate\View\View;
use Livewire\Component;
use Livewire\WithFileUploads;

class FacultyEditModal extends Component
{
    use WithFileUploads;

    public FacultyForm $form;
    public Faculty $faculty;

    public function mount(Faculty $faculty): void
    {
        $this->faculty = $faculty;
        $this->form->setForm($faculty);
    }

    public function save(): void
    {
        $this->form->update();
        $this->dispatch('refresh-faculties');
    }

    public function render(): View
    {
        return view('livewire.faculty.faculty-edit-modal');
    }
}
