<?php

namespace App\Livewire\Department;

use App\Livewire\Forms\DepartmentForm;
use App\Models\School;
use Illuminate\Support\Facades\Auth;
use Livewire\Component;

class CreateDepartmentModal extends Component
{
    public DepartmentForm $form;

    public $schools;
    public $user;

    public function mount()
    {
        $this->user = Auth::user();
        if ($this->user->role_id == 1) {
            $this->schools = School::all();
        } elseif ($this->user->role_id == 2) {
            $this->form->school_id = $this->user->school_id;
        }
    }

    public function save()
    {
        $this->form->create();
        $this->dispatch('refresh-departments');
    }

    public function render()
    {
        return view('livewire.department.create-department-modal');
    }
}
