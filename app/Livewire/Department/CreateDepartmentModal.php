<?php

namespace App\Livewire\Department;

use App\Livewire\Forms\DepartmentForm;
use App\Models\Faculty;
use Illuminate\Support\Facades\Auth;
use Illuminate\View\View;
use Livewire\Component;

class CreateDepartmentModal extends Component
{
    public DepartmentForm $form;

    public $faculties;

    public $user;

    public function mount(): void
    {
        $this->user = Auth::user();

        if ($this->user->hasRole('super admin')) {
            $this->faculties = Faculty::all();
        } elseif ($this->user->hasRole('faculty admin')) {
            $this->form->faculty_id = $this->user->userAffiliations()->first()->faculty_id;
        }
    }

    public function save(): void
    {
        $this->form->create();
        $this->dispatch('refresh-departments');
    }

    public function render(): View
    {
        return view('livewire.department.create-department-modal');
    }
}
