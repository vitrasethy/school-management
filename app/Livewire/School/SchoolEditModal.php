<?php

namespace App\Livewire\School;

use App\Livewire\Forms\SchoolForm;
use App\Models\School;
use Illuminate\View\View;
use Livewire\Component;
use Livewire\WithFileUploads;

class SchoolEditModal extends Component
{
    use WithFileUploads;

    public SchoolForm $form;
    public School $school;

    public function mount(School $school): void
    {
        $this->school = $school;
        $this->form->setForm($school);
    }

    public function save(): void
    {
        $this->form->update();
        $this->dispatch('refresh-schools');
    }

    public function render(): View
    {
        return view('livewire.school.school-edit-modal');
    }
}
