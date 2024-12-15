<?php

namespace App\Livewire\Department;

use App\Livewire\Forms\DepartmentForm;
use App\Models\School;
use Illuminate\Support\Facades\Auth;
use Illuminate\View\View;
use Livewire\Component;

class CreateDepartmentModal extends Component
{
    public DepartmentForm $form;

    public $schools;
    public $user;

    public function mount(): void
    {
        $this->user = Auth::user();

        if ($this->user->hasRole('super admin')) {
            $this->schools = School::all();
        } elseif ($this->user->hasRole('school admin')) {
            $this->form->school_id = $this->user->school_id;
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
